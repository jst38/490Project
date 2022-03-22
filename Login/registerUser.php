#!/usr/bin/php
<?php
require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');
//require(__DIR__ .'/requestProcessor.php');

function registerUser($email, $Fname, $Lname, $Username, $Password) {
    try {
        require_once("getdb.php");
    $db = getDB();

        if(isset($db)){

            $salt = random_bytes(16);
            $password_hash = hash("sha256", $salt . $password, true);

            $stmt = $db->prepare("Insert INTO users(email, Fname, Lname, Username, Password) Values (:email, :Fname, :nLame, :username, :password)");
            $params = array(
                ":email"=>$email,
                ":Fname"=>$Fname,
                ":Lname"=>$Lname,
                ":Username"=>$username,
                ":Password"=>$password,
                );
            $results = $stmt->execute($params);
           // echo "db returned: " . var_export($r, true);
           // $e = $stmt->errorInfo();
		   
			echo "<br>Welcome! You successfully registered, please login.";
            
        }
    } catch (\Throwable $th) {
        return "you cant reg. DB "; 

    } 
}
?>
