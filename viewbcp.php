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
header("Content-Type: application/json; charset=UTF-8");

//$sql="SELECT id, program_id, clinical_unit_id, system_id, activity_id, mtpd_id, immediate_action, work_around, creation_date, review_date, created_by FROM bcp";
/*$sql="SELECT b.id, p.program_name, c.clinical_unit, s.it_system_name, a.activity, m.mtpd, b.immediate_action, b.work_around, b.creation_date, b.review_date, b.created_by FROM bcp b, Programs p, Clinical_Unit c, Systems s, Activities a, mtdp m WHERE b.program_id = p.id AND b.clinical_unit_id = c.id AND b.system_id = s.id AND b.activity_id = a.id AND b.mtpd_id = m.id ";*/
$sql="SELECT b.id, p.program_name, c.clinical_unit, s.it_system_name, a.activity, m.mtpd, b.immediate_action, b.work_around, b.creation_date, b.review_date, b.created_by FROM bcp b LEFT JOIN Programs p ON b.program_id = p.id lEFT JOIN Clinical_Unit c ON b.clinical_unit_id = c.id LEFT JOIN Systems s ON b.system_id = s.id LEFT JOIN Activities a ON b.activity_id = a.id LEFT JOIN mtdp m ON b.mtpd_id = m.id";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);
?>