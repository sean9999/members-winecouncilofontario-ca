<?php
connect2database();
$there_was_an_error = false;

switch ($action) {

    case 'update_attraction':
    $_POST = cleanForDB($_POST);
    extract($_POST);
    if (strlen($Tags2)) $Tags = $Tags2;
    if (strlen($Tags1)) $Tags = $Tags1;
    $u = <<<BLOCK
    UPDATE Attractions SET
    	Tags 		= '$Tags',
    	Title		= '$Title',
    	Content 	= '$Content',
    	RegionID	= $RegionID
	WHERE AttractionID = $AttractionID;
BLOCK;
    if (good_query($u))	$message = 'The attraction was updated.';
    else {
		$there_was_an_error = true;
		$message = 'There was an error in module ' . $action;    
    }
    break;
    
    case 'create_attraction':
    $_POST = cleanForDB($_POST);
    extract($_POST);
    if (strlen($Tags2)) $Tags = $Tags2;
    if (strlen($Tags1)) $Tags = $Tags1;
    $i = <<<BLOCK
 	INSERT INTO Attractions (Tags,Content,RegionID,Title)
 	VALUES ('$Tags','$Content',$RegionID,'$Title');
BLOCK;
    $go = good_query($i);
    $message = 'The Attraction was added.';
    $view = 'attractions';
    break;
    
    case 'delete_attraction':
    extract($_GET);
    $d = "DELETE FROM Attractions WHERE AttractionID = $AttractionID";
    $go = good_query($d);
    $message = 'The attraction was deleted.';
    $view = 'attractions';
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