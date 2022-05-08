#!/usr/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);
require_once(__DIR__."/getdb.php");

//Backend Functions

//------------------------------------Session Token Functions-----------------------------------//
function generateRandStr()
{
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charsLength = strlen($characters);
    $randstring = '';
    for ($i = 0; $i < $length; ++$i) {
        $randstring .= $characters[rand(0, $charsLength - 1)];
    }
    return $randstring;
}

function setSession($session, $userID)
{    
    {
        try {
            $db = getDB();

            if(isset($db)){
                $stmt = $db->prepare("INSERT INTO Session_Tokens(Session_ID, User_ID) VALUES(:sessionid, :userID)");
                $params = array(
                    ":sessionid"=>$session,
                    ":userID"=>$userID,
                    );
                $stmt->execute($params);

                return "Session token was set" . PHP_EOL;
        
            }
        } catch (Exception $e) {
            echo "/n error in setSession function - DB ". $e->getMessage() . PHP_EOL; 
        }
    }
    
    function sid_to_uid($sid)
    {
        try {
            $db = getdb();
            $stmt = $db->prepare("SELECT User_ID from Session_Tokens where Session_ID = :std");
            $params = array(":std" => $sid);
            $stmt->execute($params);
    
            $results = $stmt->fetch(PDO::FETCH_ASSOC);
            $uid = $results["user_id"]; 
           
            return $uid;
        } catch (\Throwable $th) {
            echo "Error in sid_to_userid function - " . $th->getmessage();
        }
    } //end of sid_to_uid;
}

function logout($sid)
{
    try {
        $db = getdb();
        $stmt = $db->prepare("DELETE FROM Session_Tokens where `Session_id` = :std");
        $params = array(":std" => $sid);
        $stmt->execute($params);
        return true;
    } catch (\Throwable $th) {
        echo "logout functions: " . $th->getMessage();
    }
}

//-----------------------------User Data Functions(Web to Server)------------------------------------//
function doLogin($username,$password){
    try {
        $db = getDB();
        
        if(isset($db)){
            echo "login in fuction - isset(db) is set to true". PHP_EOL;

            $stmt = $db->prepare("SELECT * FROM Users WHERE Username=?");
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->execute();
            $error = $stmt->errorInfo();
            
            $results = $stmt->fetch(PDO::FETCH_ASSOC); //change to PDO Fetch
            echo "Result from SQL select query - DoLogin function". PHP_EOL;
            print_r($results);

            $dbhash = $results["Password"];
            $loginHash = hash("sha256", $results['salt'] . $password, false);
            echo "db hash: ";
            var_dump($dbhash);
            echo "\nlogin hash: ";
            var_dump($loginHash); 

            if((hash("sha256", $results['salt'] . $password, false) !== $results["Password"])) { //checks username and password
                return "Failed Login, Please check that Username and Password are correct". PHP_EOL;
            }
            else{
                $str = generateRandStr();

                setSession($str, $results['User_ID']);
                
                return "Welcome! You successfully login.". PHP_EOL;
            }

            //return "Welcome! You successfully registered, please login.";
            
        }
    } catch (\Throwable $th) {
        echo "/n error in login function - DB ". PHP_EOL; 

    } 
} //end of login

function registerUser($email, $fname, $lname, $username, $password) {
    echo "in registerUser function" . PHP_EOL;
    try {
        $db = getDB();

            echo "in fuction registerUser - isset(db) is set to true". PHP_EOL;

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
                ":salt"=>$salt
                );
            $stmt->execute($params);
            $error = $stmt->errorInfo();
            
            if($error[0] == "00000"){
                return "Welcome! You successfully registered, please login!";
            }
            else{
                if($error[0] == "23000"){
                    return "Username or email already exists. Please pick a unique username and email.";
                }
                else {
                    return "An error occurred, please try again.";
                }
            }
			return "There was a validation error. please try again";
            
    }catch (\Throwable $th) {
            //echo "error in register function: " .$th->getmessage(). PHP_EOL; 

        } 
} //end of register()

/*
$sesNum = generateRandStr(); //rtns string
//$sesTest = setSession($sesNum, 58); //
$test = doLogin("te2","1234"); //correct password is 1234
echo "\nThe Return Value: \n";
var_dump($test);


$test = registerUser("te@gmail.com", "test", "test", "te", "1234");
echo "\nThe Return Value: \n";
var_dump($test);
*/