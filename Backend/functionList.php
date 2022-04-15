#!/usr/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_All);
//require(__DIR__."/rpc/getdb.php");

//Backend Functions

//------------------------------------Session Token Functions-----------------------------------//
function generateRandStr($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charsLength = strlen($characters);
    $randstring = '';
    for ($i = 0; $i < $length; ++$i) {
        $randstring .= $characters[rand(0, $charsLength - 1)];
    }
    return $randstring;
}

function setSession(){

}


//-----------------------------User Data Functions(Web to Server)------------------------------------//
function doLogin($username,$password){
    try {
        require(__DIR__."/rpc/getdb.php");
        $db = getDB();
        
        if(isset($db)){
            echo "login in fuction - isset(db) is set to true". PHP_EOL;

            $stmt = $db->prepare("SELECT Username, Password, salt FROM Users WHERE Username=?");
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->execute();
            $error = $stmt->errorInfo();

            $results = $stmt->fetch(PDO::FETCH_ASSOC); //change to PDO Fetch
            echo "Result from SQL select query - DoLogin function". PHP_EOL;
            print_r($results);

            if((hash("sha256", $results['salt'] . $password, false) !== $results["Password"])) { //checks username and password
                return "Failed Login, Please check that Username and Password are correct". PHP_EOL;
            }
            else{
                $str = generateRandStr();

                //set a session token here
                
                return "Welcome! You successfully login.". PHP_EOL;
            }
            
           

            //return "Welcome! You successfully registered, please l`ogin.";
            
        }
    } catch (\Throwable $th) {
        echo "/n error in login function - DB ". PHP_EOL; 

    } 
} //end of login

function registerUser($email, $fname, $lname, $username, $password) {
    try {
        require(__DIR__."/rpc/getdb.php");
        $db = getDB();
        
        if(isset($db)){
            echo "in fuction registerUser - isset(db) is set to true". PHP_EOL;
            
            //Add Select query to check if username & email has already been taken
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
        echo "error in register function". PHP_EOL; 

    } 
} //end of register()