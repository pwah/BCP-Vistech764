<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    //session_start();
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }

$id = $_GET['id'];

$sql="SELECT * FROM system_register WHERE id = '".$id."'";
$itsystemname = null;


if ($result = $con->query($sql))    { 
                                            while ($row = $result->fetch_assoc())   {   
                                                $itsystemname = $row['it_system_name'];                                                                                      
                                                                                    }                       
                                            $sendback = array($itsystemname);  
                                            $sendbackJSON = json_encode($sendback);      
                                    }
                                    echo  $sendbackJSON;
?>