#!/usr/bin/php
<?php
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');
//require_once(__DIR__ .'/RabbitMQ.ini');

function requestProcessor($request){
    var_dump($request);
    if(!isset($request['type']))
    {
    return "ERROR: unsupported message type";
    }
    switch ($request['type'])
    {
    case "login":
        return login($request['Username'],$request['password']);
    case "registerUser":
      return registerUser($request['email'], $request['Firstname'],$request['Lastname'],$request['Username'],$request['password']);
      
  }
  //return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
//Use the right queue for this + server
$server = new rabbitMQServer("RabbitMQ.ini","testServer"); 

    $server->process_requests('requestProcessor');
    exit();
?>