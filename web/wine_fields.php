<?php 

include 'function.getEnumValues.php';

$winery = good_query_assoc("SELECT * FROM Wineries WHERE WineryID = $userData[WineryID]");

?>
<input type="hidden" name="WineryID" value="<?= $userData['WineryID'] ?>" />
<input type="hidden" name="WineID" value="<?= empty($wine['WineID'])?'':$wine['WineID'] ?>" />
<tr>
<td class="left">Winery:</td>
<td class="right"><strong><?= $winery['Name'] ?></strong></td>
</tr>
<tr>
	<td class="left">
		Wine Name:
	</td>
	<td class="right">
		<input type="text" type="text" name="Name" value="<?= empty($wine['Name'])?'':$wine['Name'] ?>" width="50" />
		<br /><em>Mandatory - Single wine such as:  Chardonnay Reserve; Black Paw Chardonnay, Sibling White, etc.</em>
	</td>
</tr>
<tr>
	<td class="left">
		Wine Brand:
	</td>
	<td class="right">
		<input type="text" type="text" name="Brand" value="<?= empty($wine['Brand'])?'':$wine['Brand'] ?>" width="50" />
		<br /><em>Optional - brand family of more than one offering eg.  Sibling Rivalry</em>
	</td>
</tr>
<tr>
	<td class="left">
		Year:
	</td>
	<td class="right">
		<select name="Year">
			<option value="0">--Choose a Year--</option>
			<?php
			for($i = ((int) date('Y')); $i >= 1900; $i--){ ?>
			<option value="<?= $i ?>" <?php if(!empty($wine['Year']) && $wine['Year'] == $i) echo 'selected="selected"'; ?>><?= $i ?></option>	
			<?php }?>
		</select>
	</td>
</tr>
<?php 
	$enum1 = getEnumValues('Wines','Colour');
	$enum2 = getEnumValues('Wines','SpecialType');
?>
<tr>
	<td class="left">
		Style:
	</td>
	<td class="right">
		<select name="Style">
			<?php 
			foreach ($enum2 as $e2) 
				foreach ($enum1 as $e1) 
				{ 
					if ($e1 == 'Rose' && $e2 == 'Icewine') 
						continue;?>
			<option value="<?= $e1 ?>-<?= $e2 ?>" <?php if(!empty($wine['Colour']) && $wine['Colour'] == $e1  && !empty($wine['SpecialType']) && $wine['SpecialType'] == $e2) echo 'selected="selected"'; ?>><?= $e1 . ($e2 == '' ? '' : ' ' . $e2 ) ?></option>
			<?php }?>
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
		<input type="checkbox" name="IsFeatured" value="Yes" id="##" class="check" <?= $checked ?>> Check this box to make this your 'Featured Wine'. It will appear first on your wine list as well as being used for <strong>future features</strong> on the website. Only one wine at a time may be featured.
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
		<input type="checkbox" name="IsActive" value="Yes" id="##" class="check" <?= $checked ?>> Check this to make your wine visible on the main site and the mobile site (once launched).
	</td>
</tr>