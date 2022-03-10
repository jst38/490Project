#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function registerUser($email, $Fname, $Lname, $Username, $Password) {
    require_once("getdb.php");
    $db = getDB();

        if(isset($db)){
            $stmt = $db->prepare("Insert INTO users(email, Fname, Lname, Username, Password) Values(email, first name, last name, username, password)");
            //execute -> tells db to execute sql statement + extra parameters and puts it into $results
            
            $results = $stmt->execute();
            echo "db returned: " . var_export($r, true);
            $e = $stmt->errorInfo();
		    if($e[0] == "00000"){
			    echo "<br>Welcome! You successfully registered, please login.";
            }
        }
    return  echo "Something went wrong."   
}
?>