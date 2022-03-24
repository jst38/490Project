#!/usr/bin/php
<?php
require_once(__DIR__ .'/website/rpc/path.inc');
require_once(__DIR__ .'/website/get_host_info.inc');
require_once(__DIR__ .'/website/RabbitMQLib.inc');


function register($email, $fname, $lname, $username, $password){
  try{
    //payload = ?, label(AKA routing key) = testServer in RabbitMQini
    $client = new rabbitMQClient("RabbitMQ.ini","testServer");

    $request = array(); //creates an array
    $request['type'] = "register";  //[] map key and value pairs into array
    $request['email'] = $email;
    $request['fname'] = $fname;
    $request['lname'] = $lname;
    $request['username'] = $username;
    $request['password'] = $password;
    //$request['message'] = $msg;

    $response = $client->send_request($request);
    //$response = $client->publish($request);

    return $response;

    echo "client received response: ".PHP_EOL;

  } //try
  catch(\Throwable $th){
    return "can call register function - Webserver side";
  }
}
//$response = $client->publish($request);

