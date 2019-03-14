<?php
	session_start();
	$pagename="Admin | Dashboard";

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
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
	<div class="dashboard home-container">
		<div class="inner-wrapper">
			<div class="boxdiv">
				<h3>Category</h3>
				<a href="addcategory.php" class="btnadd" title="Add Category"><i class="fa fa-plus"></i></a>
				<a href="editcategory.php" class="btnedit" title="Edit Category"><i class="fa fa-pencil-square-o"></i></a>
				<a href="categorystatus.php" class="btnstatus" title="Category Status">
					<i class="fa fa-toggle-on"></i>
				</a>
			</div>
			<div class="boxdiv">
				<h3>Song</h3>
				<a href="addsong.php" class="btnadd" title="Add Song"><i class="fa fa-plus"></i></a>
				<a href="editsong.php" class="btnedit" title="Edit Song"><i class="fa fa-pencil-square-o"></i></a>
			</div>
			<div class="boxdiv">
				<h3>Album</h3>
				<a class="btnadd" title="Add Album"><i class="fa fa-plus"></i></a>
				<a class="btnedit" title="Edit Album"><i class="fa fa-pencil-square-o"></i></a>
			</div>
			<div class="boxdiv">
				<h3>Artist</h3>
				<a class="btnadd" title="Add Artist"><i class="fa fa-plus"></i></a>
				<a class="btnedit" title="Edit Artist"><i class="fa fa-pencil-square-o"></i></a>
			</div>
			<div class="boxdiv">
				<h3>Song In Category</h3>
				<a class="btnadd" title="Add Song in Category"><i class="fa fa-plus"></i></a>
				<a class="btnedit" title="Edit Song in Category"><i class="fa fa-pencil-square-o"></i></a>
			</div>
			<div class="boxdiv">
				<h3>Song In Album</h3>
				<a class="btnadd" title="Add Song in Album"><i class="fa fa-plus"></i></a>
				<a class="btnedit" title="Edit Song in Album"><i class="fa fa-pencil-square-o"></i></a>
			</div>
			<div class="boxdiv">
				<h3>Song By Artists</h3>
				<a class="btnadd" title="Add Song By Artist"><i class="fa fa-plus"></i></a>
				<a class="btnedit" title="Edit Song By Artist"><i class="fa fa-pencil-square-o"></i></a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php include('commanfooter.php'); ?>
</body>
</html>