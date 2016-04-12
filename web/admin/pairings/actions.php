<?php
ob_start();
connect2database();
$G = cleanForDB($_GET);
$P = cleanForDB($_POST);
switch ($action) {

	case 'create_food':
	$ins = good_query("INSERT INTO Foods (Name,Name_fr) VALUES ('$G[foodname_en]','$G[foodname_fr]')");
	$message = 'THe food was created.';
	break;

	case 'add_wine':
	$ins = good_query("INSERT INTO Wines (Name,Colour) VALUES ('$G[wn]','$G[wc]')");
	$message = 'The wine was added to the database.';
	break;

	case 'create_pair':
	$ins = good_query("INSERT INTO WineFoodPairings (WineID,FoodID) VALUES ($P[wine],$P[food])");
	$message = 'The pair was created.';
	break;

	case 'delete_pair':
	$x = good_query("DELETE FROM WineFoodPairings WHERE WFPID = $P[WFPID]");
	$message = 'The pairing has been deleted.';
	break;

	case 'delete_wine':
	$x = good_query("DELETE FROM Wines WHERE WineID = $G[WineID]");
	$message = 'The wine was deleted.';
	break;

	default:
	$message	= 'There has not been a routine written yet for action <em>' . $action . '</em>';
	new dBug($_POST);
	new dBug($_GET);
	break;

}

$debugstuff = ob_get_contents();
ob_end_clean();

?>