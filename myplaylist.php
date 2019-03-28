<?php
	
	session_start();
	$pagename="My Playlist";

	if(!isset($_SESSION['uid'])){
		header('location:index.php');
		exit();
	}

	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	$playlists = getPlaylist($_SESSION['uid']);

?>
<!DOCTYPE html>
<html>
<head>
	<title>VMusic | <?php echo $pagename?></title>
	<?php include('commanhead.php'); ?>
</head>
<body>
	<?php include('commannav.php'); ?>

	<div class="container">
		<div class="row box-bg" style="margin: 0px;">
			<div class="col-12 mb-3">
				<div class="row">
					<div class="col-6"><h3>My Playlist</h3></div>
					<div class="col-6 text-right"><a class="btn btn-sm btn-outline-light" href="createplaylist.php"><i class="fa fa-plus"></i> Create Playlist</a></div>
				</div>
				<hr>
				<div class="row">
					<?php
						if(sizeof($playlists) == 0){
					?>
							<div class="alert alert-danger">There is no playlist created by you.</div>
					<?php
						} else {
							foreach ($playlists as $playlist) {
					?>
							<div class="col-lg-4 mb-2">
								<a class="btn btn-light btn-block py-3" href="song.php?playlist=<?php echo $playlist['playlist_id'];?>"><?php echo ucwords($playlist['playlist_name']);?></a>
							</div>
					<?php
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>