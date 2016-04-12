<?php
connect2database();
$there_was_an_error = false;

switch ($action) 
{
    case 'create_wine':
       	$grapes = $_POST['Grapes'];

       	$_POST = cleanForDB($_POST);
	    
	    extract($_POST);
	    require_once 'function.readChunks.php';
	    //$SEOName = convertFromTitleToPath($Name);
	    
	    $StyleExplosion = explode('-', $Style);
	    
	    $Colour = $StyleExplosion[0];
	    $SpecialType = $StyleExplosion[1];
	    
	    if($Year == '') $Year = 0;
	    if($AlcoholByVolume == '') $AlcoholByVolume = 0;
	       
	    $i = "INSERT INTO Wines (WineryID, Brand, Name, Colour, Year, Description, TastingNotes, Image, AvailableAtLCBO, AvailableAtWinery, AlcoholByVolume, IsFeatured, IsActive, SpecialType, Awards) VALUES ($WineryID, '$Brand', '$Name', '$Colour', $Year, '$Description', '$TastingNotes', '$Image', '$AvailableAtLCBO', '$AvailableAtWinery', '$AlcoholByVolume', '$IsFeatured', '$IsActive', '$SpecialType', '$Awards')";
	    $go = good_query($i);
	    
	    //Insert into WinesXGrapes as the same time.
	    foreach($grapes as $key=>$value)
	    	good_query("INSERT INTO WinesXGrapes (WineID, GrapeID) VALUES (LAST_INSERT_ID(), $value)");
	    	    
	    $message = 'The wine was added.';
	    $view = 'wines';
	    break;

    case 'update_wine':
  	
		$grapes = $_POST['Grapes'];
        
        $_POST = cleanForDB($_POST);
	    extract($_POST);

	  	$StyleExplosion = explode('-', $Style);
	    
	    $Colour = $StyleExplosion[0];
	    $SpecialType = $StyleExplosion[1];
	    
	    if($Year == '') $Year = 0;
	    if($AlcoholByVolume == '') $AlcoholByVolume = 0;
	    
	    $u = "UPDATE Wines SET WineryID = $WineryID, Brand = '$Brand', Name = '$Name', Colour = '$Colour', Year = $Year, Description = '$Description', TastingNotes = '$TastingNotes', Image = '$Image', AvailableAtLCBO = '$AvailableAtLCBO', AvailableAtWinery = '$AvailableAtWinery', AlcoholByVolume = $AlcoholByVolume, IsFeatured = '$IsFeatured', IsActive = '$IsActive', SpecialType = '$SpecialType', Awards = '$Awards' WHERE WineID = $WineID";
	    
	    if (good_query($u))	$message = 'The wine was updated';
	    else {
			$there_was_an_error = true;
			$message = 'There was an error in module ' . $action;    
	    }

	    //Update WinesXGrapes
	    good_query("DELETE FROM WinesXGrapes WHERE WineID = $WineID");
	    	    
	    foreach($grapes as $key=>$value)
	    	good_query("INSERT INTO WinesXGrapes (WineID, GrapeID) VALUES ($WineID, $value)");
	    
	    break;
	    
    
    case 'delete_wine':
	    extract($_GET);
	    $d = "DELETE FROM Wines WHERE WineID = $WineID";
	    $go = good_query($d);
	    $message = 'The wine was deleted.';
	    $view = 'wines';
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