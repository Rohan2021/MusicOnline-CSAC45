<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	session_start();
	$pagename="Home";

	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	$songs = getNewSongs(6);
	$categories = getCategories(6);
?>
<!DOCTYPE html>
<html>
<head>
	<title>VMusic | <?php echo $pagename?></title>
	<?php include('commanhead.php'); ?>
</head>
<body>
	<?php include('commannav.php'); ?>

	<div class="home-container">
		<div class="inner-wrapper">
			<div class="box-top">
				<form class="form">
					<input type="text" name="searchbox" class="input left-radius" placeholder="Search Song ...">
					<button class="btn-theme right-radius"><i class="fa fa-search"></i></button>
				</form>
			</div>
			<div class="box-left">
				<h3 class="heading">Song Category</h3>
				<?php
					foreach($categories as $categorie){
				?>
					<div class="song">
						<a href="#" class="song-link">
							<i class="fa fa-bookmark"></i> <?php echo ucfirst($categorie['title']);?>
						</a>
					</div>
				<?php
					}
				?>
			</div>
			<div class="box-right">
				<h3 class="heading">New Releases</h3>
				<?php
					if(empty($songs)){
				?>
					<i>There is no song in new release.	</i>
				<?php
					}
					else 
						foreach($songs as $song){
				?>
					<div class="song">
						<a href="#" class="song-link">
							<i class="fa fa-play-circle-o"></i> <?php echo ucfirst($song['song_name']);?>
						</a>
					</div>
				<?php
					}
				?>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>