<?php
session_start();
include 'func/function.php';
if(!empty($_SESSION['username']))
{
	echo $_SESSION['username'];
	
	
}elseif(empty($_SESSION['username']))
{
	$Message = "";
	if(isset($_POST['SubButton']) && !isset($_POST['username']))
	{
		
		$LoginName = $_POST['user'];
		$Pass = $_POST['password'];
		
		$conn = connect();
		
		$ProtectedUser = sanitize($conn, $LoginName);
		$protectedPass = sanitize($conn,$Pass);
		
		$query = "SELECT `id`, `username`, `password` FROM `Users` WHERE `username` = '$ProtectedUser'";

		
		
		if($result = mysqli_query($conn,$query))
		{
			
			$obj = $result->fetch_object();
			//printf ("%s \n", $obj->password);
			
			$row = mysqli_fetch_row($result);
			
			if($ProtectedUser === $obj->username && password_verify($protectedPass,$obj->password))
			{
				//logged in hooray!
				$_SESSION['username'] = $ProtectedUser;
				$_SESSION['id'] = $obj->id;
				$Message = "We Logged in the user named " . $ProtectedUser;
				
			}else 
			{
				$Message = "We could not log in the user, maybe you need to register";
			}
			
		}

		mysqli_free_result($result);

		mysqli_close($conn);
		
		header('Refresh: 0; URL=http://tony-website.host22.com/index.php');
		
	}
	
	
}

?>


<head>

	<header>

	<h1 align="center">	
		Login Page
	</h1>

	</header>
	

	<body>
		<?php include 'func/sidelinks.php'; ?>
		
		<form method="post" align="center">
		
		Username<br>
		<input type="text" name="user"><br>
		Password<br>
		<input type="password" name="password"><br><br>
		
		<button type="submit" name="SubButton">Login</button><br>
		
		</form>
		
		
		<p>This is the body, it's terrible.</p>

	</body>

</head>