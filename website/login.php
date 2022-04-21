<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);

require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
  // last request was more than 30 minutes ago
  session_unset();     // unset $_SESSION variable for the run-time 
  session_destroy();   // destroy session data in storage
}

/*
function register($email, $password){
  try{
    //payload = ?, label(AKA routing key) = testServer in RabbitMQini
    $client = new rabbitMQClient("RabbitMQ.ini","testServer");
    $request = array(); //creates an array
    $request['type'] = "login";  //[] map key and value pairs into array
    $request['email'] = $email;
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
*/
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
        <title>PHP - LOGIN</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
        <h1> LOGIN</h1>
        <br>HELLO WELCOME TO OUR PAGE!!!</br>
                    <a href="login.html">Log In Here</a>

        <form action="start_rpc_client.php" method="post" >
            <label for="email">email:</label>
            <input type="email" id="email" name="email"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>

            <input type="submit" name="Login" value="login">
        </form>
        <!-- Notes for the html code:
        for= and id= have to be EXACTLY the same, bindes them to each other
         <input type = "submit"> defines a button that sends data to a form handler(another script), 
         the form handler is specified in action =""
        input field must have a name attribute to submit
        Method = POST sends the info as HTTP
        <input value ="" is text on the button>
      -->
        <!--<button type="button" class="btn" onclick="start_rpc_client.php">Login</button> -->
    </body>
<html>
