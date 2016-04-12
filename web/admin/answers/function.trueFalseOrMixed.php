<?php
function trueFalseOrMixed_x($arr) {
	//	returns string: "True", "False", "Mixed", or "Empty"
	$r = 'Empty';
	if (!empty($arr)) {
		if (in_array('True',$arr) && in_array('False',$arr)) {
			$r = 'Mixed';
		} elseif (in_array('True',$arr)) {
			$r = 'True';
		} else {
			$r = 'False';
		}
	}
	return $r;
}

function trueFalseOrMixed($arr) {
	$r = 'Empty';
	$has_truth = false;
	$has_falseness = false;
	if (!empty($arr)) {
		foreach ($arr as $row) {
			if ($row['Submitted'] == 'True') $has_truth = true;
			if ($row['Submitted'] == 'False') $has_falseness = true;
		}
		if ($has_truth && $has_falseness) {
			$r = 'Mixed';
		} elseif ($has_truth) {
			$r = 'True';
		} else {
			$r = 'False';
		}
	}	
	return $r;
}

?>