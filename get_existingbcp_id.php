<?php 
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }
// THIS goes out to see if there is an existing BCP and return its id.If 0 then nothing found.

$id_clinical = $_GET['id_clinical'];
$id_system = $_GET['id_system'];
$id_activity = $_GET['id_activity'];

$row1 =0;

$sql="SELECT * FROM bcp WHERE clinical_unit_id ='$id_clinical' AND system_id='$id_system' AND activity_id='$id_activity'";

if ($result = $con->query($sql)){
    while ($row = $result->fetch_assoc())   {                                                       
                                            $row1 = $row['id'];
                                            }                       
    }
    
echo $row1;

?>