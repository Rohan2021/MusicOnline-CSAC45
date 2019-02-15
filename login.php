<?php
	
	session_start();

	if(isset($_SESSION['uid'])){
		header('location:index.php');
		exit();
	}

	$pagename="Login";

	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	if(isset($_POST['login'])){
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
				$_SESSION['uid'] = $result[0]['user_id'];
				$_SESSION['email'] = $result[0]['email_id'];
				$_SESSION['fname'] = $result[0]['first_name'];
				$_SESSION['lname'] = $result[0]['last_name'];
				$_SESSION['phone'] = $result[0]['phone_number'];
				$_SESSION['created_at'] = $result[0]['created_date'];
				
				header('location: index.php');
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
				<h3>Login to VMusic</h3>
				<?php
					if(isset($loginerr)){
				?>
					<small style="color:#D30E0E"><?php echo $loginerr;?></small>
				<?php
					}
				?>
				<input type="text" name="username" id="username" placeholder="Email" autocomplete="off" required="">
				<input type="password" name="pass" id="pass" placeholder="Password" autocomplete="off" required="">
				<input type="submit" id="submit" name="login">
			</form>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>