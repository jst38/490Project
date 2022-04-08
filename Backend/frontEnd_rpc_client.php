<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class DB_RpcClient
{
    private $connection;
    private $channel;
    private $callback_queue;
    private $response;
    private $corr_id;

    public function __construct() //call automatically
    {
        //How to get rabbit.ini credentials?
        $ini_r = parse_ini_file(__DIR__ . "/RabbitMQ.ini");

        print_r($ini_r);

        if(isset($ini_r)){
            ["BROKER_HOST" => $host,"BROKER_PORT" => $port,
            "USER" => $user, "PASSWORD" => $password, "VHOST"=>$vhost] = $ini_r;
        }
        else{
            die("parsing rabbitmq.ini failed.");
        }
        $this->connection = new AMQPStreamConnection($host, $port, $user, $password, $vhost);
        $this->channel = $this->connection->channel();
        list($this->callback_queue, ,) = $this->channel->queue_declare("", false, false,
            true, false);
        $this->channel->basic_consume($this->callback_queue,'', false, true, false, false,
            array($this,'onResponse')
        );
    }

    public function onResponse($rep)
    {
        if ($rep->get('correlation_id') == $this->corr_id) {
            $this->response = $rep->body;
        }
    }

    public function call($n)
    {
        $this->response = null;
        $this->corr_id = uniqid();

        $msg = new AMQPMessage(
            (string) $n,
            array(
                'correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue
            )
        );
        $this->channel->basic_publish($msg, '', 'rpc_queue');
        while (!$this->response) {
            $this->channel->wait();
        }
        return intval($this->response);
    }
}

?>