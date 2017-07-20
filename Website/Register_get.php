<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";


session_start();
include 'func/function.php';
//This Works

$conn =  mysqli_connect($servername, $username, $password, $dbname);
$Message = "";

$LoginName = sanitize($conn,$_POST['user']);
$Pass = sanitize($conn,$_POST['password']);
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

//registration

	$saltedPass = password_hash($Pass,PASSWORD_BCRYPT);
	
	if(mysqli_query($conn , "INSERT INTO Users (`username`, `password`) VALUES ('$LoginName', '$saltedPass')") === TRUE)
	{
		$Message = "We created the username" . $LoginName;
		
	}else 
	{
		$Message = "Somthing went wrong, please try again. Could not create user " . $LoginName;
		
	}



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