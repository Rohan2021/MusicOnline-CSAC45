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

	function getSongByArtist($artistId){
		global $db;
		return $db->query("SELECT songs.song_name,songs.song_location,songs.status,artist_song.song_id FROM songs,artist_song where songs.song_id = artist_song.song_id and artist_song.artist_id = ".$artistId."");
	}

	function getSongByGenre($genreId){
		global $db;
		return $db->query("SELECT songs.song_name,songs.song_location,songs.status,category_song.song_id FROM songs,category_song where songs.song_id = category_song.song_id and category_song.cat_id = ".$genreId."");
	}

	function getSongByPlaylist($playlistId){
		global $db;
		return $db->query("SELECT songs.song_name,songs.song_location,songs.status,playlist_songs.ps_id FROM songs,playlist_songs where songs.song_id = playlist_songs.song_id and playlist_songs.playlist_id = ".$playlistId."");
	}

	function addSongToPlaylist($playlistId,$songId){
		global $db;
		$res = $db->query("SELECT * from playlist_songs where playlist_id = '".$playlistId."' and song_id = '".$songId."' ");

		if(sizeof($res) > 0){
			return false;
		}

		$db->execute("INSERT INTO playlist_songs(playlist_id,song_id) values(".$playlistId.",".$songId.")");
		return true;
	}

	function deleteSongFromPlaylist($psid){
		global $db;
		$db->execute("DELETE FROM playlist_songs where ps_id = ".$psid."");
	}

	function searchSong($keyword){
		global $db;
		return $db->query("SELECT song_name,song_location,status,song_id FROM songs where song_name LIKE '%".$keyword."%'");
	}

	function deletePlaylist($pid){
		global $db;
		$db->execute("DELETE FROM playlist where playlist_id = ".$pid."");
	}
?>

