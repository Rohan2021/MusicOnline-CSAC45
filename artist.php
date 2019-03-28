<?php
	
	session_start();
	$pagename="Artist";

	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	$artists = getArtists();
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
				<h3>Song By Artist</h3>
				<hr>
			</div>
			<?php
				if(sizeof($artists) == 0){
			?>
				<div class="alert alert-danger">There is no artist available</div>
			<?php
				} else {
					foreach ($artists as $artist) {
			?>	
				<div class="col-lg-4 mb-2">
						<a class="btn btn-light btn-block py-3" href="song.php?artist=<?php echo $artist['artist_id'];?>"><?php echo ucwords($artist['artist_name']);?></a>
				</div>
			<?php
					}
				}
			?>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>