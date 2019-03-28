<?php
	session_start();
	$pagename="Admin | Artist";

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	$artists = getArtist();

	if(isset($_POST['update_album'])){
		$artist_to_change = $_POST['artist_select'];
		$artistedit = strtolower(trim($_POST['artist']));
		if(empty($artistedit)){
			$err = "Artist to change Field Requiered.";
		}
		else{
			$result = updateArtist($artist_to_change,$artistedit);
			$success = "Artist Updated Successfully";
			$artists = getArtist();
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
			<h3><i class="fa fa-cubes"></i>Edit Artist / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				
				<?php 
				if(sizeof($artists)==0){
				?>
				<h4>You have not added any Artist yet.</h4>
				<?php	
				} else {
				?>

				<label>Select Artist to Edit</label><br>
				<select class="select" name="artist_select">
					<?php
						foreach($artists as $artist){
					?>
					<option value="<?php echo $artist['artist_id'];?>"><?php echo $artist['artist_name'];?></option>
					<?php
						}
					?>			
				</select>
				<br><br>
				<label>Enter Artist to Change</label><br>
				<input name="artist" class="input" type="text" placeholder="Artist"><br>
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