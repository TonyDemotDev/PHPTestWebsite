<?php
session_start();
include 'func/function.php';

if(!empty($_SESSION['username']))
{
	
	$conn = connect();
	if(substr(clean($_SERVER['REQUEST_URI']), - 3) !== 'php')
	{
		$Posend = strrpos(clean($_SERVER['REQUEST_URI']),'=', -1);
		
		$endChars = substr(clean($_SERVER['REQUEST_URI']), $Posend + 1);
		echo $endChars;
	}
	if(isset($_POST['SubButton']))
	{
		sendDirectMessages($conn,sanitize($conn,$_POST['userTo']),sanitize($conn,$_SESSION['username']),htmlspecialchars($_POST['comment']));
		
	}
	
	
}else
{
	
	header('Refresh: 0; URL=');
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
		<?php GetFriendListLink($conn,$_SESSION['id']) ?>
		<?php if(!empty($_SESSION['username'])) {?>
		
		<div align="center">
		
		<?php  if(substr(clean($_SERVER['REQUEST_URI']), - 3) !== 'php'){getDirectMessages($conn,$_SESSION['id'], $_GET['id']);} ?>
		
			<?php  if(substr(clean($_SERVER['REQUEST_URI']), - 3) === 'php'){?>
				<form method="post" align="center">
				<input type="text" name="userTo"><br>
				<textarea cols="35" rows="10" style="resize:none" name="comment">Enter text here...</textarea><br>
				<input type="submit" name ="SubButton"><br>
				
				</form>
				
				
			<?php }?>
		
		<?php }?>
		
		</div>
		<p>This is the body, it's terrible.</p>

	</body>

</head>


<?php if(!empty($_SESSION['username'])) { mysqli_close($conn);} ?>