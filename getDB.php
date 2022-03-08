<?php
//Will use this function to creat existing connections to 490_db or create new ones
//and assigns it to the $db variable

function getDB(){ 
  //global $db;

  if(!isset($db)) {
    
      try {
        require_once(__DIR__. "/../lib/config.php");//pull in our credentials
          //use the variables from config to populate our connection
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        $conn = new PDO($connection_string, $user, $pass);
        $db = new PDO($connection_string, $dbuser, $dbpass);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, 1);
        $q = $conn->query();
      
      }
       $dbh = null;
       }
  catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

  }
  return $db;
}
?>