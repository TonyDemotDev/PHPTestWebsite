<?php
session_start();
include 'func/function.php';

if(!empty($_SESSION['username']))
{
	
}else
{
	header('Refresh: 1; URL=http://tony-website.host22.com/index.php');
	
}

$conn = connect();

?>



<head>

	<header>

	<h1 align="center">	
		<?php echo $_GET['id'] . '\'s';?> Page
	</h1>

	</header>
	

	<body>
		
		<?php include 'func/sidelinks.php'; ?>
		<p>This is the body, it's terrible.</p>
		
		
		
		<div align="center">
		

		<!-- CHECK IF IS SESSION USERNAME OR IS FRIENDS ELSE RETURN TO INDEX -->
		<?php getDbListOut($conn,sanitize($conn,$_GET['id'])) ?>
		</div>

	</body>

</head>
