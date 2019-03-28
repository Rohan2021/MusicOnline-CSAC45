<?php
	session_start();
	$pagename="Admin | Album";

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	$albums = getAlbum();

	if(isset($_POST['update_album'])){
		$album_to_change = $_POST['album_select'];
		$albumedit = strtolower(trim($_POST['album']));
		if(empty($albumedit)){
			$err = "Album to change Field Requiered.";
		}
		else{
			$result = updateAlbum($album_to_change,$albumedit);
			$success = "Album Updated Successfully";
			$albums = getAlbum();
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
			<h3><i class="fa fa-cubes"></i>Edit Album / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				
				<?php 
				if(sizeof($albums)==0){
				?>
				<h4>You have not created any Album yet.</h4>
				<?php	
				} else {
				?>

				<label>Select Album to Edit</label><br>
				<select class="select" name="album_select">
					<?php
						foreach($albums as $album){
					?>
					<option value="<?php echo $album['album_id'];?>"><?php echo $album['album_name'];?></option>
					<?php
						}
					?>			
				</select>
				<br><br>
				<label>Enter Album to Change</label><br>
				<input name="album" class="input" type="text" placeholder="Album"><br>
				<button class="btnsubmit" type="submit" name="update_album">Update Category</button>

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