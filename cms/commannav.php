<?php

if(!isset($pagename)){
	header("location:index.php");
	exit();
}

?>

<div class="container">
	<div class="inner-box">
		<ul>
			<li>
				<b class="la">VMusic</b><br>
				<small class="lb">Official website for vinyl music</small>
			</li>

			<?php
				if(isset($_SESSION['adminid'])){
			?>
			 <li class="right">
			 	<div class="dropdown">
			 		<a href="#" class="dropbtn">Hi! Admin <i class="fa fa-angle-down"></i></a>
					<div class="dropdown-content" style="width:100%">
						<a href="logout.php" class="dropdown-link"><i class="fa fa-sign-out"></i>Logout</a>
					</div>
			 	</div>
			</li>
			<?php
				}
			?>
		</ul>
	</div>
</div>