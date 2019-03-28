<?php
	session_start();
	$pagename="Admin | Add Song in Category";

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	$categorys = getCategory();
	$songs = getSongs();

	if(isset($_POST['submit'])){
		$categoryid = $_POST['select_category'];
		$songid = $_POST['select_song'];

		if(addSongToCategory($categoryid,$songid)){
			$success="Song Added to Category";
		}
		else{
			$err = "Song already Added to Category";
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
			<h3><i class="fa fa-cubes"></i>Add Song in Category / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				<?php 
				if(sizeof($categorys)==0){
				?>
					<h4>You have not added any <u>category</u> yet.</h4>
				<?php	
				} else {
				?>
					<label>Select Category</label><br>
					<select class="select" name="select_category">
						<?php
							foreach($categorys as $category){
						?>
						<option value="<?php echo $category['id'];?>"><?php echo $category['title'];?></option>
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
						<label>Select Song to add in category</label><br>
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