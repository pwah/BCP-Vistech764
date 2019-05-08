<?php 
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }
// THIS gets the list of Clinical Units  [clinical_unit and program and fills in checkboxes]
$cu = $_GET['cu'];
//$sql="SELECT * FROM Clinical_Unit WHERE clinical_unit= '".$cu."'";

$sql="SELECT * FROM Clinical_Unit";
if ($result = $con->query($sql))  {
                                        echo "<select name='clinprogram' id='clinprogram'>";
                                            while ($row = $result->fetch_assoc())   {
                                                                                        $program_name = $row['program_name'];
                                                                                        $clinicalunit_name = $row['clinical_unit'];
                                                                                        $rowid = $row['id'];
                                                                                        if($cu===$clinicalunit_name){
                                                                                            echo "<option value='$rowid' selected class='redcolor'>$program_name</option>";
                                                                                        }else{
                                                                                        echo "<option value='$rowid'>$program_name</option>";
                                                                                        }
                                                                                    }
                                        echo "</select>";
                                    }
?>