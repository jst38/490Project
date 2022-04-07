<?php
    if (isset($_POST['submit'])) {
        $connection = new mysqli( host: "localhost", username: "root, passwd: "", dbname:"phpSearch");
        $q = $connection->real_escape_string($_POST['q']);
        $column = $connection->real_escape_string($_POST['q']);

        if ($column == "" || ($column != "firstName" && $column != "lastName"))
            $column = "firstName";

        $data = $connection->query( query: "SELECT firstName FROM users WHERE $column LIKE '%$q%'");
        if (data->num_rows > 0) {

        } else
            echo "Your search query doesn't match any data!";
    }
?>
<html>
    <head>
        <title>PHP Seach Form</title>
    </head>
    <body>
        <form method="post" action "search.php">
            <input type="text" name="q" placeholder="Search Query..."
            <select name ="column">
                <option value="">Select filter</option>
                <option value="firstName">First Name</option>
                <option value="lastName">Last Name</option>
            </select>
            <input type="submit" name="submit" value="Find">
        </form>
    </body>
</html>
