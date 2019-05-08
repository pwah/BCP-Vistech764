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

//LETS RENAME THE SYSTEM
//JUST NEED  ID OF THE SYSTEM AND THE NEW NAME
//WILL RETURN THE TRUE/FALSE BACK TO THE CALLING JAVASCRIPT FUNCTION AND LET IT WORRY ABOUT IT :)
$newname = $_GET['newsysname'];
$id = $_GET['id'];

$sql="UPDATE Systems SET it_system_name='$newname' WHERE id ='$id'";
$result = mysqli_query($con,$sql);
echo true;
?>