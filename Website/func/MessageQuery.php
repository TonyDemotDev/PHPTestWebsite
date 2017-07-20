<?php

$servername = "localhost";
$username = "id2084862_databaseusername";
$password = "QRRRP128UHT";
$dbname = "id2084862_users";

$conn =  mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

$query = "SELECT `username`, `message` FROM `Messages` ORDER BY `id` DESC";

	if($result = mysqli_query($conn,$query))
	{
		if(mysqli_num_rows($result) != 0)
		{
			while($row = $result->fetch_assoc())
			{
			
				echo "<br>". htmlspecialchars($row["username"])." - ". htmlspecialchars($row["message"]) . "<br>";
			
			}
		
		}
		
	}
	
	mysqli_free_result($result);

	mysqli_close($conn);


?>
