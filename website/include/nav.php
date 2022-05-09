<link rel="stylesheet" href="static/styles.css">
<?php
//we'll be including this on most/all pages so it's a good place to include anything else we want on those pages
require_once(__DIR__ . "/../lib/functions.php");
?>
<nav>
<ul class="nav">
    <li><a href="home.php">Home</a></li>
    <?php if (!is_logged_in()): ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    <?php endif; ?>
    <?php if (has_role("Admin")): ?> 
            <li><a href="search.php">Search Receipes</a></li>
            <li><a href="bookmark.php">Bookmarked Receipes</a></li>
            <li><a href="fridge.php">My Fridge</a></li>
             <li><a href="logout.php">Logout</a></li>
    <?php endif; ?>
</ul>
</nav>