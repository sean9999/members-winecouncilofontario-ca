<?php
require_once 'vars.php';
include 'header.php';
?>

<?php
if (isset($_POST)) new dBug($_POST);
?>

<h1>Add a Wine + any number (greater than zero) of bottles of that wine</h1>

<form name="x" id="x" action="?action=submit" method="post">
<table>
<tr>
	<td>Name</td>
	<td><input type="text" name="name" value="" /></td>
</tr>
<tr>
	<td>Year</td>
	<td><input type="text" name="year" value="" /></td>
</tr>

<div class="bottle">

	<tr>
		<td>Bottle Volume</td>
		<td><input type="text" name="bottlevolume[]" value="" /></td>
	</tr>
	<tr>
		<td>Bottle Price</td>
		<td><input type="text" name="bottleprice[]" value="" /></td>
	</tr>

</div>
</table>

<button type="button" id="addbottle">add a bottle</button>

<button type="submit">submit</button>

</form>

<?php
include 'footer.php';
?>