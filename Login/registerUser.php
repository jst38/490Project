#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function registerUser($email, $Fname, $Lname, $Username, $Password) {
    try {
        require_once("getdb.php");
    $db = getDB();

        if(isset($db)){
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
        return  echo "you cant reg. DB "  

    } 

    
}
?>
