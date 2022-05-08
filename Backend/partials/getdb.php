#!usr/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function getdb(){
    global $db;
        if(!isset($db)){ //if connection is not already there
            $host = "localhost"; 
            $databaseName = "490_db";
            $username = "Denise";
            $password = "password123!";
            $char = 'utf8mb4';

            //set dsn
            $dsn = "mysql:host=$host;dbname=$databaseName;charset=$char";
            //$dsn = "mysql:host=" . $host . ";dbname=" . $databaseName . ";charset=" . $char;
            try{
                    //create a PDO instance
                    $options = [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //throws PDOExceptions
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING //raises E_Warning diagnostics
                    ];
                    
                    $db = new PDO($dsn, $username, $password, $options);
                    echo "connection successful - getdb.php" . PHP_EOL;
                    return $db;
            }catch (\Throwable $error) {
                echo "error MSG in getdb.php: " . $error->getMessage() . PHP_EOL;
                echo "error CODE in getdb.php: " . $error->getCode() . PHP_EOL;
                $db = null;
                    
            }
        } //if !isset bracket
    return $db;
} //getdb

/*
$conn = getdb();
echo "conn1: ";
var_dump($conn);

$conn2 = getdb();
echo "\n conn2: ";
var_dump($conn2);
*/
?>