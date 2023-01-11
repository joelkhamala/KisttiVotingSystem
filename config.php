<?php

$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";

$con = mysqli_connect($hostname, $username, $password, $database);

// UserInput Test
function test_input($data) {
$hostname="localhost";
$username= "kisiwaev";
$password= "Nsasala2022";
$database="kisiwaev_db_evoting";

$con = mysqli_connect($hostname, $username, $password, $database);
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
$data = mysqli_real_escape_string($con, $data);
return $data;
}	

?>