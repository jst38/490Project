<?php

$host = "localhost"; //where is my db stored?
$databaseName = "test_db";
$username = "testuser";
$password = "test123!";
$char = 'utf8mb4';

//set dsn
$dsn = "mysql:host=$host;dbname=$databaseName;charset=$char";
//$dsn = "mysql:host=" . $host . ";dbname=" . $databaseName . ";charset=" . $char;

try{
    //create a PDO instance
    $dbConnection = new PDO($dsn, $username, $password);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDO::ATTR_ERRMODE, , PDO::ErrMOde_Warning
    echo "connection successful";

    $sql = "Select * From students";
    //prepare -> sends sql statement to db to be translated for execution + prevents sql injections
    $stmt = $pdo->prepare($sql);
    //execute -> tells db to execute sql statement + extra parameters and puts it into $results
    $results = $stmt->execute();

    //$users = $dbConnection->query($sql);

    foreach($results AS $user){
        echo "<li>". $user["name"] . "<li>";
    }
} catch (PDOException $error) {
    echo $error->getMessage();
    echo $error->getCode();
}
?>