<?php
	session_start();
	$pagename="Admin | Dashboard";

	if(isset($_SESSION['adminid'])){
		header('location:dashboard.php');
		exit();
	}

	include("../db/config.php");
	include("../db/db.php");
	include("api.php");

	if(isset($_POST['adminlogin'])){
		$email = $_POST['username'];
		$password = md5($_POST['pass']);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $loginerr = "Invalid email format"; 
		}
		else{
			$result = authenticate($email,$password);
			if(!$result)
			{
				$loginerr = "Bad Credentials!";
			} 
			else 
			{
				$_SESSION['adminid'] = $result[0]['admin_id'];
				$_SESSION['email'] = $result[0]['email'];
				$_SESSION['fname'] = $result[0]['username'];

				header('location: dashboard.php');
				exit();
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

	<div class="login-container">
		<div class="inner-wrapper" style="background-color: transparent;box-shadow: none;">
			<form class="box" action="" method="POST" target="_self">
				<h3>Admin Login to VMusic CMS</h3>
				<?php
					if(isset($loginerr)){
				?>
					<small style="color:#D30E0E"><?php echo $loginerr;?></small>
				<?php
					}
				?>
				<input type="text" name="username" id="username" placeholder="Email" autocomplete="off" required="">
				<input type="password" name="pass" id="pass" placeholder="Password" autocomplete="off" required="">
				<input type="submit" id="submit" name="adminlogin">
			</form>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>