#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function login($username,$password){
    require_once("getdb.php");
        $db = getDB();
            if(isset($db)){
                $stmt = $db->prepare("SELECT username, password From users");
                $results = $stmt->execute();

                echo "db returned: " . var_export($r, true);
                $e = $stmt->errorInfo();
                if($e[0] == "00000"){
                    echo "<br>Welcome! You successfully registered, please login.";
                }
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
		    if($result && isset($result["password"])){
			    $password_hash_from_db = $result["password"];
			if(password_verify($password, $password_hash_from_db)){
                session_start();//we only need to active session when it's worth activating it
                unset($result["password"]);//remove password so we don't leak it beyond this page
                //let's create a session for our user based on the other data we pulled from the table
                $_SESSION["user"] = $result;//we can save the entire result array since we removed password
			    echo "<br>Welcome! You're logged in!<br>"; 
                //in this part we'll just show that we have the session set, the next example we'll actually
                //navigate the user
                echo "<pre>" . var_export($_SESSION, true) . "</pre>";
            }
        }
        return  echo "Something went wrong."   
    }
    
    // lookup username in databas
    // check password
    return true;
    //return false if not valid
}