<?php 
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }
// THIS gets the list of sub programs AKA clinical programs and fills out the html options for the bs1_sysdepass.php file
$program = $_GET['program'];

$sql="SELECT * FROM clinical_program WHERE program = '".$program."'";
if ($result = $con->query($sql))  {
                                        echo "<select name='clinical' id='subclinic'>";
                                            while ($row = $result->fetch_assoc())   {
                                                                                        $clinical_unit = $row['clinical_unit'];
                                                                                        $rowid = $row['id'];
                                                                                        echo "<option value='$rowid'>$clinical_unit</option>";
                                                                                    }
                                        echo "</select>";
                                    }
?>