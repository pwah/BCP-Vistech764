<?php 
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }
// THIS gets the descriptions for each system requested
$sysid = $_GET['sysid'];

$sql="SELECT * FROM Systems WHERE id = '".$sysid."'";
if ($result = $con->query($sql))  {
                                       
                                           if ($row = $result->fetch_assoc())   {
                                                                                        $it_system_description = $row['it_system_description'];
                                                                                        echo $it_system_description;
                                                                                }
                                    }
?>