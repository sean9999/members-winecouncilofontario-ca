<?php
$user = array();
?>
<div id="addUser">
<div class="pretty_table_wrapper">
	<h2>Add a User</h2>
	<table border="1" class="chunktable pretty">
	<form name="new_author" action="?action=create_user" method="post">
	<?php
	include 'user_fields.php';
	?>
	<tr>
		<td colspan="2"><button name="create" type="submit">Create the user</button></td>
	</tr>
	</form>
	</table>
</div>
</div>