<?php
connect2database();
$tags = good_query_table("SELECT * FROM Regions"); 
?>

<div class="pretty_table_wrapper">
<table class="pretty fixedWidth" cellpadding="0" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Name</th>
<!--   
    <th>Lang</th>
    <th>GeoLocation</th>
-->   
    <th><!-- edit --></th>
    <th><!-- delete --></th>
</tr>
<?php
foreach ($tags as $t) {
	echo '<tr>';
	echo '	<td>'.$t['RegionID'].'</td>';
	echo '	<td><a href="?view=region&RegionID=' . $t['RegionID'] . '">'.$t['Name'].'</a></td>';
	echo '	<!--<td>'.$t['Language'].'</td>-->';
	echo '	<!--<td><a href="'.$t['GeoLocation'].'" target="googlemaps">view</a></td>-->';
	echo '	<td class="dedit"><a href="?view=region&RegionID=' . $t['RegionID'] . '" class="edit">edit</a></td>';
	echo '	<td class="dedit"><a href="javascript:deleteRegion(\'' . $t['RegionID'] . '\')" class="delete">delete</a></td>';	
	echo '</tr>';
}
?>
</table>
</div>