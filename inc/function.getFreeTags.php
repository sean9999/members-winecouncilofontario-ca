<?php
//	get all unique tags from the Tags database and return it as an array
function getFreeTags($RegionID=NULL) {
	connect2database();
	$total_tags = good_query_table("SELECT * FROM Tags");
	$raw_tags = array();
	foreach ($total_tags as $t) $raw_tags[] = $t['Tag'];
	//	remove duplicates
	$r = array_flip(array_flip($raw_tags));
	return $r;
	}
?>
