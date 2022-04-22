<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once(__DIR__ .'/registerUser.php');


//First, create queue if not already created using RabbitMQ.ini file
$ini_r = parse_ini_file(__DIR__ . "/RabbitMQ.ini"); //Return RabbitMQ.ini as an array

        //print_r($ini_r);

        //check if parse inserted into $ini_r, map values to $ 
        if(isset($ini_r)){
            [
            "BROKER_HOST" => $host,
            "BROKER_PORT" => $port,
            "USER" => $user, 
            "PASSWORD" => $password, 
            "VHOST"=>$vhost
            ] = $ini_r;
        }
        else{
            exit("parsing rabbitmq.ini failed."); //if not parsed, kill process
        }

$connection = new AMQPStreamConnection($host, $port, $user, $password, $vhost); //create socket connection, specifies which rabbit node on which host
$channel = $connection->channel(); //open channel

$channel->queue_declare('rpc_queue', false, false, false, false); 
//declares a queue if specific queue does not already exists
//declare on publisher and consumer incase consumer starts up first

echo " [x] Awaiting RPC requests\n";

//callback gets called in basic consume, line 65
$callback = function ($req) { //calls function with
    $req->body;

    $msg = new AMQPMessage(
        (string) fib($n),  //fib($n) will be the string/message we will return
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