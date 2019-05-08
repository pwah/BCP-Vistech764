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


$idName = $_GET['idname'];
$option = $_GET['option'];

$sql="SELECT id, program_name FROM Programs ORDER BY program_name ASC";
$retdata="";
if ($result = $con->query($sql))    {
                                        $retdata = "<select $option id='".$idName."'>";
                                            while ($row = $result->fetch_assoc())   {                                                       
                                                                                        $id = $row['id'];
                                                                                        $program_name = $row['program_name'];
                                                                                        $retdata .= "<option value='$id'>$program_name</option>";
                                                                                    }
                                    $retdata .= "</select>";
                                    }
                                    echo $retdata;
?>