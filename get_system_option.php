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

$sql="SELECT * FROM Systems ORDER BY it_system_name ASC";
$retdata="";
if ($result = $con->query($sql))    {
                                        $retdata = "<select $option id='$idName' name='$idName'>";
                                            while ($row = $result->fetch_assoc())   {                                                       
                                                                                        $row1 = $row['id'];
                                                                                        $row2 = $row['it_system_name'];
                                                                                        $row3 = $row['it_system_description'];
                                                                                        $row4 = $row['MTPD'];
                                                                                        $retdata .= "<option value='$row1' data-sysdescr='$row3' data-mtpd='$row4'>$row2</option>";
                                                                                    }
                                   
                                    $retdata .= "</select>";
                                    }
                                    echo $retdata;
?>