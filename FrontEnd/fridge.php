<!Doctype html>
    <head>
    <title>Fridge Content</title>
    </head>
<body>
            <h1 align="center"> Your Fridge </h1>
            <p><a href="https://localhost/EdamamT.html">Search Recipe</a></p>
            <form action="fridge.php" method="post">
                <h5 align="center"> Items in Fridge: <input type="text" name="items">
                <input type="submit">
                </h5>
            </form>
            <br>
        <?php echo $_POST["items"]; ?>
</body>
<style>
p {text-align: center;}
</style>
</html>
