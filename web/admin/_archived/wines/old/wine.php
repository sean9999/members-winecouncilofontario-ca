<?php
connect2database();
include INC . 'function.characterConversions.php';
$w = good_query_assoc('SELECT * FROM Wines WHERE WineID = ' . $_GET['WineID']); 
extract($w);
?>

<div class="breadcrumb"><a href="index.php"><? $section ?></a> &raquo; <?= $Name ?></div>

<form method="post" action="?action=update_wine">
<input type="hidden" name="WineID" value="<?= $WineID ?>" />

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td>NAME:</td>
	<td><input type="text" name="Name" value="<?= $Name ?>" class="full_width" /></td>
</tr>
<tr>
	<td colspan="2" align="right">
	<input type="submit" name="save" value="Submit" />
	<input type="reset" name="reset" value="Reset" />
	</td>
</tr>
</table>
</div>
</form>
</div>


