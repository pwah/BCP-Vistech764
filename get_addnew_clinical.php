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

//LETS ADD A NEW CLINICAL UNIT
//JUST NEED THE NEWNAME AND ID OF THE OLDNAME
//WILL RETURN THE TRUE/FALSE BACK TO THE CALLING JAVASCRIPT FUNCTION AND LET IT WORRY ABOUT IT :)
$new_clinical_name = $_GET['newname'];
$new_clin_associated_program = $_GET['associatedprogram'];


$sql="INSERT INTO Clinical_Unit (clinical_unit, program_name) VALUES ('$new_clinical_name','$new_clin_associated_program')";
$result = mysqli_query($con,$sql);
echo true;
?>