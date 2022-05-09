#!/usr/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');
require_once(__DIR__ .'/APICall_Functions.php');

function requestProcessor($request)
{
  echo "received request - API_Listener.php".PHP_EOL;
  
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "recipe_search":
        echo "recieved search recipes params".PHP_EOL;
        return API_Search($request['ingredients']);
  }

  //return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("ToAPI.ini", "APIQueue");

echo "API RabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "API RabbitMQServer END".PHP_EOL;
exit();

