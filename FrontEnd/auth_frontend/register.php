<?php
/*FOR TESTING PURPOSES ONLYYY*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);

require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');


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

        <form action="start_rpc_client.php" method="post" >
            <label for="email">email:</label>
            <input type="email" id="email" name="email"><br><br>

            <label for="fname">First name:</label>
            <input type="text" id="fname" name="fname"><br><br>

            <label for="lname">Last name:</label>
            <input type="text" id="lname" name="lname"><br><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username"><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br><br>

            <input type="submit" name="register" value="Register">
        </form>
  </body>
<html>