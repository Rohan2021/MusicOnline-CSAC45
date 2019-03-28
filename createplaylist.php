<?php
	
	session_start();
	$pagename="My Playlist";

	if(!isset($_SESSION['uid'])){
		header('location:index.php');
		exit();
	}

	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	$playlistname = "";

	if(isset($_POST['submit'])){
		$playlistname = trim(strtolower($_POST['playlistName']));

		if(empty($playlistname)){
			$err = "Playlist Name Requiered.";
		}
		else{
			if(createPlaylist($playlistname,$_SESSION['uid'])){
				echo "<script>alert('Playlist Created.');window.location.href = 'myplaylist.php';</script>";
			}
			else{
				$err = "Playlist already exist.";
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

	<div class="container">
		<div class="row box-bg" style="margin: 0px;">
			<div class="col-12 mb-3">
				<div class="row">
					<div class="col-6"><h3>Create Playlist</h3></div>
					<div class="col-6 text-right"><a class="btn btn-sm btn-outline-light" href="myplaylist.php"><i class="fa fa-plus"></i> My Playlist</a></div>
				</div>
				<hr>
				<form action="" method="post">
					<div class="form-group">
						<input type="text" name="playlistName" class="form-control" id="playlistName" aria-describedby="playlistName" placeholder="Enter Playlist Name" value="<?php echo ucwords($playlistname); ?>">
					</div>
					<button class="btnsubmit" type="submit" name="submit">Create</button>
					<?php 
						if(isset($err)){
					?>
						<small style="color:#AA0606;letter-spacing: 1px">
							<?php echo $err;?>		
						</small><br>
					<?php
						}
					?>
				</form>
			</div>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>