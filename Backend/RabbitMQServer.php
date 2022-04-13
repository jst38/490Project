#!/usr/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');
require_once(__DIR__."/rpc/getdb.php");

function doLogin($username,$password){
    try {
        $db = getDB();
        
        if(isset($db)){
            echo "login in fuction - isset(db) is set to true". PHP_EOL;

            $stmt = $db->prepare("SELECT Username, Password FROM Users 
            WHERE Username=$username");
            $stmt->execute();
            $error = $stmt->errorInfo();
        
            return "Welcome! You successfully registered, please login.";
            
        }
    } catch (\Throwable $th) {
        return "you cant login - DB "; 

    } 
} //end of login()

function registerUser($email, $fname, $lname, $username, $password) {
    try {
        $db = getDB();
        
        if(isset($db)){
            echo "in fuction registerUser - isset(db) is set to true". PHP_EOL;
            
            //Add Select query to check if username has already been taken
            //foreach loop?

            $salt = random_bytes(16);
            $password_hash = hash("sha256", $salt . $password, false);

            $stmt = $db->prepare("INSERT INTO Users(Email, Fname, Lname, Username, Password, salt) 
            VALUES (:email, :fname, :lname, :username, :password, :salt)");
            $params = array(
                ":email"=>$email,
                ":fname"=>$fname,
                ":lname"=>$lname,
                ":username"=>$username,
                ":password"=>$password_hash,
                ":salt"=>$salt //change the varchar to to store another datatype
                );
            $stmt->execute($params);
            $error = $stmt->errorInfo();
		   
			return "Welcome! You successfully registered, please login.";
            
        }
    } catch (\Throwable $th) {
        echo "you cant reg". PHP_EOL; 

    } 
} //end of register()

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  //here
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "register":
        echo "recieved register request".PHP_EOL;
        return registerUser($request['email'], $request['fname'],$request['lname'],$request['username'],$request['password']);
    case "login":
      return doLogin($request['username'],$request['password']);
    //case "validate_session":
      //return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("RabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>
