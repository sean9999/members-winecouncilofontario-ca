<?php
enable_chunks();
require_once 'function.WriteChunks.php';

switch ($action) {

	case 'spawn_XXXXX':
	$old_chunk	= getChunk($_GET['ChunkID']);
	$spawned	= spawnChunk($old_chunk);
	if ($spawned) {
		$message = 'The spawning was successful.';
	} else {
		$message = 'The spawning was not successful.';
	}
	break;

	case 'clone':
	$old_chunk	= getChunk($_GET['ChunkID']);
	$spawned	= cloneChunk($old_chunk);
	if ($spawned) {
		$message = 'The cloning was successful.';
	} else {
		$message = 'The cloning was not successful.';
	}
	break;

	case 'populate_SEONames':
	require_once 'function.characterConversions.php';
	$chunks = good_query_table("SELECT Title,ChunkID FROM Chunks WHERE SEOName IS NULL");
	//new dBug($chunks);
	foreach ($chunks as $c) {
		$le_SEOName = convertFromTitleToPath($c['Title']);		
		$u = good_query("UPDATE Chunks SET SEOName = '$le_SEOName' WHERE ChunkID = $c[ChunkID]");
	}
	$message = 'Search-engine friendly names have been populated';
	break;

	case 'move':
	//	get siblings
	$direction		= localize('direction');
	$this_chunk		= getChunk($_GET['ChunkID']);
	$changed 		= changeSortValue($_GET['ChunkID'],$direction);
	
	if ($changed) {
		$message = 'The Chunks Sort-value was changed.';
	} else {
		$message = 'There was an error';
	}
	
	$view			= 'lineage';
	$ProgenitorID	= $this_chunk['ChildOf'];
	
	break;

	case 'add_chunk':
	
	$P = cleanForChunksDB($_POST);
	//$P = $_POST;
	//$P = array_map("mysql_real_escape_string",$_POST);
	
	$P['Content'] = str_replace('<img src="images','<img src="/images',$P['Content']);
	$P['Excerpt'] = str_replace('<img src="images','<img src="/images',$P['Excerpt']);
	$P['Content'] = str_replace("'","&lsquo;",$P['Content']);
	
	$create		= createChunk($P);
	$message	= $create['message'];
	break;

	case 'edit_chunk':
	$P = cleanForChunksDB($_POST);
	//$P = $_POST;
	//$P = array_map("mysql_real_escape_string",$_POST);
		
	$P['Content'] = str_replace('<img src="images','<img src="/images',$P['Content']);
	$P['Excerpt'] = str_replace('<img src="images','<img src="/images',$P['Excerpt']);
	$P['Content'] = str_replace("'","&lsquo;",$P['Content']);
	
	$edit		= editChunk($P);
	if ($edit['Status'] == 'ok') 	$message = 'The chunk was altered.';
	else							$message = $edit['Error'];
	//new dBug($edit);
	break;

	case 'delete_chunk':
	$delete		= deleteChunk($_GET['ChunkID']);		
	$message	= $delete['Message'];
	$view		= 'chunks';
	break;

	default:
	new dBug($_POST);
	new dBug($_GET);
	$message = 'There was no routine written for action "'.$action.'"';

}

?>