<?php
	session_start();
	$pagename="Admin | Category";

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	if(isset($_POST['submit'])){
		$category =strtolower(trim($_POST['category']));
		if(empty($category)){
			$err = "Category Name Field Requiered.";
		}
		else{
			if(addCategory($category)){
				$success = "Category Added Successfully";
			}
			else{
				$err = $category." already exist";
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
			<h3><i class="fa fa-cubes"></i>Create Category / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				<label>Enter Category Name</label><br>
				<input name="category" class="input" type="text" placeholder="Category"><br>
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