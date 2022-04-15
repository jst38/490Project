#!/usr/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');
require_once(__DIR__. "/functionList.php");

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  //here
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "register":
        echo "recieved register request".PHP_EOL;
        return registerUser($request['email'], $request['fname'],$request['lname'],$request['username'],$request['password']);
    case "login":
        echo "recieved login request". PHP_EOL;
        return doLogin($request['username'],$request['password']);
    //case "validate_session":
      //return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("RabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>
