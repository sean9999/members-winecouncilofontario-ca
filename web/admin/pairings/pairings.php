<?php
connect2database();
$le_sql = <<<BLOCK
	SELECT	wfp.*, w.Name AS WineName, f.Name AS FoodName FROM WineFoodPairings AS wfp, Wines AS w, Foods AS f 
	WHERE	wfp.WineID = w.WineID
	AND		wfp.FoodID = f.FoodID
BLOCK;
$pairings = good_query_table($le_sql);

//new dBug($pairings);

?>

<div class="pretty_table_wrapper">
	<table class="pretty" cellpadding="0" cellspacing="0">
	<tr>
		<th>WFPID</th>
		<th>Wine</th>
		<th>Food</th>
		<th><!-- delete --></th>
	</tr>
	<?php
	foreach ($pairings as $p) {
	?>
	<tr>
		<td><?= $p['WFPID'] ?></td>
		<td><?= $p['WineName'] ?></td>
		<td><?= $p['FoodName'] ?></td>
		<td>
		<form name="delete_pairing" id="delete_pairing" action="?action=delete_pair" method="post">
		<input type="hidden" name="WFPID" value="<?= $p['WFPID'] ?>" />
		<button>delete</button>
		</form>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
</div>