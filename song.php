<?php
	
	session_start();
	$pagename="";


	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	$playlists = getPlaylist($_SESSION['uid']);

	if(isset($_POST['removesong'])){
		$psid = $_POST['psid'];
		deleteSongFromPlaylist($psid);
		echo "<script>alert('Song removed from playlist');</script>";
		header("Refresh:0");

	}

	if(isset($_GET['artist'])){
		$pagename = "Artist";
		$songs = getSongByArtist($_GET['artist']);
	}
	else if(isset($_GET['album'])){
		$pagename = "Album";
		$songs = getSongByAlbum($_GET['album']);
	}
	else if(isset($_GET['genre'])){
		$pagename = "Genre/Category";
		$songs = getSongByGenre($_GET['genre']);
	}
	else if(isset($_GET['searchbox'])){
		$pagename = "Search \"".$_GET['searchbox']."\"";
		$songs = searchSong(trim(strtolower($_GET['searchbox'])));
	}
	else if(isset($_GET['playlist']) and isset($_SESSION['uid'])){
		if(checkPlaylist($_GET['playlist'],$_SESSION['uid'])){
			$pagename = "My Playlist";
			$songs = getSongByPlaylist($_GET['playlist']);
		} else {
			header("location:myplaylist.php");
		}
	}
	else{
		header("location:index.php");
	}

	if(isset($_POST['addtoplaylist'])){
		$songId = $_POST['id'];
		$playlistId = $_POST['selPlaylist'];

		if(addSongToPlaylist($playlistId,$songId)){
			echo "<script>alert('Song added to playlist');</script>";
		}
		else{
			echo "<script>alert('Song already in playlist');</script>";
		}
	}



?>
<!DOCTYPE html>
<html>
<head>
	<title>VMusic | <?php echo $pagename;?></title>
	<?php include('commanhead.php'); ?>
</head>
<body>
	<?php include('commannav.php'); ?>

	<div class="container">
		<div class="row box-bg" style="margin: 0px;">
			<div class="col-12 mb-3">
				<h3>Song | <?php echo $pagename;?></h3>
				<hr>
				<?php
				if(sizeof($songs) > 0){
				?>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Song Name</th>
							<th scope="col">Play</th>
							<?php if(isset($_SESSION['uid']) and $pagename != "My Playlist"){
							?>
								<th scope="col">Add to Playlist</th>
							<?php
							}
							else if($pagename == "My Playlist"){
							?>
								<th scope="col">Remove from Playlist</th>
							<?php
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php
							$count = 0;
							foreach ($songs as $song) {
								if($song['status'] == 1){
									$count++;
						?>
							<tr class="bg-light">
								<td class="align-middle"><?php echo $count; ?></td>
								<td class="align-middle"><?php echo ucwords($song['song_name']); ?></td>
								<td class="align-middle">
									<audio controls>
										<source src="songs/<?php echo $song['song_location']; ?>" type="audio/mpeg" >
									</audio>
								</td>
								<?php if(isset($_SESSION['uid']) and $pagename != "My Playlist"){ ?>
								<td class="align-middle">
									<form class="form-inline form-inline-sm" action="" method="post">
										<input type="text" name="id" value="<?php echo $song['song_id']?>" hidden="">
										<select class="form-control mr-1" name="selPlaylist">
											<?php foreach ($playlists as $playlist) { ?>
												<option value="<?php echo $playlist['playlist_id'];?>">
													<?php echo ucwords($playlist['playlist_name']);?>
												</option>
											<?php } ?>
										</select>
										<button class="btn btn-success" type="submit" name="addtoplaylist"><i class="fa fa-plus"></i></button>
									</form>
								</td>
								<?php }
								else if($pagename == "My Playlist"){
								?>
								<td class="align-middle">
									<form action="" method="post">
										<input type="text" name="psid" value="<?php echo $song['ps_id']?>" hidden="">
										<button class="btn btn-danger" name="removesong" type="submit"><i class="fa fa-times"></i></button>
									</form>
								</td>
								<?php } ?>
							</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
				<?php
					} else {
				?>
					<div class="alert alert-danger">There is no song.</div>
				<?php 
					}
				?>
			</div>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>

	<script type="text/javascript">
		function addToPlaylist(this){

		}
	</script>
</body>
</html>