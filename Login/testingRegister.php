<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once(__DIR__ .'/rpc/path.inc');
require_once(__DIR__ .'/get_host_info.inc');
require_once(__DIR__ .'/RabbitMQLib.inc');


function register($email, $fname, $lname, $username, $password) {
    try {
        require_once(__DIR__."/rpc/getdb.php");
        $db = getDB();

        $salt = random_bytes(16);
        $password_hash = hash("md5", $salt . $password, false);

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
        
    }
    catch(Throwable $e){
        echo $e;
    }
}  

register("Aggs1@aggs.com","Aggg1", "whyy1","Bro1", "work Please");
?>