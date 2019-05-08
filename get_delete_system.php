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

//LETS DELETE THE SYSTEM
//JUST NEED THE ID 

$id = $_GET['id'];

$sql="DELETE FROM Systems WHERE id ='$id'";
$result = mysqli_query($con,$sql);
echo true;
?>