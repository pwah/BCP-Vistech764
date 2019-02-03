<?php
// Enter your Host, username, password, database below.
// Clearly localhost could be changed to an ip address of the database rather than 127.0.0.1( as its currently hosted all togther )
$dB_address = "localhost";
$db_username = "deakin";
$db_password = "sit764";
$db_name = "bcp";
$con = mysqli_connect($dB_address,$db_username,$db_password,$db_name);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit(0);
  }

  function dbinsert($sql){
  global $con;
  $result = mysqli_query($con,$sql);
  return $result;
  }

  function dbupdate($sql){
    global $con;
    $result = mysqli_query($con,$sql);
    return $result;

  }

  

?>