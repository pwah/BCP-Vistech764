<?php 
    session_start();
    unset($_SESSION['user']);
    session_destroy();
    header("Location: index.php"); 
    die("Redirecting to: index.php");
?>
