<?php

//require_once(__DIR__."/RabbitMQClient.php");
require_once("get_host_info.inc");
require_once("path.inc");
require_once("rabbitMQLib.inc");
//require("php-amqplib/php-amqplib");

function register($email, $fname, $lname, $username, $password){
    $client = new rabbitMQClient("authenticationRabbitMQ.ini", "authentication");

    $request = array();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    

    //check session_token?

    //need a way to call MQClient here

}
?>

<!DOCTYPE html>
<html>
    <body>
        <h1> Register Page</h1>

        <form action="register.php" method="POST">
            <label>for="email">email:></label>
            <input type="text" id="email" name="email"><br><br>

            <label>for="fname">First name:></label>
            <input type="text" id="fname" name="fname"><br><br>

            <label>for="lname">Last name:></label>
            <input type="text" id="lname" name="lname"><br><br>

            <label>for="username">Username:></label>
            <input type="text" id="username" name="username"><br><br>

            <label>for="password">Password:></label>
            <input type="text" id="password" name="password"><br><br>
        </form>
    </body>
</html>