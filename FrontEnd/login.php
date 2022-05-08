<?php
/*FOR TESTING PURPOSES ONLYYY*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/rpc/get_host_info.inc');
require_once(__DIR__ .'/rpc/RabbitMQLib.inc');

if($_SERVER["REQUEST_METHOD"]=="POST"){  
    $username = null;
    $password = null;
    
    if (isset($_POST["username"])){
        $username = $_POST["username"];
    }
    if (isset($_POST["password"])){
        $password = $_POST["password"];
    }

    $userInfo = array();
    $userInfo['type'] = "login";
    $userInfo['username'] = $username;
    $userInfo['password'] = $password;

    $client = new rabbitMQClient("loginQueue.ini", "LoginQueue");
    $response = $client->send_request($userInfo);;
    
    //$rabbitConnection = new DB_RpcClient();
    //$response = $rabbitConnection->call($msg); //blocks for 30 secs.
    echo ' Got a response'. "\n";
    print_r($response);

} //if bracket
?>

<link rel="stylesheet" href="styles.css">
<!--require_once(__DIR__."");-->
<!DOCTYPE html>
<html>
    <body>
    <head>
        <title>MY FRIDGE API</title>
        <link rel="stylesheet" href="style.css">
            <div class="menu-bar"></div>
            <div class="container" style="margin-top: 100px;">
            <div class="row justify-content-center">
                <div class="col-md-6 col-md-offset-3" align="center"
                    <img src= "file:///C:/Users/musao/OneDrive/Desktop/SYSINT/Fridge.jpg" width="200", height="200"><br><br>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minumum-scale=1.0"
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
        <h1> Login Page</h1>
        <br>HELLO WELCOME TO OUR PAGE!!!</br>
                    <a href="register.php">Register Here</a>

        <form action="login.php" method="post" >

            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>

            <input type="submit" name="login" value="Login">
        </form>
    </body>
<html>