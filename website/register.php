<?php
//get this producer to work!!
//Send message to exchange first, then based on rule/routing keys send msg to the right queue
//routing keys enable you to bind queues to exchanges
//RabbitMQ will look at routing key in $msg and the ones that bind the queue to the exchange to determine which queue to send msg too.

?>

<!DOCTYPE html>
<html>
    <body>
        <h1> Register Page</h1>

        <form action="start_rpc_Client.php" method="POST" >
            <label>for="email">email:></label>
            <input type="text" id="email" name="email"><br><br>

            <label>for="fname">First name:></label>
            <input type="text" id="fname" name="fname"><br><br>

            <label>for="lname">Last name:></label>
            <input type="text" id="lname" name="lname"><br><br>

            <label>for="username">Username:></label>
            <input type="text" id="username" name="username"><br><br>

            <label>for="password">Password:></label>
            <input type="text" id="password" name="password"><br><br>
        </form>
    </body>
</html>