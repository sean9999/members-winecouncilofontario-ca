<?php
connect2database();
$there_was_an_error = false;


switch ($action) {

    case 'update_region':
    $_POST = cleanForDB($_POST);
    //extract($_POST);
    $u = "UPDATE Regions SET Name = '$_POST[Name]', Name_fr = '$_POST[Name_fr]', SEOName = '$_POST[SEOName]', Description = '$_POST[Description]', Description_fr = '$_POST[Description_fr]', MobileContent = '$_POST[MobileContent]', GeoLocation = '$_POST[GeoLocation]', Language = 'en' WHERE RegionID = $_POST[RegionID]";
    if (good_query($u))	$message = 'The region was updated.';
    else {
		$there_was_an_error = true;
		$message = 'There was an error in module ' . $action;    
    }
    break;
    
    case 'create_region':
    $_POST = cleanForDB($_POST);
    extract($_POST);
    require_once 'function.readChunks.php';
    $SEOName = convertFromTitleToPath($Name);
    $i = "INSERT INTO Regions (Name,Name_fr,SEOName,Description,Description_fr,MobileContent,GeoLocation) VALUES ('$Name','$Name_fr','$SEOName','$Description','$Description_fr','$MobileContent','$GeoLocation')";
    $go = good_query($i);
    $message = 'The region was added.';
    $view = 'regions';
    break;
    
    case 'delete_region':
    extract($_GET);
    $d = "DELETE FROM Region WHERE RegionID = $RegionID";
    $go = good_query($d);
    $message = 'The region was deleted.';
    $view = 'regions';
    break;
    
    default:
    $there_was_an_error = true;
    $message = 'There was an action for which no code was written in <code>action.php</code>';

}

if ($there_was_an_error) {
	include_once INC . 'dBug.php';
    new dBug($_GET);
    new dBug($_POST);
}


?>