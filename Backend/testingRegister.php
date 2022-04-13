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

        $stmt = $db->prepare("INSERT INTO Users(Email, Fname, Lname, Username, Password, salt) 
            VALUES (:email, :fname, :lname, :username, :password, :salt)");
            $params = array(
                ":email"=>$email,
                ":fname"=>$fname,
                ":lname"=>$lname,
                ":username"=>$username,
                ":password"=>$password_hash,
                ":salt"=>$salt
                );
        $stmt->execute($params);
        
    }
    catch(Throwable $e){
        echo $e;
    }
}  

register("denise1@denise.com","denise", "cherdak","denise1", "1234");
?>