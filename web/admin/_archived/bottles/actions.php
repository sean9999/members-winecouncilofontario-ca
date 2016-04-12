<?php
connect2database();
$there_was_an_error = false;

switch ($action) 
{
    case 'create_bottle':
	    $_POST = cleanForDB($_POST);
	    extract($_POST);
	    require_once 'function.readChunks.php';
	    //$SEOName = convertFromTitleToPath($Name);
       
	    $i = "INSERT INTO Bottles (WineID, Volume, Price, ztamp) VALUES ($WineID, $Volume, $Price, NOW())";
	    $go = good_query($i);
	    $message = 'The bottle was added.';
	    $view = 'bottles';
	    break;

    case 'update_bottle':
	    $_POST = cleanForDB($_POST);
	    extract($_POST);

	    $u = "UPDATE Bottles SET WineID = $WineID, Volume = $Volume, Price = $Price, ztamp = NOW() WHERE BottleID = $BottleID";
	    if (good_query($u))	$message = 'The bottle was updated';
	    else {
			$there_was_an_error = true;
			$message = 'There was an error in module ' . $action;    
	    }
	    break;
    
    case 'delete_bottle':
	    extract($_GET);
	    $d = "DELETE FROM Bottles WHERE BottleID = $BottleID";
	    $go = good_query($d);
	    $message = 'The bottle was deleted.';
	    $view = 'bottles';
	    break;
	    
    default:
	    $there_was_an_error = true;
	    $message = 'There was an action for which no code was written in <code>action.php</code>';

}

if ($there_was_an_error) {
	//include_once INC . 'dBug.php';
    new dBug($_GET);
    new dBug($_POST);
}
?>