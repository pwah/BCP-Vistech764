<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    //session_start();
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }

$cust_act = $_GET['cust_act'];

$sql="INSERT INTO activity (activity) VALUES ('$cust_act')";
error_log("The SQL = ".$sql, 0);
$con->query($sql);
?>