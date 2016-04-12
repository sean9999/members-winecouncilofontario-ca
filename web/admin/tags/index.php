<?php
require_once '../../vars.php';
$action = localize('action');
if (isset($action) && strlen($action)) require_once 'actions.php';
connect2database();
$tags = good_query_table("SELECT * FROM Tags ORDER BY TagID ASC");
include '../header.php';

?>

<div class="pretty_table_wrapper">

<h1>Tags</h1>

<table class="pretty">
<tr>
	<th><!-- Tag --></th>
	<th><!-- Delete Button --></th>
</tr>
<?php foreach ($tags as $tag) { ?>
<tr>
	<td><?= $tag['Tag'] ?></td>
	<td><button type="button" onclick="deleteTag(<?= $tag['TagID'] ?>)">delete</button></td>
</tr>
<?php } ?>
</table>

<h1><br /><br /><br />Add a tag</h1>

<form name="addtag" action="?action=add_tag" method="post">
<table class="pretty">
<tr>
<td><input type="text" name="Tag" size="44" /></td>
<td><button type="submit">create it</button></td>
</tr>
</table>
</form>

</div>
<?php
include '../footer.php';
?>