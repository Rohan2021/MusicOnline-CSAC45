<div class="container">
	<div class="inner-box">
		<ul>
			<li>
				<b class="la">VMusic</b><br>
				<small class="lb">Official website for vinyl music</small>
			</li>

			<?php
				if(isset($_SESSION['uid'])){
			?>
			 <li class="right">
			 	<div class="dropdown">
			 		<a href="#" class="dropbtn link-2">Hi! <?php echo $_SESSION['fname']?> <i class="fa fa-angle-down"></i></a>
					<div class="dropdown-content">
						<a href="logout.php" class="dropdown-link"><i class="fa fa-sign-out"></i>Logout</a>
					</div>
			 	</div>
			</li>
			<li class="right">
				<a href="#" class="link">My Playlist</a>
			</li>
			<?php
				} else {
			?>
			<li class="right">
				<a href="#" class="link">Signup</a>
			</li>
			<li class="right">
				<a href="login.php" class="link <?php if($pagename=='Login'){echo 'active';}?>">Login</a>
			</li> 
			<?php
				}
			?>
			<li class="right">
				<a href="#" class="link">Genre</a>
			</li>
			<li class="right">
				<a href="#" class="link">Album</a>
			</li>
			<li class="right">
				<a href="#" class="link">Artist</a>
			</li>
			<li class="right">
				<a href="index.php" class="link <?php if($pagename=='Home'){echo 'active';}?>">Home</a>
			</li>
		</ul>
	</div>
</div>