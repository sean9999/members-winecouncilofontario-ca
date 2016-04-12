<form name="new_Wine" action="?action=create_attraction" method="post">

<div class="pretty_table_wrapper">
<h1><br /><br /><br />add an Attraction</h1>
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td>Choose Category</td>
	<td>
	<select name="Tags1">
		<option value=""> -- choose a category -- </option>
		<?php
		$cats = good_query_table("SELECT DISTINCT Tags FROM Attractions");
		foreach ($cats as $c) {
		echo '<option value="'.$c['Tags'].'">'.$c['Tags'].'</option>';
		}
		?>
	</select>
	</td>
</tr>
<tr>
	<td>Or Type a New Category:</td>
	<td><input type="text" name="Tags2" value="" class="full_width" /></td>
</tr>
<tr>
	<td>Title:</td>
	<td><input type="text" name="Title" value="" class="full_width" /></td>
</tr>
<tr>
	<td>Content:</td>
	<td><textarea name="Content" class="richText" rows="10" cols="50" id="Content"></textarea></td>
</tr>
<tr>
	<td>Region:</td>
	<td>
	<select name="RegionID">
	<option value="0"> -- chose region -- </option>
	<?php
	$regions = good_query_table("SELECT Name,RegionID FROM Regions");
	foreach ($regions as $region) {
		echo '<option value="'.$region['RegionID'].'">'.$region['Name'].'</option>';
	}
	?>
	</select>
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
	<input type="submit" name="save" value="Submit" />
	<input type="reset" name="reset" value="Reset" />
	<a href="javascript:toggleEditor('Content');">[ RTF / HTML ]</a>
	</td>
</tr>
</table>
</div>
</form>