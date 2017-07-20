<?php
session_start();
include 'func/function.php';

if(!empty($_SESSION['username']))
{
	
	$conn = connect();
	
}else
{
	
	header('Refresh: 0; URL=http://tony-website.host22.com/index.php');
}

?>


<head>

	<header>

	<h1 align="center">	
		Messages Page
	</h1>

	</header>
	

	<body>
	
		<?php include 'func/sidelinks.php'; ?>
		
		<div align="center">
		
		<?php GetFriendList($conn,$_SESSION['id']);?>
		
		
		</div>
		<p>This is the body, it's terrible.</p>

	</body>

</head>


<?php if(!empty($_SESSION['username'])) { mysqli_close($conn);} ?>