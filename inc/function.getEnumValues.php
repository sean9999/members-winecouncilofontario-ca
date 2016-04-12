<?php 

function getEnumValues($table,$field)
{
	connect2database();
	
	$enum = good_query_value("	SELECT COLUMN_TYPE
								FROM INFORMATION_SCHEMA.COLUMNS
								WHERE TABLE_NAME = '$table'
								AND COLUMN_NAME = '$field'" );
	
	$enum = str_replace('enum(', '', $enum);
	$enum = str_replace(')', '', $enum);
	$enum = str_replace("'", '', $enum);
	
	return explode(',' , $enum);
}

?>