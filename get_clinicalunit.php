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

$sql="SELECT * FROM Clinical_Unit ORDER BY clinical_unit";
$retdata="";
if ($result = $con->query($sql))    {
                                        $retdata = "<select name='$idName' $option id='$idName'>";
                                            while ($row = $result->fetch_assoc())   {                                                       
                                                                                        $row1 = $row['id'];
                                                                                        $row2 = $row['clinical_unit'];
                                                                                        $row3 = $row['program_name'];
                                                                                        $retdata .= "<option value='$row1' data-program_name='$row3'>$row2</option>";
                                                                                    }
                                   
                                    $retdata .= "</select>";
                                    }
                                    echo $retdata;
?>