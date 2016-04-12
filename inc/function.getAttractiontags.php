<?php
//	get an array of all Attraction Tags
function getAttractionTags($RegionID=NULL) {
	$fullgroup		= array();
	$uniquegroup	= array();
	connect2database();
	/*
	if (is_null($RegionID)) {
		$attractions = good_query_table("SELECT DISTINCT Tags FROM Attractions");
	} else {
		$attractions = good_query_table("SELECT DISTINCT Tags FROM Attractions WHERE RegionID = $RegionID");
	}
	*/
	$attractions = good_query_table("SELECT DISTINCT Tags FROM Attractions");
	foreach ($attractions as $a) {
		$g = explode(',',$a['Tags']);
		foreach($g as $x) {
			$fullgroup[] = $x;
		}
	}
	$uniquegroup = array_unique($fullgroup);
	return $uniquegroup;
}
?>
