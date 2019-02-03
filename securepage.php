<?php
session_start();
require_once('db.php');
require_once("auth.php");
// Going to use 'require' rather than include for security purposes, because require will kill the php if it cant get the file, whereas include just produces a warning.
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'head.php'?>
        <meta charset="utf-8">
        <title>Dashboard - Logged in</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <?php include 'navbar.php' ?>

        <div class="container form">
        <br>


        </div>
        <?php include 'footer.php'?>
        <?php include 'jsboot.php'?>
    </body>
</html>