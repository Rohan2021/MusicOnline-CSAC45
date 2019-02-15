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

?>