<?php 

$wineries = good_query_table('SELECT * FROM Wineries ORDER BY Name ASC');

?>

<input type="hidden" name="WineID" value="<?= empty($wine['WineID'])?'':$wine['WineID'] ?>" />
<tr>
	<td>WineID:</td>
	<td><input type="text" name="WineID" value="<?= empty($wine['WineID'])?'':$wine['WineID'] ?>" class="full_width" readonly="readonly" disabled="disabled"/></td>
</tr>
<tr>
	<td>Winery:</td>
	<td>
		<select name="WineryID">
			<option value="0">--None--</option>
			<?php foreach($wineries as $w) {?>
			<option value="<?= $w['WineryID']?>" <?php if(!empty($wine['WineryID']) && $wine['WineryID'] == $w['WineryID']) echo 'selected="selected"'; ?>><?= $w['Name']?></option>
			<?php } ?>
		</select>
	</td>
</tr>
<tr>
	<td>Brand:</td>
	<td><input type="Brand" name="Brand" value="<?= empty($wine['Brand'])?'':$wine['Brand'] ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Name:</td>
	<td>
		<input type="text" name="Name" value="<?= empty($wine['Name'])?'':$wine['Name'] ?>" class="full_width" />
	</td>
</tr>
<tr>
	<td>Style:</td>
	<td>
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
	<td>Year:</td>
	<td>
		<select name="Year">
			<?php
			for($i = ((int) date('Y')); $i >= 1900; $i--){ ?>
			<option value="<?= $i ?>" <?php if(!empty($wine['Year']) && $wine['Year'] == $i) echo 'selected="selected"'; ?>><?= $i ?></option>	
			<?php }?>
		</select>
	</td>
</tr>
<tr>
	<td>Description:</td>
	<td><textarea name="Description" id="Description" class="richText" cols="50" rows="10"><?= empty($wine['Description'])?'':$wine['Description'] ?></textarea></td>
</tr>
<tr>
	<td>Tasting Notes:</td>
	<td>
		<ul id="TastingNotes"></ul>
	</td>
</tr>
<tr>
	<td>Image:</td>
	<td>
		<input type="text" name="Image" id="Image" value="<?= empty($wine['Image'])?'':$wine['Image'] ?>" class="full_width" />
		<a href="#" onclick="mcImageManager.browse({fields : 'Image', no_host: true, rootpath : '{0}/wines'});">[change]</a>
	</td>
</tr>
<tr>
	<td>Available at the LCBO:</td>
	<td>
		<select name="AvailableAtLCBO">
			<option value="No" <?php if(!empty($wine['AvailableAtLCBO']) && $wine['AvailableAtLCBO'] == 'No') echo 'selected="selected"'; ?>>No</option>
			<option value="Yes" <?php if(!empty($wine['AvailableAtLCBO']) && $wine['AvailableAtLCBO'] == 'Yes') echo 'selected="selected"'; ?>>Yes</option>
		</select>	
	</td>
</tr>
<tr>
	<td>Available at the Winery:</td>
	<td>
		<select name="AvailableAtWinery">
			<option value="No" <?php if(!empty($wine['AvailableAtWinery']) && $wine['AvailableAtWinery'] == 'No') echo 'selected="selected"'; ?>>No</option>
			<option value="Yes" <?php if(!empty($wine['AvailableAtWinery']) && $wine['AvailableAtWinery'] == 'Yes') echo 'selected="selected"'; ?>>Yes</option>
		</select>
	</td>
</tr>
<tr>
	<td>Alcohol By Volume:</td>
	<td><input type="text" name="AlcoholByVolume" value="<?= empty($wine['AlcoholByVolume'])?'':$wine['AlcoholByVolume'] ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Featured:</td>
	<td>
		<select name="IsFeatured">
			<option value="No" <?php if(!empty($wine['IsFeatured']) && $wine['IsFeatured'] == 'No') echo 'selected="selected"'; ?>>No</option>
			<option value="Yes" <?php if(!empty($wine['IsFeatured']) && $wine['IsFeatured'] == 'Yes') echo 'selected="selected"'; ?>>Yes</option>
		</select>
	</td>
</tr>
<tr>
	<td>Active:</td>
	<td>
		<select name="IsActive">
			<option value="No" <?php if(!empty($wine['IsActive']) && $wine['IsActive'] == 'No') echo 'selected="selected"'; ?>>No</option>
			<option value="Yes" <?php if(!empty($wine['IsActive']) && $wine['IsActive'] == 'Yes') echo 'selected="selected"'; ?>>Yes</option>
		</select>
	</td>
</tr>
<tr>
	<td>Awards:</td>
	<td>
		<ul id="Awards"></ul>
	</td>
</tr>
<tr>
	<td>Grapes:</td>
	<td>
		<?php 
		$grapes = good_query_table("SELECT * FROM Grapes");

		foreach($grapes as $g)
		{
			$checked = '';
			
			if(!empty($wine['WineID']))
			{
				$r = good_query_table("SELECT * FROM WinesXGrapes WHERE WineID = " . $wine['WineID'] . " AND GrapeID = " . $g['GrapeID']);
				
				if( count($r) > 0 )
					$checked = 'checked="checked"';
			}
		?>
			<input type="checkbox" name="Grapes[]" value="<?= $g['GrapeID'] ?>" <?= $checked ?>/><?= $g['Name']?>
		<?php }?>
	</td>
</tr>

