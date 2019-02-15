<?php
	session_start();
	
	unset($_SESSION['adminid']);
	unset($_SESSION['email']);
	unset($_SESSION['fname']);

	session_destroy();
	header("location:index.php");
?>