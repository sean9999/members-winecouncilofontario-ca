<?php 

if(isset($_SESSION['userID']))
{
	connect2database();
	$userData = good_query_assoc("SELECT * FROM Users WHERE UserID = " . $_SESSION['userID']);
}
else 
{
	header("location:/login.php");
}

?>