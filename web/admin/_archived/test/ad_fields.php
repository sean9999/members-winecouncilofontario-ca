<input type="hidden" name="testID" value="<?= empty($thing['testID'])?'':$thing['testID'] ?>" />
<tr class="hidden">
	<td class="name">testID:</td>
	<td><input type="text" name="testID" value="<?= empty($thing['testID'])?'':$thing['testID'] ?>" class="full_width" readonly="readonly" disabled="disabled"/></td>
</tr>
<tr>
	<td>Name:</td>
	<td><input type="text" name="Name" value="<?= empty($thing['Name'])?'':$thing['Name'] ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Description:</td>
	<td><textarea name="Description" class="full_width blurb"><?= empty($thing['Description'])?'':$thing['Description'] ?></textarea></td>
</tr>
<tr>
	<td>Permissions</td>
	<td>
	<p>Select which user-levels have visibility to this page.</p>
	<?php 
		$userArray = array('Owner', 'Employee', 'Non-Member', 'Trade');
		//$userArrayDB = array($thing['UserLevels']);
		//$implodedArray = implode(",", $userArrayDB);
		//$array = explode(",",$implodedArray);

		$array = explode(",", $thing['UserLevels'] );

		foreach ($userArray as $ua) {
			if (in_array($ua, $array)) {
				$extra_html = ' checked="checked"';
			} else {
				$extra_html = '';
			}
		
			echo '<input type="checkbox" value="'.$ua.'" name="UserLevels[]" '.$extra_html.'> '.$ua.'<br />';		
		
		}
	?>
	</td>
</tr>
