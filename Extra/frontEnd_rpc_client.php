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

    public function __construct() //called automatically when class object is instantiated
    {
        $ini_r = parse_ini_file(__DIR__ . "/RabbitMQ.ini");

        print_r($ini_r);

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
            exit("parsing rabbitmq.ini failed.");
        }

        $this->connection = new AMQPStreamConnection($host, $port, $user, $password, $vhost);
        $this->channel = $this->connection->channel();

        list($this->callback_queue, ,) = $this->channel->queue_declare("", false, false,
            true, false);

        $this->channel->basic_consume($this->callback_queue,'', false, true, false, false,
            array($this,'onResponse')
        );

        //a basic publish then? here?
    }

    public function onResponse($rep)
    {
        if ($rep->get('correlation_id') == $this->corr_id) {
            $this->response = $rep->body;
        }
    }

    public function call($userInfo) //function gets called in register.php
    {
        $this->response = null;
        $this->corr_id = uniqid();//unique corr_id

        $msg = new AMQPMessage(
            $userInfo,
            array(
                'correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue
            )
        );
        //publisher, publishes $msg to default exchange and 'rpc_queue' queue
        $this->channel->basic_publish($msg, '', 'rpc_queue');

        while (!$this->response) {
            $this->channel->wait();
        }
        return intval($this->response);
    }
}

?>