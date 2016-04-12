<?php
switch ($action) {

	case 'create_download':
	$_POST = cleanForDB($_POST);
	extract($_POST);
	$ins = good_query("INSERT INTO Downloads (FileName,Title) VALUES ('$FileName','$Title')");
	$message = 'The association was made successfully.';
	break;

	case 'delete_download':
	$kill = good_query("DELETE FROM Downloads WHERE DownloadID = " . $_GET['DownloadID']);
	$message = 'The download has been disassociated.';
	break;

	case 'upload_file':
	$target_path = HomePathLocal . DownloadsPath . basename( $_FILES['phyle']['name']);
	if(move_uploaded_file($_FILES['phyle']['tmp_name'], $target_path)) {
	$message = "The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded";
	} else {
    $message = "There was an error uploading the file, please try again!";
	}
	break;
	
	case 'change_download':
	$P 	= cleanForDB($_POST);
	$u	= good_query("UPDATE Downloads SET Title = '$P[Title]' WHERE DownloadID = $P[DownloadID]");
	$message = 'The download item`s title has been changed.';
	break;
	
	default:
	$message = 'There was an action for which no routine was written in actions.php';

}
?>