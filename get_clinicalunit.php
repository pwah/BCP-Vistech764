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

// THIS GOES OUT AND GETS THE CLINICAL UIT TABLES, IT ALSO GETS THE ASSOCIATED PROGRAM ID OF THE PROGRAM_NAME FROM THE PROGRAMS TABLE AND INSERTS THAT AS HIDDEN DATA.
$idName = $_GET['idname'];
$option = $_GET['option'];

$sql="SELECT * FROM Clinical_Unit ORDER BY clinical_unit";
$retdata="";
$row4="";
if ($result = $con->query($sql))    {
                                        $retdata = "<select name='$idName' $option id='$idName'>";
                                            while ($row = $result->fetch_assoc())   {                                                       
                                                                                        $row1 = $row['id'];
                                                                                        $row2 = $row['clinical_unit'];
                                                                                        $row3 = $row['program_name'];
                                                                                            $sqlprog = "SELECT id from Programs WHERE program_name='$row3'";
                                                                                            if ($resultprog = $con->query($sqlprog)){
                                                                                                while ($rowprog = $resultprog->fetch_assoc())   { 
                                                                                                    $row4 = $rowprog['id'];
                                                                                                }    
                                                                                            }
                                                                                        $retdata .= "<option value='$row1' data-program_name='$row3' data-programid ='$row4'>$row2</option>";
                                                                                        $row4="";
                                                                                    }
                                   
                                    $retdata .= "</select>";
                                    }
                                    echo $retdata;
?>