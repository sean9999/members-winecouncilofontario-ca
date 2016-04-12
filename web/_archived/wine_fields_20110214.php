<input type="hidden" name="WineryID" value="<?= $userData['WineryID'] ?>" />
<input type="hidden" name="WineID" value="<?= empty($wine['WineID'])?'':$wine['WineID'] ?>" />
<tr>
	<td class="left">
		Wine Brand:
	</td>
	<td class="right">
		<input type="text" type="text" name="Brand" value="<?= empty($wine['Brand'])?'':$wine['Brand'] ?>" width="50" />
	</td>
</tr>
<tr>
	<td class="left">
		Wine Name:
	</td>
	<td class="right">
		<input type="text" type="text" name="Name" value="<?= empty($wine['Name'])?'':$wine['Name'] ?>" width="50" />
	</td>
</tr>
<tr>
	<td class="left">
		Style:
	</td>
	<td class="right">
		<select name="Style">
			<option value="Red-" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'Red'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == '') echo 'selected="selected"'; ?>>Red</option>
			<option value="White-" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'White'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == '') echo 'selected="selected"'; ?>>White</option>
			<option value="Rose-" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'Rose'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == '') echo 'selected="selected"'; ?>>Rose</option>
			<option value="Red-Sparkling" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'Red'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == 'Sparkling') echo 'selected="selected"'; ?>>Red Sparkling</option>
			<option value="White-Sparkling" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'White'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == 'Sparkling') echo 'selected="selected"'; ?>>White Sparkling</option>
			<option value="Rose-Sparkling" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'Rose'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == 'Sparkling') echo 'selected="selected"'; ?>>Rose Sparkling</option>
			<option value="Red-Icewine" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'Red'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == 'Ice') echo 'selected="selected"'; ?>>Red Icewine</option>
			<option value="White-Icewine" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'White'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == 'Ice') echo 'selected="selected"'; ?>>White Icewine</option>
			<option value="Rose-Icewine" <?php if(!empty($wine['Colour']) && $wine['Colour'] == 'Rose'  && !empty($wine['SpecialType']) && $wine['SpecialType'] == 'Ice') echo 'selected="selected"'; ?>>Rose Icewine</option>
		</select>
	</td>
</tr>
<tr>
	<td class="left">
		Grapes:
	</td>
	<td class="right">
		Check all grapes that are part of your wine.
		<div class="clearer"></div>
		<ul class="grapes">
		<?php 
		$grapes = good_query_table("SELECT * FROM Grapes ORDER BY Name ASC");
		
		$otherChecked = '';
		foreach($grapes as $g)
		{
			$checked = '';
			
			if(!empty($wine['WineID']))
			{
				$r = good_query_table("SELECT * FROM WinesXGrapes WHERE WineID = " . $wine['WineID'] . " AND GrapeID = " . $g['GrapeID']);
				
				if( count($r) > 0 )
					$checked = 'checked="checked"';
			}
			
			if($g['GrapeID'] == 0)
			{
				$otherChecked = $checked;
				continue;
			}
		?>
			<li><input class="grape" type="checkbox" name="Grapes[]" value="<?= $g['GrapeID'] ?>" <?= $checked ?> /><?= $g['Name']?></li>
		<?php } ?>
			<li><input class="grape" type="checkbox" name="Grapes[]" value="0" <?= $otherChecked ?> />Other</li>
		</ul>
	</td>
</tr>
<tr>
	<td class="left">
		Description:
	</td>
	<td class="right">
		<textarea name="Description" id="Description" class="richText" cols="50" rows="10"><?= empty($wine['Description'])?'':$wine['Description'] ?></textarea>
	</td>
</tr>
<tr>
	<td class="left">
		Featured Wine?:
	</td>
	<td class="right">
		<?php
			$checked = '';
			if(!empty($wine['IsFeatured']) && $wine['IsFeatured'] == 'Yes')
				$checked = 'checked="checked"'; 
		?>
		<input type="checkbox" name="IsFeatured" value="Yes" id="##" class="check" <?= $checked ?>> Checking this makes this your featured wine.
	</td>
</tr>
<tr>
	<td class="left">
		Active?:
	</td>
	<td class="right">
		<?php
			$checked = '';
			if(!empty($wine['IsActive']) && $wine['IsActive'] == 'Yes')
				$checked = 'checked="checked"'; 
		?>
		<input type="checkbox" name="IsActive" value="Yes" id="##" class="check" <?= $checked ?>> Checking this makes this your wine visible on the main site and the mobile site.
	</td>
</tr>