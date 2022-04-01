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
            echo "\nIsset in registerUser.php vardump\n";
            var_dump($db);
            $salt = random_bytes(16);
            $password_hash = hash("Md5", $salt . $password, false);

            $stmt = $db->prepare("INSERT INTO Users(Email, Fname, Lname, Username, Password) 
            VALUES (:email, :fname, :lname, :username, :password)");
            $params = array(
                ":email"=>$email,
                ":fname"=>$fname,
                ":lname"=>$lname,
                ":username"=>$username,
                ":password"=>$password_hash
                );
            $stmt->execute($params);
            $error = $stmt->errorInfo();
		   
			return "Welcome! You successfully registered, please login.";
            
        }
    } catch (\Throwable $th) {
        return "you cant reg. DB "; 

    } 
} //end of register()

//register('denise@gmail.com', 'denise', 'cherdak', 'dcherdak', 'fuck you');


?>
