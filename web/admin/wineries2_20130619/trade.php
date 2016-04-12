<?php
connect2database();
$le_sql = <<<BLOCK
	SELECT * FROM Wineries WHERE IsWinery = 0 ORDER BY Name
BLOCK;
$wineries = good_query_table($le_sql);
?>


<div class="pretty_table_wrapper">
<table class="pretty fixedWidth" cellpadding="0" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th><!-- edit --></th>
    <th><!-- delete --></th>
</tr>
<?php
foreach ($wineries as $w) {
?>
<tr>
	<td class="dedit"><em><?= $w['WineryID'] ?></em></td>
	<td>
	<?php if ($w['isMember'] == 1) echo '<strong>'; ?>
	<a href="?view=winery&WineryID=<?= $w['WineryID'] ?>"><?= $w['Name'] ?></a>
	<?php if ($w['isMember'] == 1) echo '</strong> (Member Winery)'; ?>
	</td>
	<td class="dedit"><a href="?view=winery&WineryID=<?= $w['WineryID'] ?>" class="edit">edit</a></td>
	<td class="dedit"><a href="javascript:deleteWinery('<?= $w['WineryID'] ?>')" class="delete">delete</a></td>
</tr>
<?php
}
?>
</table>
</div>
