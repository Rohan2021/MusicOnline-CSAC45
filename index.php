<?php
	session_start();
	$pagename="Home";
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
				<h3 class="heading">Trending Songs</h3>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Closer - by the chainsmoker
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Cold water - by Major Laser
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Cheap Thrills - by Sia
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Ain't my fault - by Zara Larson
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Don't Let Me Down - by The Chainsmokers
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> One Dance - by Drake
				</div>
			</div>
			<div class="box-right">
				<h3 class="heading">New Releases</h3>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Thank u, Next - by Ariana Grande
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Look Away - by Rival Sons
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> No Place - by Backstreet Boys
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Never Let You Go - by Slushii
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Hurt - by Oliver Tree
				</div>
				<div class="song">
					<i class="fa fa-play-circle-o"></i> Solo - by Clean Bendit
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>