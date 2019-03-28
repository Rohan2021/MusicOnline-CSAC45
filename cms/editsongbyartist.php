<?php

	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	session_start();
	$pagename="Admin | Edit Song in Category";

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	$artists = getArtist();

	if(isset($_POST['submit'])){
		$artistId = $_POST['select_artist'];
		$lastSelectedArtist = $artistId;
		$songs = getSongByArtist($artistId);
	}

	if(isset($_POST['delete'])){
		$songInArtistId = $_POST['id'];
		deleteSongByArtist($songInArtistId);
		echo "<script>alert('Song deleted from artist');</script>";	
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>VMusic | <?php echo $pagename?></title>
	<?php include('commanhead.php'); ?>
</head>
<body>
	<?php include('commannav.php'); ?>
	<div class="addcategory home-container">
		<div class="inner-wrapper">
			<h3><i class="fa fa-cubes"></i>Edit Song by Artist / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				<?php 
				if(sizeof($artists)==0){
				?>
					<h4>You have not set any <u>artist</u> yet.</h4>
				<?php	
				} else {
				?>
					<label>Select artist</label><br>
					<select class="select" name="select_artist">
						<?php
							foreach($artists as $artist){
						?>
						<option value="<?php echo $artist['artist_id'];?>" <?php if($lastSelectedArtist == $artist['artist_id']){ echo "selected";}?> ><?php echo ucwords($artist['artist_name']);?></option>
						<?php
							}
						?>			
					</select>
					<br>
					<button class="btnsubmit" type="submit" name="submit">Show</button>
					<?php
				}
				?>
				<?php 
					if(isset($err)){
				?>
				<small style="color:#AA0606;letter-spacing: 1px">
					<?php echo $err;?>		
				</small><br>
				<?php
					}
				?>
				<?php 
					if(isset($success)){
				?>
				<small style="color:#335600;letter-spacing: 1px">
					<?php echo $success;?>		
				</small><br>
				<?php
					}
				?>

				<br><hr>
				<?php
					if(isset($_POST['submit'])){
						if(sizeof($songs)!=0){
				?>
				<table id="table">
					<tr>
						<th>Sr no.</th>
						<th>Song Name</th>
						<th>Action</th>
					</tr>
					<?php
						$count = 0;
						foreach ($songs as $song) {
							$count++;
					?>
					<tr>
						<td>
							<?php echo $count;?>
						</td>
						<td>
							<?php echo ucwords($song['song_name']);?>
						</td>
						<td>
							<form action="" method="post">
								<input type="text" name="id" value="<?php echo $song['id'];?>" hidden="true">
								<button class="btnstatus" type="submit" name="delete"><i class="fa fa-trash-o"></i></button>
							</form>
						</td>
					</tr>
					<?php
						}
					?>
				</table>
				<?php
					} else {
				?>
					<h4>You have not set any <u>song</u> by this artist.</h4>
				<?php
					}
				}
				?>
			</form>
		</div>
	</div>
	<?php include('commanfooter.php'); ?>
</body>
</html>