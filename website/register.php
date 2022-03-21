<?php
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');


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
        <h1> Register Page</h1>

        <form action="" method="POST" >
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
</html>