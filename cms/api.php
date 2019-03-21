<?php
	
	// if(!isset($pagename)){
	// 	header("location:index.php");
	// 	exit();
	// }

	$db = new Database();

	function authenticate($email, $secret){
		global $db;

		$result = $db->query("select * from admin where email = '".$email."' and password = '".$secret."'");

		if($result){
			return $result;
		} else {
			return false;
		}
	}

	function addCategory($category){
		global $db;

		if($db->query("select * from category where title = '".$category."'")){
			return false;
		}
		else{
			$result = $db->execute("insert into category(title) values ('".$category."')");
			return true;
		}
		
	}

	function getCategory(){
		global $db;
		return $db->query("select * from category");

	}

	function updateCategory($id, $category){
		global $db;
		$result = $db->execute("update category set title = '".$category."' where id = '".$id."'");
		return true;
	}

	function addSong($song,$release,$file){
		global $db;
		if($db->query("select * from songs where song_name = '".$song."' and release_date = '".$release."'")){
			return false;
		}
		else{
			$result = $db->execute("insert into songs(song_name, song_location, release_date) values ('".$song."','".$file."','".$release."')");
			return true;
		}
	}

	function getSongs(){
		global $db;
		return $db->query("select * from songs");
	}

	function updateSong($id, $song, $releasedate){
		global $db;
		$result = $db->execute("update songs set song_name = '".$song."', release_date = '".$releasedate."' where song_id = '".$id."'");
		return true;
	}

	function updateCategoryStatus($id, $status){
		global $db;
		$result = $db->execute("update category set status = '".$status."' where id = '".$id."'");
		return true;
	}

	function updateSongStatus($id, $status){
		global $db;
		$result = $db->execute("update songs set status = '".$status."' where song_id = '".$id."'");
		return true;
	}

?>