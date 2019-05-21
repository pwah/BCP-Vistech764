<?php 
//session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
    require('db.php');
    require("auth.php");
    
   if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
   }

$existing_bcp_id="";

$clinical_unit_id ="";
$selected_system_name ="";
$selected_activities_id="";

//LETS SEE IF THIS PAGE HAS BEEN CALLED BY THE FORM IF SO LETS GET THE DATA AND DO AN UPDATE/INSERT
if (isset($_POST['bcpsubmit'])) 
{ 
        if (isset($_POST['existing_bcp_id'])) { $existing_bcp_id = mysqli_real_escape_string($con,$_POST['existing_bcp_id']); }

        $clinical_unit_id = mysqli_real_escape_string($con,$_POST['cu']);
        $program_name = mysqli_real_escape_string($con,$_POST['program_name']);
        $selected_system_id = mysqli_real_escape_string($con,$_POST['selectsystemname']);
        //Deal with no input..
        if (isset($_POST['activities'])) { $activity_id = mysqli_real_escape_string($con,$_POST['activities']); }

        $cust_act_input = mysqli_real_escape_string($con,$_POST['cust_act_input']);
        $cust_act_mtpd_id = mysqli_real_escape_string($con,$_POST['new_act_mtpd']);

        $dependancy_rating = mysqli_real_escape_string($con,$_POST['the_dependancy']);
        $impact_rating_id = mysqli_real_escape_string($con,$_POST['the_impact_ref']);

        $immediate_action = mysqli_real_escape_string($con,$_POST['immediate_action']);
        $pre_req = mysqli_real_escape_string($con,$_POST['pre_req']);
        $work_around = mysqli_real_escape_string($con,$_POST['work_around']);

        $existing_bcp = mysqli_real_escape_string($con,$_POST['existingbcpid']);

        $creation_date = date("Y-m-d");

        $review_date = date("Y-m-d");
        $review_date =date('Y-m-d', strtotime('+1 year', strtotime($review_date)) );

        $created_by = $_SESSION["username"];

        $programid =  mysqli_real_escape_string($con,$_POST['sendprogramid']);




        //*********todo *
        // IF CUSTOM ACTIVITY, THEN INSERT THAT, USE IT IN DB 
        if(strlen($cust_act_input) >0)
        {
          $sql="INSERT INTO Activities (activity,MTPD) VALUES ('$cust_act_input','$cust_act_mtpd_id')";
          $result = mysqli_query($con,$sql);
          //NOW GET THE ID OF THE LAST INSERT
		  $activity_id = mysqli_insert_id($con);
		  error_log("INSERT NEW ACTIVITY");

        }
        

        //echo "<br>prog id :".$programid;
        //echo "<br>clin unit :".$clinical_unit_id;
        ////echo "<br>selected sys :". $selected_system_id;
        //echo "<br>Selected activities :". $activity_id;
        //echo "<br>cust activities mtpd id :". $cust_act_mtpd_id;
        //echo "<br>depend rating id:". $dependancy_rating;
        //echo "<br>impact rating id:". $impact_rating_id;
        ////echo "<br>immeditae:". $immediate_action;
        //echo "<br>pre-req:". $pre_req;
        //echo "<br>work around :".$work_around;
        //echo "<br>creation date:".$creation_date;
        //echo "<br>Review date:".$review_date;
        //echo "<br>created by:".$created_by;
        //echo "<br><br>";

        //echo "<br>prog name :".$program_name;
        //echo "<br><br>";


        //echo "<br>cust activities :". $cust_act_input;
        //echo "<br>existing bcp:". $existing_bcp;
        //echo "<br>creation date:". $creation_date;
        //echo "<br>review date:". $review_date;
        //echo "<br>created by:". $created_by;



        if ($existing_bcp!="0"){
                              //DO AN UPDATE TO dB if the value is   
                              //$sql="UPDATE `bcp` SET `id`=[value-1],`program_id`=[value-2],`clinical_unit_id`=[value-3],`system_id`=$programid,`activity_id`=[value-5],`mtpd_id`=[value-6],`dependancy_rating_id`=[value-7],`impact_rating_id`=[value-8],`immediate_action`=[value-9],`pre_requisites`=[value-10],`work_around`=[value-11],`creation_date`=[value-12],`review_date`=[value-13],`created_by`=[value-14] id='$existing_bcp'";
                              //$result = mysqli_query($con,$sql);
                              //echo $result;

								//echo "IS NOT";
								error_log("DOING AN UPDATE");
                              }


          if ($existing_bcp=="0"){
                              //DO AN INSERT TO dB

                              $sql="INSERT INTO bcp (program_id, clinical_unit_id, system_id, activity_id, mtpd_id, dependancy_rating_id, impact_rating_id, immediate_action, pre_requisites, work_around, creation_date, review_date, created_by) VALUES ('$programid','$clinical_unit_id', '$selected_system_id','$activity_id','$cust_act_mtpd_id','$dependancy_rating','$impact_rating_id','$immediate_action','$pre_req','$work_around','$creation_date','$review_date','$created_by')";
							  $result = mysqli_query($con,$sql);
							  error_log("Doing an INSERT");
							  error_log(mysqli_error($con));
							  error_log($sql);
                              
                              }

        //UGLY BUT WE CAN FIX THIS LATER WITH A COOL MESSAGE
            header("Location: newedit.php?info=insertedtodbok"); 

}

?>
