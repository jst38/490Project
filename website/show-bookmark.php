<?php require_once('session.php'); ?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks
    </title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php require_once('navbar.php'); ?>
    <?php require_once('db-connect.php');  ?>
    <main>

    <div id="main">
        <?php
    if(isset($_SESSION['bookmarks'])){
        foreach($_SESSION['bookmarks'] as $item){
            $sql = 'SELECT * FROM t_members WHERE member_id=' .$item;
            $result = mysqli_query($con,$sql);
            $row1 = mysqli_fetch_array($result);
        
        ?>

        <section>
        <?php   if($row1['image']!='') { ?>
