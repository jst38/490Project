<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$ini_r = parse_ini_file(__DIR__ . "/RabbitMQ.ini");

        print_r($ini_r);

        if(isset($ini_r)){
            ["BROKER_HOST" => $host,"BROKER_PORT" => $port,
            "USER" => $user, "PASSWORD" => $password, "VHOST"=>$vhost] = $ini_r;
        }
        else{
            die("parsing rabbitmq.ini failed.");
        }
$connection = new AMQPStreamConnection($host, $port, $user, $password, $vhost);
$channel = $connection->channel();

$channel->queue_declare('rpc_queue', false, false, false, false);

echo " [x] Awaiting RPC requests\n";
$callback = function ($req) {
    $n = intval($req->body);
    echo ' [.] fib(', $n, ")\n";

    $msg = new AMQPMessage(
        (string) fib($n),
        array('correlation_id' => $req->get('correlation_id'))
    );

    $req->delivery_info['channel']->basic_publish(
        $msg,
        '',
        $req->get('reply_to')
    );
    $req->ack();
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('rpc_queue', '', false, false, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>