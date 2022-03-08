<?php

$host = "localhost"; //where is my db stored?
$databaseName = "test_db";
$username = "testuser";
$password = "test123!";

$dsn = "mysql:host=$host;dbname=$databaseName";


try{
    $dbConnection = new PDO($dsn, $username, $password);
    $dbConnection->setAttribute(PDO::ERRMODE_EXCEPTION); //PDO::ATTR_ERRMODE, , PDO::ErrMOde_Warning
    echo "connection successful";
    $sql = "Select * From students";
    $users = $dbConnection->query($sql);
    foreach($students AS $user){
        echo "<li>". $user["name"] . "<li>";
    }
} catch (PDOException $error) {
    echo $error->getMessage();
    echo $error->getCode();
}

?>