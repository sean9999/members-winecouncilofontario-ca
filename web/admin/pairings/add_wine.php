<?php
//connect2database();
$winetypes	= good_query_table("SELECT DISTINCT Colour FROM Wines");
?>

<select name="winetype">
	<option value=""> - select a colour - </option>
<?php
foreach ($winetypes as $t) {
?>
	<option value="<?= $t['Colour'] ?>"><?= $t['Colour'] ?></option>
<?php
}
?>
</select>
<br />
<button name="add_wine" type="button" onclick="addWine(this.form.winetype.value)">Add wine</button>