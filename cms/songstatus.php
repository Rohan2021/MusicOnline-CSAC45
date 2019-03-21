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

	$songs = getSongs();

	if(isset($_POST['updatesongstatus'])){
		$songtochange = $_POST['songsel'];
		$status = $_POST['statussel'];
		
		
		$result = updateSongStatus($songtochange,$status);
		$success = "Song Status Updated Successfully";
		$songs = getSongs();
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
			<h3><i class="fa fa-toggle-on"></i>Change Song Status/ <a href="dashboard.php">Home</a></h3>
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
					<option value="<?php echo $song['song_id'];?>"><?php echo $song['song_name'];?>
						<?php if($song['status'] == 1){echo " ACTIVE";} else{echo " INACTIVE";}?>
					</option>
					<?php	
						}
					?>			
				</select>
				<br><br>
				<label>Select Status to Change</label><br>
				<select class="select" name="statussel">
					<option value="0">Inactive</option>
					<option value="1">Active</option>
				</select><br>
				<button class="btnsubmit" type="submit" name="updatesongstatus">Update Song Status</button>

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