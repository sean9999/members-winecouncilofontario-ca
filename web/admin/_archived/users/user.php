<div id="editUser">
<div class="pretty_table_wrapper">

<h1>User</h1>

<form name="modify_user" action="?action=update_user" method="post">
<table class="pretty">
<?php
include_once 'user_fields.php';
?>
<tr>
<td colspan="2">
<button name="change" type="submit" >modify the user</button>
</td>
</tr>
</table>
</form>
</div>
</div>