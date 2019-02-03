<?php
// This scipt tests to see if the session key username has anything in it to prove that you are authenticated(Else you get booted back to the login.php page). We could do more here to make this more robust, but for the moment this will do for the project
// We should also look at adding in other session variables for such as priv levels
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>