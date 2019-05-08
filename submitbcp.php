<?php 
//SO THIS WILL GET ALL THE INPUTS, IT WILL CHECK TO SEE IF THIS IS AN UPDATE OR A NEW INSERT

error_reporting(E_ALL);
ini_set('display_errors', 1);
    //session_start();
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
   // if(!$_SESSION['priv_level'] >= 10 ) {
  //  exit(0);
  //  }
$existing_bcp_id="";

$clinical_unit_id ="";
$selected_system_name ="";
$selected_activities_id="";


if (isset($_POST['bcpsubmit'])) { 
if (isset($_POST['existing_bcp_id'])) { $existing_bcp_id = mysqli_real_escape_string($con,$_POST['existing_bcp_id']); }

$clinical_unit_id = mysqli_real_escape_string($con,$_POST['cu']);
$program_name = mysqli_real_escape_string($con,$_POST['program_name']);
$selected_system_id = mysqli_real_escape_string($con,$_POST['selectsystemname']);
//Deal with no input..
if (isset($_POST['activities'])) { $selected_activities_id = mysqli_real_escape_string($con,$_POST['activities']); }

$cust_act_input = mysqli_real_escape_string($con,$_POST['cust_act_input']);
$cust_act_mtpd_id = mysqli_real_escape_string($con,$_POST['new_act_mtpd']);

$dependancy_rating = mysqli_real_escape_string($con,$_POST['the_dependancy']);
$impact_rating_id = mysqli_real_escape_string($con,$_POST['the_impact_ref']);

$immediate_action = mysqli_real_escape_string($con,$_POST['immediate_action']);
$pre_req = mysqli_real_escape_string($con,$_POST['pre_req']);
$work_around = mysqli_real_escape_string($con,$_POST['work_around']);
$existing_bcp = mysqli_real_escape_string($con,$_POST['exitingbcpid']);


//Convert Program Name to ID




echo "clin unit :".$clinical_unit_id;
echo "<br>prog name :".$program_name;
echo "<br>selected sys :". $selected_system_id;
echo "<br>Selected activities :". $selected_activities_id;
echo "<br>cust activities :". $cust_act_input;
echo "<br>cust activities mtpd id :". $cust_act_mtpd_id;
echo "<br>depend rating id:". $dependancy_rating;
echo "<br>impact rating id:". $impact_rating_id;

echo "<br>immeditae:". $immediate_action;
echo "<br>pre-req:". $pre_req;
echo "<br>work_around:". $work_around;

if ($existing_bcp!="0"){
  //DO AN UPDATE TO dB
  //$sql="UPDATE `bcp` SET `id`=[value-1],`program_id`=[value-2],`clinical_unit_id`=[value-3],`system_id`=[value-4],`activity_id`=[value-5],`mtpd_id`=[value-6],`dependancy_rating_id`=[value-7],`impact_rating_id`=[value-8],`immediate_action`=[value-9],`pre_requisites`=[value-10],`work_around`=[value-11],`creation_date`=[value-12],`review_date`=[value-13],`created_by`=[value-14] id='$existing_bcp'";
  //$result = mysqli_query($con,$sql);
  //echo $result;

}


  if ($existing_bcp=="0"){
    //DO AN INSERT TO dB

//$sql="INSERT INTO bcp (program_id, clinical_unit_id, system_id, activity_id, mtpd_id, dependancy_rating_id, impact_rating_id, immediate_action, pre_requisites, work_around, creation_date, review_date, created_by) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13])";
//$result = mysqli_query($con,$sql);
//echo $result;
  }





 }




?>