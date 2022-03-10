#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function requestProcessor($request){
    var_dump($request);
    if(!isset($request['type']))
    {
    return "ERROR: unsupported message type";
    }
    switch ($request['type'])
    {
    case "registerUser":
      return registerUser($request['email'], $request['Firstname'],$request['Lastname'],$request['Username'],$request['password']);
  }
  //return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
//Use the right queue for this + server
$server = new rabbitMQServer("RabbitMQ.ini",""); 

$server->process_requests('requestProcessor');
exit();
?>