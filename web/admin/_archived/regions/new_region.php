<form name="new_user" action="?action=create_region" method="post">

<div class="pretty_table_wrapper">
<h1><br /><br /><br />add a region</h1>
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td width="100">Name:</td>
	<td><input type="text" name="Name" class="full_width" /></td>
</tr>
<tr>
	<td>Description:</td>
	<td><textarea name="Description" id="Description" class="richText" cols="50" rows="10"></textarea></td>
</tr>
<tr>
	<td>GeoLocation</td>
	<td><input type="text" name="GeoLocation" class="full_width" /></td>
</tr>
<tr>
	<td colspan="2" align="right">
	<input type="reset" value="clear" />
	<input type="submit" value="add it" />
	<a href="javascript:toggleEditor('Description');">[ RTF / HTML ]</a>
	</td>
</tr>
</table>
</div>

</form>