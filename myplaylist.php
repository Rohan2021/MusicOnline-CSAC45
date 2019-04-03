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

	if(isset($_POST['delete'])){
		$playlist_id = $_POST['pid'];
		deletePlaylist($playlist_id);
		echo "<script>alert('Playlist Removed');</script>";
		header("Refresh:0");
	}

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
								<a class="btn btn-light btn-block py-3 overlay" href="song.php?playlist=<?php echo $playlist['playlist_id'];?>"><?php echo ucwords($playlist['playlist_name']);?></a>
								<form class="btn-delete" action="" method="post">
									<input type="text" name="pid" value="<?php echo $playlist['playlist_id'];?>" hidden="">
									<button class="btn btn-danger btn-sm rounded-cstm" name="delete" type="submit"><i class="fa fa-times"></i></button>
								</form>
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