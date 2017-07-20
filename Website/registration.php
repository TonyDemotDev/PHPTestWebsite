<?php
session_start();
include 'func/function.php';
if(!empty($_SESSION['username']))
{
	echo $_SESSION['username'];
	header('Location: index.php');
}

?>


<head>

	<header>

	<h1 align="center">	
		Register Page
	</h1>

	</header>
	

	<body>
	
		<?php include 'func/sidelinks.php'; ?>
		
		<p align="center">Register here!</p>
		<form action="Register_get.php" method="post" align="center">
		
		Username<br>
		<input type="text" name="user"><br>
		Password<br>
		<input type="password" name="password"><br><br>
		
		<input type="submit"><br>
		
		</form>
		
		

	</body>

</head>