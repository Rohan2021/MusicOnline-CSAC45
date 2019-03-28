<?php
	session_start();
	$pagename="Admin | Edit Song in Category";

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	$albums = getAlbum();

	if(isset($_POST['submit'])){
		$albumId = $_POST['select_album'];
		$lastSelectedAlbum = $albumId;
		$songs = getSongInAlbum($albumId);
	}

	if(isset($_POST['delete'])){
		$songInAlbumId = $_POST['id'];
		deleteSongInAlbum($songInAlbumId);
		echo "<script>alert('Song deleted from album');</script>";	
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
			<h3><i class="fa fa-cubes"></i>Edit Song in Album / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				<?php 
				if(sizeof($albums)==0){
				?>
					<h4>You have not added any <u>album</u> yet.</h4>
				<?php	
				} else {
				?>
					<label>Select Album</label><br>
					<select class="select" name="select_album">
						<?php
							foreach($albums as $album){
						?>
						<option value="<?php echo $album['album_id'];?>" <?php if($lastSelectedAlbum == $album['album_id']){ echo "selected";}?> ><?php echo $album['album_name'];?></option>
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
							<?php echo $song['song_name'];?>
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
					<h4>You have not added any <u>song</u> in this album yet.</h4>
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