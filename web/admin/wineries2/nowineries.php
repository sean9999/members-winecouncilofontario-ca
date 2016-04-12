<?php
connect2database();
$le_sql = <<<BLOCK
	SELECT * FROM Wineries WHERE RegionID = 0 ORDER BY Name
 
BLOCK;
$wineries = good_query_table($le_sql);
require_once 'function.shortenText.php';
?>

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
    <th>Number/ID</th>
    <th>Name</th>
    <th><!-- edit --></th>
    <th><!-- delete --></th>
</tr>
<?php
foreach ($wineries as $w) {
?>
<tr
<?php if ($w['WineryID'] > 299) { echo 'style="display:none;"'; }?>>
	<td>Guide: <?= $w['WineryNumber'] ?><br /><em>ID: <?= $w['WineryID'] ?></em></td>
	<td>
	<a href="?view=winery&WineryID=<?= $w['WineryID'] ?>"><?= $w['Name'] ?></a>
	</td>
	<td><a href="?view=winery&WineryID=<?= $w['WineryID'] ?>" class="edit">edit</a></td>
	<td><a href="javascript:deleteWinery('<?= $w['WineryID'] ?>')" class="delete">delete</a></td>
</tr>
<?php
}
?>
</table>
</div>




<?php /*

	echo '<tr>';
	echo '	<td>'.$w['WineryNumber'].'</td>';
	echo '	<td><a href="?view=winery&WineryID=' . $w['WineryID'] . '">'.$w['Name'].'</a></td>';
	echo '	<td>'.$w['RegionName'].'</td>';
	echo '	<td class="smallText">'.$w['ShortenedDescription'].'</td>';
	echo '	<td class="smallText"><a target="googlemaps" href="'.$w['GeoLocation'].'">view map</a></td>';
	echo '	<td><a href="?view=winery&WineryID=' . $w['WineryID'] . '">edit</a></td>';
	echo '	<td><a href="javascript:deleteWinery(\'' . $w['WineryID'] . '\')">delete</a></td>';	
	echo '</tr>';


*/
?>