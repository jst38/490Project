
<!--DOCTYPE html-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>
    <form action="registerUser.php" method="post">

    <label for="input-email">
            email
            <input type="text" name="email" id="email-username">
        </label>

    <label for="input-firstname">
            firstname
            <input type="text" name="firstname" id="input-firstname">
        </label>

    <label for="input-lastname">
            lastname
            <input type="text" name="lastname" id="input-lastname">
        </label>        

    <label for="input-username">
            username
            <input type="text" name="username" id="input-username">
        </label>
        
    
    <label for="input-password">
            Password
            <input type="password" name="password" id="input-password">
        </label>
        <input type="submit" value="Login">
    </form>
</body>
</html>
<?php

require_once(__DIR__ . "/rpc/getdb.php");
$db = getDB();
    if(isset($db)){
        echo"db is set";
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $salt = random_bytes(16);
    $password_hash = hash("sha256", $salt . $password, true);

    $query = $mysql->prepare(
        "INSERT INTO user(
            email,
            firstname,
            lastname,
            username,
            password_hash,
            salt
        ) VALUES (
            :email, 
            :Fname, 
            :nLame, 
            :username, 
            :password
        )");
        
    $query->bind_param("sss", $username, $password_hash, $salt);
    if ($query->execute())
        echo "Success";
    else
        echo "Failure";
}
?>