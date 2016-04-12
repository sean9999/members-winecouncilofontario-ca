<input type="hidden" name="testID" value="" />
<tr class="hidden">
	<td class="name">testID:</td>
	<td><input type="text" name="testID" value="" class="full_width" readonly="readonly" disabled="disabled"/></td>
</tr>
<tr>
	<td>Name:</td>
	<td><input type="text" name="Name" value="" class="full_width" /></td>
</tr>
<tr>
	<td>Description:</td>
	<td><textarea name="Description" class="full_width blurb"></textarea></td>
</tr>
<tr>
	<td>Permissions</td>
	<td>
	<p>Select which user-levels have visibility to this page.</p>
	<?php 
		$userArray = array('Owner', 'Employee', 'Non-Member', 'Trade');
		foreach ($userArray as $ua) {
			echo '<input type="checkbox" name="UserLevels[]" value="'.$ua.'"> '.$ua.'<br />';		
		
		}
	?>
	</td>
</tr>
