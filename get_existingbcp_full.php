<?php 
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }
// THIS goes out to the dB and gets all the data

$id = $_GET['id'];

$sql="SELECT * FROM bcp WHERE id = '".$id."'";

$sendback = NULL;
$row = NULL;

if ($result = $con->query($sql))    { 
                                            while ($row = $result->fetch_assoc())   {   
                                                                                        $sendback->id = $row['id'];
                                                                                        $sendback->program_id = $row['program_id'];
                                                                                        $sendback->clinical_unit_id = $row['clinical_unit_id'];
                                                                                        $sendback->system_id = $row['system_id'];
                                                                                        $sendback->activity_id = $row['activity_id'];
                                                                                        $sendback->mtpd_id = $row['mtpd_id'];
                                                                                        $sendback->dependancy_rating_id = $row['dependancy_rating_id'];
                                                                                        $sendback->impact_rating_id = $row['impact_rating_id'];
                                                                                        $sendback->immediate_action = $row['immediate_action'];
                                                                                        $sendback->pre_requisites = $row['pre_requisites'];
                                                                                        $sendback->work_around = $row['work_around'];
                                                                                        $sendback->creation_date = $row['creation_date'];
                                                                                        $sendback->review_date = $row['review_date'];
                                                                                        $sendback->created_by = $row['created_by'];
                                                                                    }                       
                                           // $sendback = array($catagory, $function);  
                                            $sendbackJSON = json_encode($sendback);      
                                                                                  
                                    }
                                    echo  $sendbackJSON;
?>