<?php
	
	session_start();
	$pagename="Genre/Category";

	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	$categorys = getCategorys();
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
				<h3>Song By Genre / Category</h3>
				<hr>
			</div>
			<?php
				if(sizeof($categorys) == 0){
			?>
				<div class="alert alert-danger">There is no album available</div>
			<?php
				} else {
					$count = 0;
					foreach ($categorys as $category) {
						if($category['status']==1){
							$count++;
			?>	
				<div class="col-lg-4 mb-2">
						<a class="btn btn-light btn-block py-3" href="song.php?genre=<?php echo $category['id'];?>"><?php echo ucwords($category['title']);?></a>
				</div>
			<?php
						}
					}
					if($count == 0){
				?>
					<div class="col-12">
						<div class="alert alert-danger">There is no category available.</div>
					</div>
				<?php
					}
				}
			?>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>