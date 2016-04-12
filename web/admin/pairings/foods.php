<?php
connect2database();
$le_sql = 'SELECT * FROM Foods';
$foods = good_query_table($le_sql);

?>

<select name="food" multiple="multiple" size="<?= (int) sizeof($foods) ?>">
<?php
foreach ($foods as $f) {
?>
	<option value="<?= $f['FoodID'] ?>"><?= $f['Name'] ?></option>
<?php
}
?>
</select>

<button name="delete_food" id="delete_food" onclick="deleteFood(this.form.food.value)" type="button">delete</button>
