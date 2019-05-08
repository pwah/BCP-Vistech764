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


$id = $_GET['act_id'];

$sql="DELETE FROM Activities WHERE id ='$id'";
$result = mysqli_query($con,$sql);
echo true;
?>