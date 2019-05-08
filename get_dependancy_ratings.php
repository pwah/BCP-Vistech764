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

$sql="SELECT * FROM dependancy_rating ";
$retdata="";
if ($result = $con->query($sql))    {
                                        $retdata = "<select $option id='$idName' name='$idName'>";
                                            while ($row = $result->fetch_assoc())   {   
                                                                                        
                                                                                        $id = $row['id'];
                                                                                        $summary = $row['summary'];
                                                                                        $description = $row['description'];
                                                                                        $level = $row['level'];
                                                                                        $scale = $row['scale'];
                                                                                       
                                                                                        $retdata .= "<option value='$id' data-summary='$summary'data-level='$level'data-description='$description' data-scale='$scale' >$summary</option>";
                                                                                    }
                                    //add a blank function value as it may not need one
                                  

                                    $retdata .= "</select>";
                                    }
                                    echo $retdata;
?>