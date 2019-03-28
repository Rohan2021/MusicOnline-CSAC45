<nav class="navbar navbar-expand-lg mb-5 px-5">
	<a class="navbar-brand" href="#">
		<b class="la">VMusic</b><br>
		<small class="lb">Official website for vinyl music</small>
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon">
			<i class="fa fa-bars text-light"></i>
		</span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav ml-auto">
		<li class="nav-item <?php if($pagename=='Home'){echo 'active';}?>">
			<a class="nav-link" href="index.php">
				<?php
					if(isset($_SESSION['uid'])){
				?>
				<i class="fa fa-user-circle"></i> Hi! <?php echo ucwords($_SESSION['fname'])?>
				<?php
					} else {
				?>
					<i class="fa fa-home"></i> Home
				<?php
					}
				?>
			</a>
		</li>
		<li class="nav-item <?php if($pagename=='Artist'){echo 'active';}?>">
			<a class="nav-link" href="artist.php"><i class="fa fa-user"></i> Artist</a>
		</li>
		<li class="nav-item <?php if($pagename=='Album'){echo 'active';}?>">
			<a class="nav-link" href="album.php"><i class="fa fa-film"></i> Album</a>
		</li>
		<li class="nav-item <?php if($pagename=='Genre/Category'){echo 'active';}?>">
			<a class="nav-link" href="genre.php"><i class="fa fa-cubes"></i> Genre/Category</a>
		</li>
		<?php
			if(isset($_SESSION['uid'])){
		?>
			<li class="nav-item <?php if($pagename=='My Playlist'){echo 'active';}?>">
				<a class="nav-link" href="myplaylist.php"><i class="fa fa-folder-o"></i> My Playlist</a>
			</li>
			<li class="nav-item <?php if($pagename=='Login'){echo 'active';}?>">
				<a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
			</li>
		<?php
			} else {
		?>
			<li class="nav-item <?php if($pagename=='Login'){echo 'active';}?>">
				<a class="nav-link" href="login.php"><i class="fa fa-sign-in"></i> Login</a>
			</li>
			<li class="nav-item <?php if($pagename=='Signup'){echo 'active';}?>">
				<a class="nav-link" href="signup.php"><i class="fa fa-file-text"></i> Signup</a>
			</li>
		<?php
			}
		?>
	</ul>
	</div>
</nav>