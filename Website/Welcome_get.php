<?php

include 'func/function.php';

$servername = "";
$username = "";
$password = "";
$dbname = "";

session_start();

$LoginName = $_POST['user'];
$Pass = $_POST['password'];


//This Works
$Message = "";
$conn =  mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 


//registration
$ProtectedUser = sanitize($conn, $LoginName);

$protectedPass = sanitize($conn,$Pass);
//$query = "SELECT COUNT(`id`) FROM `Users` WHERE `username` = '$ProtectedUser' AND `password` = '$protectedPass'";
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


?>



<html>
<body>

<a href="index.php">Index Page</a><br>
<a href="registration.php">Register Page</a><br>
<a href="login.php">login Page</a>
<p align="center"> <?php echo $Message ?> </p>
The time is: <?php echo date("h:i:sa"); ?>

</body>
</html>