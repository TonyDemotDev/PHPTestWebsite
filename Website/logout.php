<?php
session_start();
include 'func/function.php';
if(!empty($_SESSION['username']))
{
	echo $_SESSION['username'];
	
	if(isset($_POST['SubButton']))
	{
		
		session_destroy();
		header('Refresh: 0; URL=s');
		
	}
	
	
}



?>


<head>

	<header>

	<h1 align="center">	
		Logout Page
	</h1>

	</header>
	

	<body>
	
		<?php include 'func/sidelinks.php'; ?>
		
		<form method="post" align="center">
		
		<button type="submit" name="SubButton">Logout</button><br>
		
		</form>
		
		
		<p>This is the body, it's terrible.</p>

	</body>

</head>