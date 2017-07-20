<?php
session_start();

include 'func/function.php';


if(!empty($_SESSION['username']))
{
	
$conn = connect();
$outputMessage = "";
if(isset($_POST['submitButton']))
{
	$protecteduser = sanitize($conn,$_SESSION['username']);
	$protectedMessage = sanitize($conn,$_POST['comment']);
	if(strlen($protectedMessage) < 256 && $result = mysqli_query($conn , "INSERT INTO Messages (`username`, `message`) VALUES ('$protecteduser', '$protectedMessage')"))
	{
		$outputMessage = "Your message has been output";
		
	}elseif(strlen($protectedMessage) > 256)
	{
		$outputMessage = "Your message was too long.";
		
	}
	
	
}
	
	
}




?>
<meta content="Tony's Website" property="og:title" />
<meta property="og:type" content="website" />
<meta property="og:url" content="" /> 
<head>

	<header>

	<h1 align="center">
			
				Hello World
				
	</h1>

	</header>
	

	<body>
		
		<?php include 'sidelinks.php'; ?>
		<div align="center">
		<?php if(!empty($_SESSION['username'])) { ?>
		<p>Enter message less than 256 characters.</p>
		<form method='post'>
		
		<textarea name="comment">Enter text here...</textarea><br>
		<input type="submit" name="submitButton">
		</form>
		<?php }?>
		
		<?php include 'func/MessageQuery.php'; ?>
		</div>
	</body>

</head>