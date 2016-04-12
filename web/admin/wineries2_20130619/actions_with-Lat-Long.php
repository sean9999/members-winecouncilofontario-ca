<?php
connect2database();
$there_was_an_error = false;

include 'function.getCoordinates.php';

switch ($action) {

    case 'update_winery':
	    require_once 'function.textConversions.php';
	    $_POST = cleanForDB($_POST);
	    extract($_POST);
	    $NiceWeb = niceURL($Website);
	    //$WineryNumber = $WineryNumber;
	    $IsMember = (int) isset($IsMember);
	    
	    $coords = getCoordinates($GeoLocation);
	    
	    $u = <<<BLOCK
	    UPDATE Wineries SET
	    	Name 			= '$Name',
	    	WineryNumber	= '$WineryNumber',
	    	Description 	= '$Description',
	    	GeoLocation 	= '$GeoLocation',
	    	Address 		= '$Address',
	    	RegionID		= $RegionID,
	    	Town			= '$Town',
	    	Province		= '$Province',
	    	Hours			= '$Hours',
	    	TourHours		= '$TourHours',
	    	Phone			= '$Phone',
	    	Website			= '$NiceWeb',
	    	Email			= '$Email',
	    	SmallImage1		= '$SmallImage1',
	    	SmallImage2		= '$SmallImage2',
	    	FeaturedWineID	= $FeaturedWineID,
	    	WineMakersChoice= '$WineMakersChoice',
	    	BestLCBOBrand	= '$BestLCBOBrand',
	    	WineMakers		= '$WineMakers',
	    	IsMember		= $IsMember
		WHERE WineryID 		= $WineryID;
BLOCK;
	    if (good_query($u))	$message = 'The winery was updated.';
	    else {
			$there_was_an_error = true;
			$message = 'There was an error in module ' . $action;    
	    }
	    break;
    
    case 'create_winery':
	    require_once 'function.textConversions.php';
	    $_POST = cleanForDB($_POST);
	    extract($_POST);
	    $NiceWeb = niceURL($Website);
		$IsMember = (int) isset($IsMember); 
	    
		$coords = getCoordinates($GeoLocation);		
		
		$i = <<<BLOCK
	 	INSERT INTO Wineries (
	 	Name,
	 	WineryNumber,
	 	Description,
	 	GeoLocation,
	 	RegionID,
	 	Address,
	 	Town,
	 	Province,
	 	Hours,
	 	TourHours,
	 	Phone,
	 	Website,
	 	Email,
	 	FeaturedWineID,
	 	WineMakersChoice,
	 	BestLCBOBrand,
	 	WineMakers,
	 	IsMember
	 	)
	 	VALUES (
	 	'$Name',
	 	'$WineryNumber',
	 	'$Description',
	 	'$GeoLocation',
	 	$RegionID,
	 	'$Address',
	 	'$Town',
	 	'$Province',
	 	'$Hours',
	 	'$TourHours',
	 	'$Phone',
	 	'$NiceWeb',
	 	'$Email',
	 	$FeaturedWineID,
	 	'$WineMakersChoice',
	 	'$BestLCBOBrand',
	 	'$WineMakers',
	 	$IsMember
	 	);
BLOCK;
	    $go = good_query($i);
	    $message = 'The winery was added.';
	    $view = 'wineries';
	    break;
    
    case 'delete_winery':
	    extract($_GET);
	    $d = "DELETE FROM Wineries WHERE WineryID = $winery_id";
	    $go = good_query($d);
	    $message = 'The winery was deleted.';
	    $view = 'wineries';
	    break;
    
    default:
	    $there_was_an_error = true;
	    $message = 'There was an action for which no code was written in <code>action.php</code>';

}

if ($there_was_an_error) {
	include_once 'dBug.php';
    new dBug($_GET);
    new dBug($_POST);
}


?>