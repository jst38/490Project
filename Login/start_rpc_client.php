<?php
/*FOR TESTING PURPOSES ONLY*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//Don't need /website/... cause all files are in the website directory
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');

/*
register a user
*/
function register($email, $fname, $lname, $username, $password){
        try{
          echo "called register,";
          //payload = ?, label(AKA routing key) = testServer in RabbitMQini
          $client = new rabbitMQClient("RabbitMQ.ini","testServer");
          
          echo "called client successfully,";

          $request = array(); //creates an array
          $request['type'] = "register";  //[] map key and value pairs into array
          $request['email'] = $email;
          $request['fname'] = $fname;
          $request['lname'] = $lname;
          $request['username'] = $username;
          $request['password'] = $password;
          echo "test 3";
          //$request['message'] = $msg;

          $response = $client->send_request($request);
          //$response = $client->publish($request);
          echo "please run 4";
          return $response;

          echo "client received response: ".PHP_EOL;

        } //try
    catch(\Throwable $th){
      return "can call register function - Webserver side";
    }
}//register function bracket

/*
Sorting and Validating the data gotten to the correct function
*/

if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["register"] ){  
  echo "server request post called & register was found,";
  //validation of variables
  $email = null;
  $fname = null;
  $lname = null;
  $username = null;
  $password = null;
  if (isset($_POST["email"])){
      $email = $_POST["email"];
  }
  if (isset($_POST["fname"])){
      $fname = $_POST["fname"];
  }
  if (isset($_POST["lname"])){
      $lname = $_POST["lname"];
  }
  if (isset($_POST["username"])){
      $username = $_POST["username"];
  }
  if (isset($_POST["password"])){
      $password = $_POST["password"];
  }
  $isValid = true;
  echo "$isValid . All values validated from POST,";
  register($email, $fname, $lname, $username, $password);

} //if bracket
else{
  echo "Server post method check + post = register did not work";
}
//$response = $client->publish($request);
?>