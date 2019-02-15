<?php
	session_start();
	
	unset($_SESSION['uid']);
	unset($_SESSION['email']);
	unset($_SESSION['fname']);
	unset($_SESSION['lname']);
	unset($_SESSION['phone']);
	unset($_SESSION['created_at']);

	session_destroy();
	header("location:index.php");
?>