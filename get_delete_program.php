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

//LETS RENAME THE PROGRAM
//JUST NEED THE NEWNAME AND ID OF THE OLDNAME
//WILL RETURN THE TRUE/FALSE BACK TO THE CALLING JAVASCRIPT FUNCTION AND LET IT WORRY ABOUT IT :)
$deleteprogramid = $_GET['deleteprogramid'];


$sql="DELETE FROM Programs WHERE id='$deleteprogramid'";
$result = mysqli_query($con,$sql);
echo $result;
?>