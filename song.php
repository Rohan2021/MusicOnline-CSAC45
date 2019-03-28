<?php
	
	session_start();
	$pagename="";


	include("db/config.php");
	include("db/db.php");
	include("db/api.php");


	if(isset($_GET['artist'])){
		$pagename = "Artist";
	}
	else if(isset($_GET['album'])){
		$pagename = "Album";
		$songs = getSongByAlbum($_GET['album']);
	}
	else if(isset($_GET['genre'])){
		$pagename = "Genre/Category";
	}
	else if(isset($_GET['playlist'])){
		if(checkPlaylist($_GET['playlist'],$_SESSION['uid'])){
			$pagename = "My Playlist";
		} else {
			header("location:myplaylist.php");
		}
	}
	else{
		header("location:index.php");
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
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Song Name</th>
							<th scope="col">Play</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$count = 0;
							foreach ($songs as $song) {
								if($song['status'] == 1){
									$count++;
						?>
							<tr>
								<td class=""><?php echo $count; ?></td>
								<td><?php echo ucwords($song['song_name']); ?></td>
								<td>
									<audio controls>
										<source src="songs/<?php echo $song['song_location']; ?>" type="audio/mpeg" >
									</audio>
								</td>
							</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>