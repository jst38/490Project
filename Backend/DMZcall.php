#!/usr/bin/php
<?php

//Used to call DMZ through Rabbit

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');

function DMZcall($msg){ //$smg rn is the ingrediate

    //echo "This is the msg in DMZcall: ".$msg. PHP_EOL;

    $client = new rabbitMQClient("ToAPI.ini", "APIQueue");
    $response = $client->send_request($msg);
    
    echo ' [.] Got a response from API_Listener - DMZcall.php'. "\n";
    print_r($response);
}

//testing
$var = array();
    $var['type'] = "recipe_search";
    $var['ingredients'] = "chicken";
DMZcall($var);

?>
