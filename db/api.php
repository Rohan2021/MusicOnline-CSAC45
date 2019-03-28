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

	function addUser($firstname,$lastname,$mobile,$email,$password){
		global $db;
		$res = $db->query("SELECT * FROM user WHERE email_id = '".$email."'");
		if(sizeof($res) > 0){
			return false;
		}
		$db->execute("INSERT INTO user(first_name,last_name,email_id,password,phone_number) VALUES('".$firstname."','".$lastname."','".$email."','".$password."','".$mobile."')");
		return true;
	}

	function getNewSongs($row){
		global $db;
		return $db->query("select * from songs where year(release_date) = year(CURRENT_DATE()) AND MONTH(release_date) = MONTH(CURRENT_DATE()) LIMIT ".$row.";");
	}

	function getCategories($row){
		global $db;
		return $db->query("SELECT * FROM category LIMIT ".$row.";");
	}

	function getCategorys(){
		global $db;
		return $db->query("SELECT * FROM category");
	}

	function getArtists(){
		global $db;
		return $db->query("SELECT * FROM artists");
	}

	function getAlbums(){
		global $db;
		return $db->query("SELECT * FROM album");
	}

	function createPlaylist($playlistname,$uid){
		global $db;
		$res = $db->query("SELECT * from playlist where user_id = '".$uid."' and playlist_name = '".$playlistname."' ");
		if(sizeof($res) > 0){
			return false;
		}

		$db->execute("INSERT INTO playlist(user_id,playlist_name) values('".$uid."','".$playlistname."')");
		return true;
	}

	function getPlaylist($uid){
		global $db;
		return $db->query("SELECT * from playlist where user_id = ".$uid."");
	}

	function checkPlaylist($playlistid,$uid){
		global $db;
		$res = $db->query("SELECT * from playlist where user_id = '".$uid."' and playlist_id = '".$playlistid."' ");
		if(sizeof($res) > 0){
			return true;
		}
		return false;
	}	

	function getSongByAlbum($albumId){
		global $db;
		return $db->query("SELECT songs.song_name,songs.song_location,songs.status,album_song.song_id FROM songs,album_song where songs.song_id = album_song.song_id and album_song.album_id = ".$albumId."");
	}
?>