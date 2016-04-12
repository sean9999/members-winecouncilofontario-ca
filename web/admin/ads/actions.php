<?php
connect2database();
$there_was_an_error = false;

switch ($action) 
{
    case 'create_thing':
	    $_POST = cleanForDB($_POST);
	    extract($_POST);
	    require_once 'function.readChunks.php';

		//Processing of StartTime and EndTime
		$delimiters = "/\ :";
		
		if($StartDate == '')
			$StartTimeStamp = time() - (60*60*4) + (60*60*1);
		else
		{
			$day = strtok($StartDate, $delimiters);
			$month = strtok($delimiters);
			$year = strtok($delimiters);
			$hour = strtok($delimiters);
			$minutes = strtok($delimiters);
	
			$StartTimeStamp = mktime($hour, $minutes, 0, $month, $day, $year);
		}

		if($EndDate == '')
			$EndTimeStamp = time() - (60*60*4) + (60*60*1);
		else
		{
			$day = strtok($EndDate, $delimiters);
			$month = strtok($delimiters);
			$year = strtok($delimiters);
			$hour = strtok($delimiters);
			$minutes = strtok($delimiters);
	
			$EndTimeStamp = mktime($hour, $minutes, 0, $month, $day, $year);
		}





    
	    $i = "INSERT INTO Ads (
	    						Name,
	    						Image,
	    						URL,
	    						Blurb,
	    						Notes,
	    						StartDate,
	    						EndDate,
	    						IsActive
	    						) VALUES (
	    						'$Name',
	    						'$Image',
	    						'$URL',
	    						'$Blurb',
	    						'$Notes',
	    						'$StartTimeStamp',
	    						'$EndTimeStamp',
	    						'$IsActive'
	    						)";
	    $go = good_query($i);
	    $message = 'The ad was added.';
	    $view = 'ads';
	    break;

    case 'update_thing':
	    $_POST = cleanForDB($_POST);
	    extract($_POST);
		
		//Processing of StartTime and EndTime
		$delimiters = "/\ :";
		
		if($StartDate == '')
			$StartTimeStamp = time() - (60*60*4) + (60*60*1);
		else
		{
			$day = strtok($StartDate, $delimiters);
			$month = strtok($delimiters);
			$year = strtok($delimiters);
			$hour = strtok($delimiters);
			$minutes = strtok($delimiters);
	
			$StartTimeStamp = mktime($hour, $minutes, 0, $month, $day, $year);
		}

		if($EndDate == '')
			$EndTimeStamp = time() - (60*60*4) + (60*60*1);
		else
		{
			$day = strtok($EndDate, $delimiters);
			$month = strtok($delimiters);
			$year = strtok($delimiters);
			$hour = strtok($delimiters);
			$minutes = strtok($delimiters);
	
			$EndTimeStamp = mktime($hour, $minutes, 0, $month, $day, $year);
		}
		
	    
	    $u = "UPDATE Ads SET 

	    						Name 		= '$Name',
	    						Image	 	= '$Image',
	    						URL			= '$URL',
	    						Blurb		= '$Blurb',
	    						Notes		= '$Notes',
	    						StartDate	= '$StartTimeStamp',
	    						EndDate		= '$EndTimeStamp',
	    						IsActive	= '$IsActive'
						    	WHERE AdID = $AdID";
	    if (good_query($u))	$message = 'The ad was updated';
	    else {
			$there_was_an_error = true;
			$message = 'There was an error in module ' . $action;    
	    }
	    break;
    
    case 'delete_thing':
	    extract($_GET);
	    $d = "DELETE FROM Ads WHERE AdID = $AdID";
	    $go = good_query($d);
	    $message = 'The ad was deleted.';
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