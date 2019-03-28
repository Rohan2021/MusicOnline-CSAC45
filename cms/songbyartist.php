<?php
	session_start();
	$pagename="Admin | Add Song by Artist";

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	$artists = getArtist();
	$songs = getSongs();

	if(isset($_POST['submit'])){
		$artistId = $_POST['select_artist'];
		$songId = $_POST['select_song'];

		if(addSongToArtist($artistId,$songId)){
			$success="Song is set to Artist";
		}
		else{
			$err = "Song already set to Artist";
		}
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
			<h3><i class="fa fa-cubes"></i>Add Song by Artist / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				<?php 
				if(sizeof($artists)==0){
				?>
					<h4>You have not added any <u>Artist</u> yet.</h4>
				<?php	
				} else {
				?>
					<label>Select Artist</label><br>
					<select class="select" name="select_artist">
						<?php
							foreach($artists as $artist){
						?>
						<option value="<?php echo $artist['artist_id'];?>"><?php echo $artist['artist_name'];?></option>
						<?php
							}
						?>			
					</select>
					<br>
					<?php 
					if(sizeof($songs)==0){
					?>
						<h4>You have not added any song yet.</h4>
					<?php	
					} else {
					?>
						<label>Select Song to add in album</label><br>
						<select class="select" name="select_song">
							<?php
								foreach($songs as $song){
							?>
							<option value="<?php echo $song['song_id'];?>"><?php echo $song['song_name']." ".$song['release_date'];?></option>
							<?php
								}
							?>		
						</select>
						<br>
						<button class="btnsubmit" type="submit" name="submit">Add Song</button>
					<?php
					}
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
			</form>
		</div>
	</div>
	<?php include('commanfooter.php'); ?>
</body>
</html>