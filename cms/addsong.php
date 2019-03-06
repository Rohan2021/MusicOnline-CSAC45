<?php

	

	session_start();
	$pagename="Admin | Song";
	

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	if(isset($_POST['addsong'])){
		$song = strtolower(trim($_POST['song']));
		$releasedate = $_POST['songdate'];

		$target_dir = "../songs/";
		$file_name = basename($_FILES["fileToUpload"]["name"]);
		$SongFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
		$newname = time().".".$SongFileType;
		$filepath = $target_dir.$newname;

		if(empty($song)){
			$err = "Song Name Field Requiered.";
		}
		else if(empty($releasedate)){
			$err = "Release Date Field Requiered.";
		}
		else if($SongFileType != "mp3") {
		    $err = "Sorry, only MP3 files are allowed.";
		}
		else{
			if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath)) {
				if(addSong($song,$releasedate,$newname)){
					$success="Song Uploaded";
				}
				else{
					$err = "Song already uploaded";
				}
			} else {
		        $err = $filepath." ".$_FILES["fileToUpload"]["error"];
		    }
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
			<h3><i class="fa fa-cubes"></i>Add Song / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post" enctype="multipart/form-data">
				<label>Enter Song Name</label><br>
				<input name="song" class="input" type="text" placeholder="Song Name" required=""><br>

				<label>Enter Song Release Date</label><br>
				<input name="songdate" class="input" type="date" required=""><br>

				<label>Select Song File</label><br>
				<input class="input" type="file" name="fileToUpload" required=""><br>

				<button class="btnsubmit" type="submit" name="addsong">Submit</button>
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