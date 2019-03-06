<?php

	$db = new Database();

	function authenticate($email, $secret){
		global $db;

		$result = $db->query("select * from user where email_id = '".$email."' and password = '".$secret."'");

		if($result){
			return $result;
		} else {
			return false;
		}
	}

	function getNewSongs($row){
		global $db;
		$result = $db->query("select * from songs where year(release_date) = year(CURRENT_DATE()) AND MONTH(release_date) = MONTH(CURRENT_DATE()) LIMIT ".$row.";");
		return $result;
	}

	function getCategories($row){
		global $db;

		$result = $db->query("SELECT * FROM category LIMIT ".$row.";");
		return $result;
	}

?>