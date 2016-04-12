<?php
connect2database();
$le_sql = <<<BLOCK
	SELECT w.Name,w.WineryID,w.WineryNumber,w.Name,w.isMember,w.GeoLocation,SUBSTRING(w.Description,1,50) AS ShortenedDescription,r.Name AS RegionName
	FROM Wineries AS w
	INNER JOIN Regions AS r
	ON w.RegionID = r.RegionID
	ORDER BY r.Name, w.Name ASC
BLOCK;
$wineries = good_query_table($le_sql);
require_once 'function.shortenText.php';
?>

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
    <th>Number/ID</th>
    <th>Name</th>
    <th>Region</th>
    <th>GeoLocation</th>
    <th><!-- edit --></th>
    <th><!-- delete --></th>
</tr>
<?php
foreach ($wineries as $w) {
?>
<tr>
	<td>Guide: <?= $w['WineryNumber'] ?><br /><em>ID: <?= $w['WineryID'] ?></em></td>
	<td>
	<?php if ($w['isMember'] == 1) echo '<strong>'; ?>
	<a href="?view=winery&WineryID=<?= $w['WineryID'] ?>"><?= $w['Name'] ?></a>
	<?php if ($w['isMember'] == 1) echo '</strong>'; ?>
	</td>
	<td class="smallText"><?= $w['RegionName'] ?></td>
	<td class="smallText"><a href="<?= $w['GeoLocation'] ?>" target="googlemaps">view map</a></td>
	<td class="dedit"><a href="?view=winery&WineryID=<?= $w['WineryID'] ?>" class="edit">edit</a></td>
	<td class="dedit"><a href="javascript:deleteWinery('<?= $w['WineryID'] ?>')" class="delete">delete</a></td>
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
