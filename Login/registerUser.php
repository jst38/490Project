#!/usr/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');
//require(__DIR__ .'/requestProcessor.php');

function register($email, $fname, $lname, $username, $password) {
    try {
        require_once(__DIR__."/rpc/getdb.php");
    $db = getDB();

        if(isset($db)){

            $salt = random_bytes(16);
            $password_hash = hash("sha256", $salt . $password, true);

            $stmt = $db->prepare("Insert INTO User(Email, Fname, Lname, Username, Password) Values (:email, :fname, :lame, :username, :password)");
            $params = array(
                ":email"=>$email,
                ":fname"=>$fname,
                ":lname"=>$lname,
                ":username"=>$username,
                ":password"=>$password_hash,
                );
            $results = $stmt->execute($params);
           echo "db returned: ";
           // $e = $stmt->errorInfo();
		   
			echo "<br>Welcome! You successfully registered, please login.";
            
        }
    } catch (\Throwable $th) {
        return "you cant reg. DB "; 

    } 
}
?>
