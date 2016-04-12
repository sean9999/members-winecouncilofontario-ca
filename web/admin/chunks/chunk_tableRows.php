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
		$availableParents = getAvailableParents($c['ChunkID']);
		
		//$availableParents = getFoundingFathers();
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
<!--
<tr>
	<td>Content (fr)<br /><a href="javascript:toggleEditor('Content_fr')" class="toggle">Toggle RTF/HTML</a></td>
	<td><textarea name="Content_fr" id="Content_fr" rows="18" cols="65" class="tinymce"><?= $c['Content_fr'] ?></textarea></td>
</tr>
<tr>
	<td>Marquee<br /><a href="javascript:toggleEditor('Excerpt')" class="toggle">Toggle RTF/HTML</a></td>
	<td><textarea name="Excerpt" id="Excerpt" rows="10" cols="65" class="tinymce"><?= $c['Excerpt'] ?></textarea></td>
</tr>
-->
<tr>
	<td>Tags</td>
	<td><textarea name="Tags" id="Tags" rows="4" cols="65"><?= $c['Tags'] ?></textarea></td>
</tr>

<?php //new dBug($c) ?>
