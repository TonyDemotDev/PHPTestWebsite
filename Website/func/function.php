<?php

function sanitize($conn,$string)
{
	return htmlspecialchars(mysqli_real_escape_string($conn,$string));
	
}

function clean($string) {
   $string = str_replace('/', '', $string); // Replaces all spaces with hyphens.

   return $string;
}

function connect()
{
	
$servername = "";
$username = "";
$password = "";
$dbname = "";

$conn =  mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	return $conn;


}


function getDbListOut($conn,$username)
{
	
	$query = "SELECT `username`, `message` FROM `Messages` WHERE `username` = '$username'";

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
	
	
	
}

function getDirectMessages($conn,$userid, $UserToName)
{
	
	//$query = "SELECT `userToID`, `userFromID`, `comment` FROM `DirectMessages` WHERE `userTo` = '$userFrom' OR `UserTo` = '$userTo'";

	$FindQuery = "SELECT DirectMessages.userToID,DirectMessages.userFromID, DirectMessages.comment, Users.username, Users.id 
				  FROM `DirectMessages` INNER JOIN `Users` ON DirectMessages.userFromID = Users.id
				  WHERE DirectMessages.userToID = (SELECT Users.id FROM `Users` WHERE Users.username = '$UserToName') 
				  OR DirectMessages.userFromID = (SELECT Users.id FROM `Users` WHERE Users.username = '$UserToName') 
				  AND (DirectMessages.userToID = '$userid' OR DirectMessages.userFromID = '$userid')";
	
	if($result = mysqli_query($conn,$FindQuery))
	{
		if(mysqli_num_rows($result) != 0)
		{
			while($row = $result->fetch_assoc())
			{
				
				echo "<br>" . htmlspecialchars($row["username"])." - ". htmlspecialchars($row["comment"]) . "<br>";
				/*if($row["userFrom"] === $userTo)
				{
					echo "<br>" . htmlspecialchars($row["userFrom"])." - ". htmlspecialchars($row["comment"]) . "<br>";
				}elseif($row["userFrom"] === $userFrom)
				{
					
					echo "<br>" . htmlspecialchars($row["userFrom"])." - ". htmlspecialchars($row["comment"]) . "<br>";
					
				}*/
			
			}
		
		}
		
	}
	 echo mysqli_error($conn);
	mysqli_free_result($result);
	


	
	
}

function sendDirectMessages($conn,$userTo,$userFrom,$message)
{
	
	$query = "INSERT INTO DirectMessages (`userToID`, `userFromID`, `comment`) VALUES ('$userTo', '$userFrom', '$message')";
	$FindQuery = "SELECT `username` FROM `Users` WHERE `username` = '$userFrom'";
	$OutPutMessage = "";
	if($FindResult = mysqli_query($conn,$FindQuery))
	{
		$userRow = $FindResult->fetch_assoc();
		if($userRow["username"] === $_SESSION['username'])
		{
			if($result = mysqli_query($conn,$query))
			{
				
				$OutPutMessage = "Message sent!";
				
				
			}else
			{
				
				$OutPutMessage = "Could not send, sorry.";
				
			}
			
			
		}
	}
	mysqli_free_result($result);
	mysqli_free_result($FindResult);
	

	
	
}


function friendAdd($conn,$username,$friend_name)
{
	$id = 0;
	$Insertquery = "INSERT INTO FriendsList (`name`, `friend_name`) VALUES ('$username', '$friend_name')";
	$FindQuery = "SELECT `username`,`id` FROM `Users` WHERE `username` = '$friend_name'";
	// NEEDS ADDITIONAL CHECKS FOR IF ALREADY FRIEND AND USER NOT IN DATABASE.
	if($FindResult = mysqli_query($conn,$FindQuery))
	{
		$userRow = $FindResult->fetch_assoc();
		$id = $userRow["id"]; 
			
		if($result = mysqli_query($conn,$Insertquery))
		{
				
			$OutPutMessage = "Friend Added";
				
				
		}else
		{
				
			$OutPutMessage = "Could not send, sorry.";
				
		}
			
			
		
		
		
	}
	
	mysqli_free_result($result);
	mysqli_free_result($FindResult);
	
}


function GetFriendList($conn,$id)
{
	//DO THIS BASED ON ID'S!
	$FindQuery = "SELECT FriendsList.user_id,FriendsList.friend_id, Users.username, Users.id
				  FROM (`FriendsList` INNER JOIN `Users` ON FriendsList.user_id = Users.id OR FriendsList.friend_id = Users.id)
				  WHERE Users.id != '$id' AND (FriendsList.user_id = '$id' OR FriendsList.friend_id = '$id')
				  ";
				  
	$SelectIDs = "SELECT `user_id`, `friend_id` ";
	
	$UsernameFind = "SELECT `user_id`,`friend_id` FROM `FriendsList` WHERE `user_id` = '$id` OR `friend_id` = '$id'";
	
	if($result = mysqli_query($conn,$FindQuery))
	{
		if(mysqli_num_rows($result) != 0)
		{
			while($row = $result->fetch_assoc())
			{
				
					echo "<br>". htmlspecialchars($row["username"]) . "<br>";
				
			}
				
		}
	
	}
	
	mysqli_free_result($result);
}

function GetFriendListLink($conn,$id)
{
	
	$FindQuery = "SELECT FriendsList.user_id,FriendsList.friend_id, Users.username, Users.id
				  FROM (`FriendsList` INNER JOIN `Users` ON FriendsList.user_id = Users.id OR FriendsList.friend_id = Users.id)
				  WHERE Users.id != '$id' AND (FriendsList.user_id = '$id' OR FriendsList.friend_id = '$id')
				  ";
				  
				  
	if($result = mysqli_query($conn,$FindQuery))
	{
		if(mysqli_num_rows($result) != 0)
		{
			while($row = $result->fetch_assoc())
			{
				
				echo "<a href=messages.php?id=" . htmlspecialchars($row["username"]) . ">" . htmlspecialchars($row["username"]) . "'s" . " messages</a><br>";
				
			}
				
		}
	
	}
	
	mysqli_free_result($result);
	
	
}


function SearchAsscoArray($query,$rowName,$searchable)
{
	
	
	while($row = $query->fetch_assoc())
		{
			if($row['$rowName'] !== $searchable)
			{
				echo "<br>". htmlspecialchars($row["friend_name"]);
			}
		}
	
	
	
}


?>