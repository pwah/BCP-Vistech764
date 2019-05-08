<?php

$sql = "SELECT id FROM bcp";
$result = $mysqli->query($sql);

while($row = $result->fetch_array()){

  $data[] = $row;

}


$results = ["sEcho" => 1,

        	"iTotalRecords" => count($data),

        	"iTotalDisplayRecords" => count($data),

        	"aaData" => $data ];


echo json_encode($results);


?>