<?php
connect2database();
$le_sql = 'SELECT * FROM Attractions';
$Attractions = good_query_table($le_sql);
require_once 'function.shortenText.php';
?>

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Category</th>
    <th>Region</th>
    <th>Title</th>
    <th><!-- edit --></th>
    <th><!-- delete --></th>
</tr>
<?php
foreach ($Attractions as $w) {
	echo '<tr>';
	echo '	<td>'.$w['AttractionID'].'</td>';
	echo '	<td>'.$w['Tags'].'</td>';
	echo '	<td>'.good_query_value("SELECT Name FROM Regions WHERE RegionID = $w[RegionID]").'</td>';
	echo '	<td>'.$w['Title'].'</td>';
	echo '	<td><a href="?view=attraction&AttractionID=' . $w['AttractionID'] . '">edit</a></td>';
	echo '	<td><a href="javascript:deleteAttraction(\'' . $w['AttractionID'] . '\')">delete</a></td>';
	echo '</tr>';
}
?>
</table>
</div>
	
