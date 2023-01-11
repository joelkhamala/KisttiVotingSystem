<?php
header('Content-Type: application/json');

require_once('config.php');

$sqlQuery = "SELECT candidate_name,votes FROM candidates ORDER BY candidate_id";

$result = mysqli_query($con,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($con);

echo json_encode($data);
?>