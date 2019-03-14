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

	if(isset($_POST['updatecatstatus'])){
		$cattochange = $_POST['catsel'];
		$status = $_POST['statussel'];
		
		
		$result = updateCategoryStatus($cattochange,$status);
		$success = "Category Status Updated Successfully";
		$categorys = getCategory();
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
			<h3><i class="fa fa-toggle-on"></i>Change Category Status/ <a href="dashboard.php">Home</a></h3>
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
					<option value="<?php echo $category['id'];?>"><?php echo $category['title'];?>
						<?php if($category['status'] == 1){echo " ACTIVE";} else{echo " INACTIVE";}?>
					</option>
					<?php	
						}
					?>			
				</select>
				<br><br>
				<label>Select Status to Change</label><br>
				<select class="select" name="statussel">
					<option value="0">Inactive</option>
					<option value="1">Active</option>
				</select><br>
				<button class="btnsubmit" type="submit" name="updatecatstatus">Update Category Status</button>

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