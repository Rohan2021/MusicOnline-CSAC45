<?php
	
	session_start();
	$pagename="Album";

	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	$albums = getAlbums();
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
				<h3>Song By Albums</h3>
				<hr>
			</div>
			<?php
				if(sizeof($albums) == 0){
			?>
				<div class="alert alert-danger">There is no album available</div>
			<?php
				} else {
					foreach ($albums as $album) {
			?>	
				<div class="col-lg-4 mb-2">
						<a class="btn btn-light btn-block py-3" href="song.php?album=<?php echo $album['album_id'];?>"><?php echo ucwords($album['album_name']);?></a>
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