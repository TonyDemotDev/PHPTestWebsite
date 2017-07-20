		
		
		<?php if(clean($_SERVER['REQUEST_URI']) !== 'index.php'){ ?>
		<a href="index.php">Index Page</a><br>
		<?php } ?>
		<?php if(empty($_SESSION['username']))  {?>
		
		<a href="registration.php">Register Page</a><br>
		<a href="login.php">Login Page</a><br>
		
		<?php }else{ ?>
		
		<a href="profile.php?id=<?php echo $_SESSION['username'];?>">Profile Page</a><br>
		<a href="messages.php">Messages Page</a><br>
		<a href="logout.php">Logout Page</a><br>
		<a href="friends.php">Friends Page</a><br>
		
		<?php } ?>
		
		<?php if(clean($_SERVER['REQUEST_URI']) === 'messages.php'){ ?>
		<!-- NEED TO DO THIS PROPERLY BY LOOKING AT DATABASE FOR FRIENDS -->
		
		
		
		<?php } ?>