<?php
require_once('../../rabbitMQ/path.inc');
require_once('../../rabbitMQ/get_host_info.inc');
require_once('../../rabbitMQ/rabbitMQLib.inc');

function login($email, $username, $password){
    $client = new rabbitMQClient("authenticationRabbitMQ.ini","authentication");

    $request = array();

    $request['type'] = "login";
    $request['email'] = $email;
    $request['username'] = $username;
    $request['password'] = $password;
    $response = $client->send_request($request);
    //$response = $client->publish($request);

    return $response;
}

function register($email, $Firstname, $Lastname, $password){
    $client = new rabbitMQClient("authenticationRabbitMQ.ini","authentication");

    $request = array();

    $request['type'] = "registerUser";
    $request['email'] = $email;
    $request['Firstname'] = $Firstname;
    $request['Lastname'] = $Lastname;
    $request['Username'] = $Username;
    $request['password'] = $password;
    $response = $client->send_request($request);
    //$response = $client->publish($request);

    return $response;
}

function logging($origin, $msg){
    /**
     * @param $origin
     */
    $client = new rabbitMQClient("loggingRabbitMQ.ini","logging");

    $request['type'] = "logging";
    $request['origin'] = $origin;
    $request['message'] = time() + $msg;
    $response = $client->send_request($request);

    return $response;
}