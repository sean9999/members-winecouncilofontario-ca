<?php
connect2database();
$le_sql = <<<BLOCK
	SELECT w.Name,w.WineryID,w.IsWinery,w.Name,w.isMember,w.RegionID,r.Name AS RegionName
	FROM Wineries AS w
	INNER JOIN Regions AS r
	ON w.RegionID = r.RegionID
	ORDER BY r.Name, w.Name ASC
BLOCK;
$wineries = good_query_table($le_sql);
?>

<div class="pretty_table_wrapper">
<table class="pretty fixedWidth" cellpadding="0" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Region</th>
    <th><!-- edit --></th>
    <th><!-- delete --></th>
</tr>
<?php
foreach ($wineries as $w) {
	if ($w['IsWinery'] == 1) {
?>
<tr>
	<td class="dedit"><em><?= $w['WineryID'] ?></em></td>
	<td>
	<?php if ($w['isMember'] == 1) echo '<strong>'; ?>
	<a href="?view=winery&WineryID=<?= $w['WineryID'] ?>"><?= $w['Name'] ?></a>
	<?php if ($w['isMember'] == 1) echo '</strong> (Member Winery)'; ?>
	</td>
	<td class="smallText"><?= $w['RegionName'] ?></td>
	<td class="dedit"><a href="?view=winery&WineryID=<?= $w['WineryID'] ?>" class="edit">edit</a></td>
	<td class="dedit"><a href="javascript:deleteWinery('<?= $w['WineryID'] ?>')" class="delete">delete</a></td>
</tr>
<?php
	}
}
?>
</table>
</div>
