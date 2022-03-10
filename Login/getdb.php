#!usr/bin/php
<?php

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
                    echo "connection successful";
                } 
            catch (PDOException $error) {
                    echo $error->getMessage();
                    echo $error->getCode();
                }
        return $db;
    }
}

?>