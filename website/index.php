done by Denise

<?php
$session_token = $_COOKIE["session_token"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Index Page</title>
    </head>
    <body>
        <h1>Home Page</h1>
        <?php if ($session_token === null || $session_token === 0) { ?>
            <a href="login.php"> Login </a>
            <a href="register.php"> Register </a>
        <?php } else { ?>
            <a href="whats_in_fridge.php"> Register </a>
            <a href="search_recipes.php"> Register </a>
        <?php } ?>
    </body>
</html>