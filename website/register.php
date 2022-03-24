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
        <title>PHP - Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
        <h1> Register Page</h1>
        <br>HELLO WELCOME TO OUR PAGE!!!</br>
                    <a href="login.html">Log In Here</a>

        <form action="start_rpc_client.php" method="POST" >
            <label for="email">email:</label>
            <input type="text" id="email" name="email"><br><br>

            <label for="fname">First name:</label>
            <input type="text" id="fname" name="fname"><br><br>

            <label for="lname">Last name:</label>
            <input type="text" id="lname" name="lname"><br><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>

            <label for="password">Password:</label>
            <input type="text" id="password" name="password"><br><br>

            <input type="submit" value="Register">
        </form>
        <!--<button type="button" class="btn" onclick="start_rpc_client.php">Register</button> -->
    </body>
<html>
