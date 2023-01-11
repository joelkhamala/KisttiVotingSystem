<?php
session_start();
if(isset($_SESSION['admin']))
{
	unset($_SESSION['admin']);
	session_destroy();
	echo "<script>alert('loging you out...'); window.location.assign('/');</script>";
}

else if(isset($_SESSION['userAdmission']))
{
	unset($_SESSION['userAdmission']);
	session_destroy();
	echo "<script>alert('loging you out...'); window.location.assign('/');</script>";
}
?>