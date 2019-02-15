<?php
	session_start();
	$pagename="Admin | Edit Song";

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}
	include("../db/config.php");
	include("../db/db.php");
	include("api.php");
	$songs = getSongs();

	if(isset($_POST['updatesong'])){
		$song = strtolower(trim($_POST['song']));
		$releasedate = $_POST['songdate'];
		$songid = $_POST['songsel'];
		if(empty($song)){
			$err = "Song name Field Requiered.";
		}
		else if(empty($releasedate)){
			$err = "Release Date Field Requiered.";
		}
		else{
			$result = updateSong($songid,$song,$releasedate);
			$success = "Song Detail Updated Successfully";
			$songs = getSongs();
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
		<div class="inner-wrapper" style="height: 460px;">
			<h3><i class="fa fa-cubes"></i>Edit Song / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				<?php 
				if(sizeof($songs)==0){
				?>
				<h4>You have not added any song yet.</h4>
				<?php	
				} else {
				?>
				<label>Select Song to Edit</label><br>
				<select class="select" name="songsel">
					<?php
						foreach($songs as $song){
					?>
					<option value="<?php echo $song['song_id'];?>"><?php echo $song['song_name']." ".$song['release_date'];?></option>
					<?php
						}
					?>		
				</select>
				<br>

				<label>Enter Song to Name Change</label><br>
				<input name="song" class="input" type="text" placeholder="Song Name"><br>

				<label>Enter Song Release Date to Change</label><br>
				<input name="songdate" class="input" type="date"><br>

				<label>Select Song File to Change</label><br>
				<small style="color:#AA0606">You Can't change Song file</small><br><br>

				<button class="btnsubmit" type="submit" name="updatesong">Update Song Details</button>
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
				}
				?>
			</form>
		</div>
	</div>
	<?php include('commanfooter.php'); ?>
</body>
</html>