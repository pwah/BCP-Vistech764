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

$sql="SELECT * FROM impact_reference ORDER BY IR ASC ";
$retdata="";
if ($result = $con->query($sql))    {
                                        $retdata = "<select $option id='$idName' name='$idName'>";
                                            while ($row = $result->fetch_assoc())   {   
                                                                                        
                                                                                        $id = $row['id'];
                                                                                        $ir = $row['IR'];
                                                                                        $pe = $row['People_Effects'];
                                                                                        $fi = $row['Financial_Impact'];
                                                                                        $rep = $row['Reputation'];
                                                                                        $so = $row['Service_Outputs'];
                                                                                        $lc = $row['Legal_Compliance'];
                                                                                        $mi = $row['Management_Impact'];
                                                                                        
                                                                                        $retdata .= "<option value='$id' data-pe='$pe' data-fi='$fi' data-rep='$rep' data-so='$so' data-lc='$lc' data-mi='$mi' >$ir</option>";
                                                                                    }
                                    //add a blank function value as it may not need one
                                  

                                    $retdata .= "</select>";
                                    }
                                    echo $retdata;
?>