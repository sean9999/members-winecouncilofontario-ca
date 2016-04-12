<?php
require_once '../../vars.php';
enable_chunks();
require_once 'function.WriteChunks.php';

$page_title = 'get user permissions';

include 'simple_header.php';

new dBug(getUserPermissions());

echo '<p>THe Project ID for ' . Chunks_Project . ' is ' . getProjectIDFromProjectName(Chunks_Project) . '</p>';

echo '<hr />';

echo 'getGeneration(1)';

function getGeneration2($getgen,$props=NULL) {

	// 0 is the highest generation (Progenitors)
	$props = correctifyProps($props);
	$gen = getProgenitors(array('fields' => 'ChunkID,ChildOf'));
	$gen_ids = array();
	foreach ($gen as $g) $gen_ids[] = $g['ChunkID'];
	$gen_id_list = implode(',',array_unique($gen_ids));
	
	for ($i = 0; $i < $getgen; $i++) {
	
		$gen_ids	= array();
		$p			= array();
		
		$p['criterea']	= 'ChildOf IN ('.$gen_id_list.')';
		$p['fields']	= 'ChunkID,ChildOf';
		$gen = getChunk($p);
		foreach ($gen as $g) $gen_ids[] = $g['ChunkID'];
		$gen_id_list = implode(',',array_unique($gen_ids));
	}
	
	if (strlen($gen_id_list)) {
		
		$props['criterea'] = 'ChunkID IN ('.$gen_id_list.') AND ' . $props['criterea'];
		$props['return_structure'] = '3D';
		$o = getChunk($props);
	
	} else {
		$o = NULL;
	}
	return $o;
}


new dBug(getGeneration2(0));

new dBug(getGeneration2(1));


include 'simple_footer.php';
?>