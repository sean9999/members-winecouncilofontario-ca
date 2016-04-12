<?php
connect2database();
switch ($action) {

	case 'delete_tag':
	$G		= cleanForDB($_GET);
	$kill	= good_query("DELETE FROM Tags WHERE TagID = $G[tag_id]");
	$message= 'The tag was deleted.';
	break;

	case 'add_tag':
	$P		= cleanForDB($_POST);
	$add	= good_query("INSERT INTO Tags (Tag) Values('$P[Tag]')");
	$message= 'The tag was added.';
	break;

	default:
	new dBug($_GET);
	new dBug($_POST);	
	$message = 'There was no routine written for action <em>' . $action . '</em>.';
	break;

}

?>