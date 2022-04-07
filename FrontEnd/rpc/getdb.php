#!usr/bin/php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function getdb(){
    global $db;
        if(!isset($db)){ //if connection is already there
            $host = "localhost"; //where is my db stored?
            $databaseName = "490_db";
            $username = "Denise";
            $password = "password123!";
            $char = 'utf8mb4';

            //set dsn
            $dsn = "mysql:host=$host;dbname=$databaseName;charset=$char";
            //$dsn = "mysql:host=" . $host . ";dbname=" . $databaseName . ";charset=" . $char;
            try{
                    //create a PDO instance
                    $db = new PDO($dsn, $username, $password);
                    $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDO::ATTR_ERRMODE, , PDO::ErrMOde_Warning
                    echo "connection successful - getdb.php";
                } 
            catch (PDOException $error) {
                    echo $error->getMessage();
                    echo $error->getCode();
                }
        //echo "In getdb file";
        //var_dump($db);
        return $db;

    }
}

?>