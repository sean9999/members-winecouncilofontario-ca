<?php
connect2database();
$there_was_an_error = false;

switch ($action) 
{
    case 'create_thing':
	    extract($_POST);
	    require_once 'function.readChunks.php';
  
		$P					= cleanForDB($_POST);
		$E					= array();
		
		if (isset($_POST['UserLevels'])) {
			$E['ul'] = implode(',',$_POST['UserLevels']);
		} else {
			$E['ul'] = '';
		}
			

	    $i = "INSERT INTO TestTable (
	    						Name,
	    						Description,
	    						UserLevels
	    						) VALUES (
	    						'$P[Name]',
	    						'$P[Description]',
	    						'$E[ul]'
	    						)";
	    $go = good_query($i);
	    $message = 'The Page was added.';
	    $view = 'ads';
	    break;

    case 'update_thing':

		$P					= cleanForDB($_POST);
		$E					= array();
		if (sizeof($_POST['UserLevels'])) {
			$E['ul'] = implode(',',$_POST['UserLevels']);
			$UserLevelString = $E['ul'];
		}

	    $u = "UPDATE TestTable SET 
	    						Name 			= '$P[Name]',
	    						Description		= '$P[Description]',
	    						UserLevels		= '$UserLevelString'
						    	WHERE testID = $P[testID]";
						    	
	    if (good_query($u))	$message = 'The Page was updated';
	    else {
			$there_was_an_error = true;
			$message = 'There was an error in module ' . $action;    
	    }
	    break;
    
    case 'delete_thing':
	    extract($_GET);
	    $d = "DELETE FROM TestTable WHERE testID = $testID";
	    $go = good_query($d);
	    $message = 'The Page was deleted.';
	    $view = 'ads';
	    break;
	    
    default:
	    $there_was_an_error = true;
	    $message = 'There was an action for which no code was written in <code>action.php</code>';

}

/*
if ($there_was_an_error) {
	//include_once INC . 'dBug.php';
    new dBug($_GET);
    new dBug($_POST);
}
*/
?>