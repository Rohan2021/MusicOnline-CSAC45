<?php
	
	session_start();

	if(isset($_SESSION['uid'])){
		header('location:index.php');
		exit();
	}

	$pagename="Signup";

	include("db/config.php");
	include("db/db.php");
	include("db/api.php");

	$firstname = "";
	$lastname = "";
	$mobile = "";
	$email = "";

	if(isset($_POST['signup'])){
		$firstname = trim(strtolower($_POST['fname']));
		$lastname = trim(strtolower($_POST['lname']));
		$mobile = $_POST['mobile'];
		$email = trim(strtolower($_POST['username']));
		$password = $_POST['pass'];

		if(empty($firstname)){
			$err = "First name field is requered.";
		}
		else if(empty($lastname)){
			$err = "Last name field is requered.";
		}
		else if(empty($mobile)){
			$err = "Mobile Number field is requered.";
		}
		else if(!is_numeric($mobile)){
			$err = "Invalid Mobile Number";
		}
		else if(empty($email)){
			$err = "Email field is requered.";
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$err = "Invalid Email";
		}
		else if(empty($password)){
			$err = "Password field is requered.";
		}
		else{
			if(addUser($firstname,$lastname,$mobile,$email,md5($password))){
				echo "<script>alert('You have successfully created your account.\\nNow you can login.');window.location.href = 'login.php';</script>";
			} else {
				$err = "This email is already exist.";
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
		<div class="row">
			<div class="col-lg-5 col-md-6 col-12 m-auto">
				<div class="inner-wrapper" style="background-color: transparent;box-shadow: none;">
					<form class="box" action="" method="POST" target="_self">
						<h3>Signup to VMusic</h3>
						<?php
							if(isset($err)){
						?>
							<small style="color:#D30E0E"><?php echo $err;?></small>
						<?php
							}
						?>
						<input type="text" name="fname" id="username" placeholder="First Name" required="" value="<?php echo $firstname;?>">
						<input type="text" name="lname" id="username" placeholder="Last Name" required="" value="<?php echo $lastname;?>">
						<input type="text" name="mobile" id="username" placeholder="Mobile no." required="" value="<?php echo $mobile;?>">
						<input type="text" name="username" id="username" placeholder="Email" autocomplete="off" required="" value="<?php echo $email;?>">
						<input type="password" name="pass" id="pass" placeholder="Create Password" autocomplete="off" required=""> 
						<input type="submit" id="submit" name="signup">
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php include('commanfooter.php'); ?>
</body>
</html>