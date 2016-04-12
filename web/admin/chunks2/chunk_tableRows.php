<input type="hidden" name="TypeID" value="<?= (int) $c['TypeID'] ?>" />
<tr>
	<td>Name</td>
	<td><input type="text" name="Name" size="66" value="<?= $c['Name'] ?>" /></td>
</tr>
<tr>	
	<td>Title</td>
	<td><input type="text" name="Title" size="66" value="<?= $c['Title'] ?>" /></td>
</tr>
<!--
<tr>	
	<td>Title (fr)</td>
	<td><input type="text" name="Title_fr" size="66" value="<?= $c['Title_fr'] ?>" /></td>
</tr>
-->
<tr>
	<td>SeoName</td>
	<td><input type="text" name="SEOName" size="66" value="<?= $c['SEOName'] ?>" /></td>
</tr>
<tr style="display:none;">
	<td>Language</td>
	<td><input type="text" name="Language" size="66" value="<?= $c['Language'] ?>" /></td>
</tr>
<tr style="display:none;">
	<td>Publish Status</td>
	<td>
	<select name="Stratum">
		<?php
			require_once 'function.getStratumNames.php';
			for ($i = 2; $i > -5;$i-=1) {
			if ($i == $c['Stratum']) {
				$extra_HTML = ' selected="selected"';
			} else {
				$extra_HTML = '';
			}
			$StratumName = getStratumName($i);
			echo '<option value="'.$i.'"'.$extra_HTML.'>'.$StratumName.'</option>';
			}
		?>
	</select>
	</td>
</tr>
<tr>
	<td>Parent</td>
	<td>
	<select name="ChildOf">
		<option value="NULL"> - Is Vagabond - </option>
		<?php
		$extra_HTML = '';
		if ($c['ChildOf'] == 0 && is_numeric($c['ChildOf'])) $extra_HTML = ' selected="selected"';
		?>  
		<option value="0"<?= $extra_HTML ?>> - Is Progenitor - </option>
		<?php
		$criteria = array('fields' => 'ChunkID,Title,ChildOf,SortValue','criterea' => 'ChildOf = 0','sortby' => 'SortValue ASC');
		$availableParents = getChunk($criteria);

		foreach ($availableParents as $a) {
			if ($a['ChunkID'] == $c['ChildOf']) {
				$extra_HTML = ' selected="selected"';
			} else {
				$extra_HTML = '';
			}
			echo '<option value="'.$a['ChunkID'].'"'.$extra_HTML.'>';
			if ($a['ChildOf']) echo ' - ';
			echo $a['Title'].'</option>';
		}
		?>
	</select>
	</td>
</tr>
<tr>
	<td>Content<br /><a href="javascript:toggleEditor('Content')" class="toggle">Toggle RTF/HTML</a></td>
	<td><textarea name="Content" id="Content" rows="18" cols="65" class="tinymce"><?= $c['Content'] ?></textarea></td>
</tr>
<tr>
	<td>Tags</td>
	<td><textarea name="Tags" id="Tags" rows="4" cols="65"><?= $c['Tags'] ?></textarea></td>
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
		$array = explode(",", $c['UserLevels'] );
		foreach ($userArray as $ua) {
			if (in_array($ua, $array)) {
				$extra_html = ' checked="checked"';
			} else {
				$extra_html = '';
			}
		
			echo '<input type="checkbox" value="'.$ua.'" name="UserLevels[]" '.$extra_html.'  class="not_full_width"> '.$ua.'<br />';		
		
		}
	?>

	<?php
	/*
		echo '<hr />';
		echo '<p>Some quickie dBug stuff.</p>';
		echo '<p>string: <strong>';
		echo $c['UserLevels'];
		echo '</strong></p>';
	*/
	?>
	</td>
</tr>

<?php //new dBug($c) ?>
