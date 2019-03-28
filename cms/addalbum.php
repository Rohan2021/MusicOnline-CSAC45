<?php
	session_start();
	$pagename="Admin | Album";

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	if(isset($_POST['submit'])){
		$album =strtolower(trim($_POST['album']));
		if(empty($album)){
			$err = "Album Name Field Requiered.";
		}
		else{
			if(addalbum($album)){
				$success = "Album Added Successfully";
			}
			else{
				$err = $album." already exist";
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
			<h3><i class="fa fa-cubes"></i>Create Album / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				<label>Enter Album Name</label><br>
				<input name="album" class="input" type="text" placeholder="Album"><br>
				<button class="btnsubmit" type="submit" name="submit">Submit</button>
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