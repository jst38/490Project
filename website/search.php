<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');

if($_SERVER["REQUEST_METHOD"]=="POST"){  
    //validation of variables
    $ingredients = null;
    if (isset($_POST["ingredients"])){
        $ingredients = $_POST["ingredients"];
    }

    $userInfo = array();
    $userInfo['type'] = "search";
    $userInfo['ingredients'] = $ingredients;

    $client = new rabbitMQClient("searchQueue.ini", "SearchQueue");
    $response = $client->send_request($userInfo);
    echo ' [.] Got a response'. "\n";
    print_r($response);
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
        <title>PHP - Search</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
        <h1> Search Recipes</h1>
        <br><br>
            <a href="login.php">Log In Here</a>

        <form action="search.php" method="post" >
            <label for="search recipes">search:</label>
            <input type="text" id="search" name="search"><br><br>

            <input type="submit" name="search" value="Search Receipes">
        </form>
    </body>
</html> 