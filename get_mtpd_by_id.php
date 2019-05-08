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

//INPUT = MTPD ID, OUTPUT IS THE ASSOCIATED MTPD NAME.
$idName = $_GET['idname'];

$sql="SELECT * FROM mtdp WHERE id='$idName'";
$result = $con->query($sql);
$row=mysqli_fetch_assoc($result);
echo $row['mtpd'];
mysqli_free_result($result);
                          
?>