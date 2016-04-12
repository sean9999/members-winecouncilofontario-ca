<?php
//	Look for a cookie called UserID. If it doesn't exist, set it as a UID
//	Also set $UserID as $_COOKIE['UserID']
if (!isset($_COOKIE['UserID'])) {
	$unique_id = uniqid();
	setcookie('UserID',$unique_id,time()+60*60*24*365);
	$UserID = $unique_id;
} else {
	$UserID = $_COOKIE['UserID'];
}
?>