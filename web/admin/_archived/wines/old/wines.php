<?php
connect2database();
$le_sql = 'SELECT * FROM Wines';
$Wines = good_query_table($le_sql);
require_once INC . 'function.shortenText.php';
?>

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th><!-- edit --></th>
    <th><!-- delete --></th>
</tr>
<?php
foreach ($Wines as $w) {
	echo '<tr>';
	echo '	<td>'.$w['WineID'].'</td>';
	echo '	<td>'.$w['Name'].'</td>';
	echo '	<td><a href="?view=wine&WineID=' . $w['WineID'] . '">edit</a></td>';
	echo '	<td><a href="javascript:deleteWine(\'' . $w['WineID'] . '\')">delete</a></td>';
	echo '</tr>';
}
?>
</table>
</div>
	
