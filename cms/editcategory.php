<?php
	session_start();
	$pagename="Admin | Category";

	if(!isset($_SESSION['adminid'])){
		header('location:index.php');
		exit();
	}

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	$categorys = getCategory();

	if(isset($_POST['updatecat'])){
		$cattochange = $_POST['catsel'];
		$category = strtolower(trim($_POST['category']));
		if(empty($category)){
			$err = "Category to change Field Requiered.";
		}
		else{
			$result = updateCategory($cattochange,$category);
			$success = "Category Updated Successfully";
			$categorys = getCategory();
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
			<h3><i class="fa fa-cubes"></i>Edit Category / <a href="dashboard.php">Home</a></h3>
			<hr>
			<form action="" method="post">
				
				<?php 
				if(sizeof($categorys)==0){
				?>
				<h4>You have not created any category yet.</h4>
				<?php	
				} else {
				?>

				<label>Select Category to Edit</label><br>
				<select class="select" name="catsel">
					<?php
						foreach($categorys as $category){
					?>
					<option value="<?php echo $category['id'];?>"><?php echo $category['title'];?></option>
					<?php
						}
					?>			
				</select>
				<br><br>
				<label>Enter Category to Change</label><br>
				<input name="category" class="input" type="text" placeholder="Category"><br>
				<button class="btnsubmit" type="submit" name="updatecat">Update Category</button>

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