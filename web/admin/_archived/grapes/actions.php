<?php
connect2database();
$there_was_an_error = false;

switch ($action) 
{
    case 'create_grape':
	    $_POST = cleanForDB($_POST);
	    extract($_POST);
	    require_once 'function.readChunks.php';
	    //$SEOName = convertFromTitleToPath($Name);
	   
	    $i = "INSERT INTO Grapes (Name, Colour, Description) VALUES ('$Name', '$Colour', '$Description')";
	    $go = good_query($i);
	    $message = 'The grape was added.';
	    $view = 'grapes';
	    break;

    case 'update_grape':
	    $_POST = cleanForDB($_POST);
	    extract($_POST);
	    
	    $u = "UPDATE Grapes SET Name = '$Name', Colour = '$Colour', Description = '$Description'WHERE GrapeID = $GrapeID";
	    if (good_query($u))	$message = 'The grape was updated';
	    else {
			$there_was_an_error = true;
			$message = 'There was an error in module ' . $action;    
	    }
	    break;
    
    case 'delete_grape':
	    extract($_GET);
	    $d = "DELETE FROM Grapes WHERE GrapeID = $GrapeID";
	    $go = good_query($d);
	    $message = 'The grape was deleted.';
	    $view = 'grapes';
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