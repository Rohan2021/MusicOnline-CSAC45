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

	// Category Function Start ====================================

	function addCategory($category){
		global $db;

		if($db->query("select * from category where title = '".$category."'")){
			return false;
		}
		else{
			$result = $db->execute("insert into category(title,status) values ('".$category."',1)");
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

	function updateCategoryStatus($id, $status){
		global $db;
		$result = $db->execute("update category set status = '".$status."' where id = '".$id."'");
		return true;
	}

	// Category Function End =======================================



	// Song Function Start   =======================================
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


	function updateSongStatus($id, $status){
		global $db;
		$result = $db->execute("update songs set status = '".$status."' where song_id = '".$id."'");
		return true;
	}
	// Song Function End =======================================


	// Album Function Start =======================================
	function addAlbum($album){
		global $db;

		if($db->query("select * from album where album_name = '".$album."'")){
			return false;
		}
		else{
			$result = $db->execute("insert into album(album_name) values ('".$album."')");
			return true;
		}
		
	}

	function getAlbum(){
		global $db;
		return $db->query("select * from album");

	}

	function updateAlbum($id, $album){
		global $db;
		$result = $db->execute("update album set album_name = '".$album."' where album_id = '".$id."'");
		return true;
	}
	// Album Function End   =======================================


	// Artist Function Start =======================================
	function addArtist($artist){
		global $db;

		if($db->query("select * from artists where artist_name = '".$artist."'")){
			return false;
		}
		else{
			$result = $db->execute("insert into artists(artist_name) values ('".$artist."')");
			return true;
		}
		
	}

	function getArtist(){
		global $db;
		return $db->query("select * from artists");

	}

	function updateArtist($id, $artist){
		global $db;
		$result = $db->execute("update artists set artist_name = '".$artist."' where artist_id = '".$id."'");
		return true;
	}
	// Artist Function End   =======================================

	// Song in Category Function Start =======================================
	function addSongToCategory($categoryid,$songid){
		global $db;
		if($db->query("select * from category_song where cat_id = '".$categoryid."' and song_id = '".$songid."' ")){
			return false;
		}
		else{
			$result = $db->execute("insert into category_song(cat_id,song_id) values (".$categoryid.",".$songid.")");
			return true;
		}
	}

	function getSongInCategory($id){
		global $db;
		return $db->query("SELECT category_song.id, songs.song_name from category_song,songs WHERE songs.song_id = category_song.song_id and category_song.cat_id = ".$id."");
	}

	function deleteSongInCategory($songInCategoryId){
		global $db;
		$db->execute("DELETE FROM category_song where id = ".$songInCategoryId."");
	}
	// Song in Category Function End   =======================================


	// Song in album function start ==========================================
	function addSongToAlbum($albumid,$songid){
		global $db;
		if($db->query("select * from album_song where album_id = '".$albumid."' and song_id = '".$songid."' ")){
			return false;
		}
		else{
			$result = $db->execute("insert into album_song(album_id,song_id) values (".$albumid.",".$songid.")");
			return true;
		}
	}

	function getSongInAlbum($id){
		global $db;
		return $db->query("SELECT album_song.id, songs.song_name from album_song,songs WHERE songs.song_id = album_song.song_id and album_song.album_id = ".$id."");
	}

	function deleteSongInAlbum($songInAlbumId){
		global $db;
		$db->execute("DELETE FROM album_song where id = ".$songInAlbumId."");
	}
	// Song in album function end   ==========================================+


	// Song by artist function start ==========================================
	function addSongToArtist($artistId,$songId){
		global $db;
		if($db->query("select * from artist_song where artist_id = '".$artistId."' and song_id = '".$songId."' ")){
			return false;
		}
		else{
			$result = $db->execute("insert into artist_song(artist_id,song_id) values (".$artistId.",".$songId.")");
			return true;
		}
	}
	function getSongByArtist($artistId){
		global $db;
		return $db->query("SELECT artist_song.id, songs.song_name from artist_song,songs WHERE songs.song_id = artist_song.song_id and artist_song.artist_id = ".$artistId."");
	}

	function deleteSongByArtist($songInArtistId){
		global $db;
		$db->execute("DELETE FROM artist_song where id = ".$songInArtistId."");
	}
	// Song by artist function end   ==========================================
?>