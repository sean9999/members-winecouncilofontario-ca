<?php
connect2database();
$le_sql = 'SELECT * FROM Wines';
$wines = good_query_table($le_sql);

?>

<select name="wine" multiple="multiple" size="<?= (int) sizeof($wines) ?>">
<?php
foreach ($wines as $w) {
?>
	<option value="<?= $w['WineID'] ?>"><?= $w['Name'] ?> (<?= $w['Colour'] ?>)</option>
<?php
}
?>
</select>

<button name="delete_wine" id="delete_wine" onclick="deleteWine(this.form.wine.value)" type="button">delete</button>
