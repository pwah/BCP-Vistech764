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

//LET UPDATE THE SYSTEM
//JUST NEED THE NEWNAME AND ID OF THE OLDNAME
//WILL RETURN THE TRUE/FALSE BACK TO THE CALLING JAVASCRIPT FUNCTION AND LET IT WORRY ABOUT IT :)

$id = $_GET['id'];
$system_desc=$_GET['sys_desc'];
$MTPD_id=$_GET['mtpd_id'];

$sql="UPDATE Systems SET it_system_description='$system_desc',MTPD='$MTPD_id' WHERE id ='$id'";
$result = mysqli_query($con,$sql);
echo true;
?>