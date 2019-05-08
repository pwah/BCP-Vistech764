<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    //session_start();
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
   // if(!$_SESSION['priv_level'] >= 10 ) {
  //  exit(0);
  //  }

//LETS ADD A NEW SYSTEM
 
$new_system_name = $_GET['newsysname'];
$new_it_system_description = $_GET['newsysdesc'];
$new_mtpd_val = $_GET['mtpd_val'];


$sql="INSERT INTO Systems (it_system_name, it_system_description, MTPD) VALUES ('$new_system_name','$new_it_system_description','$new_mtpd_val')";
$result = mysqli_query($con,$sql);
echo true;
?>