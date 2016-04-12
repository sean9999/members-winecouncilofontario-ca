<h1>add a winery</h1>
<form name="new_winery" action="?action=create_winery" method="post">

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td>NAME:</td>
	<td><input type="text" name="Name" value="<?= $Name ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Number:</td>
	<td><input type="text" name="WineryNumber" value="<?= $WineryNumber ?>" class="full_width" /></td>
</tr>
<tr>
	<td>DESCRIPTION:</td>
	<td><textarea name="Description" class="full_width richText" rows="10"><?= stripslashes($Description) ?></textarea></td>
</tr>
<tr>
	<td>Region:</td>
	<td>
	<select name="RegionID">
	<?php
	$regions = good_query_table("SELECT RegionID,Name FROM Regions ORDER BY Name ASC");
	foreach ($regions as $r) {
	echo '<option value="'.$r['RegionID'].'">'.$r['Name'].'</option>';
	}
	?>
	</select>
	</td>
</tr>
<tr>
	<td>Street Address:</td>
	<td><input type="text" name="Address" value="<?= $Address ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Town:</td>
	<td><input type="text" name="Town" value="<?= $Town ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Postal Code:</td>
	<td><input type="text" name="Province" value="<?= $Province ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Google Map Link:</td>
	<td><input type="text" name="GeoLocation" value="<?= $GeoLocation ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Hours:</td>
	<td><textarea name="Hours" id="Hours" rows="3" class="full_width"><?= $Hours ?></textarea></td>
</tr>
<tr>
	<td>Tour Hours:</td>
	<td><textarea name="TourHours" id="TourHours" rows="3" class="full_width"><?= $TourHours ?></textarea></td>
</tr>
<tr>
	<td>Phone:</td>
	<td><input type="text" name="Phone" value="<?= $Phone ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Website:</td>
	<td><input type="text" name="Website" value="<?= $Website ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Wine Maker(s):</td>
	<td><input type="text" name="WineMakers" value="<?= $WineMakers ?>" class="full_width" /></td>
</tr>
<input type="hidden" name="FeaturedWineID" value="0" />
<?php /*
<tr>
	<td>Winemakers' choice:</td>
	<td>
	<select name="FeaturedWineID">
	<?php
	$wines = good_query_table("SELECT WineID,Name FROM Wines ORDER BY Name ASC");
	foreach ($wines as $wine) {
	echo '<option value="'.$wine['WineID'].'">'.$wine['Name'].'</option>';
	}
	?>
	</select>
	</td>
</tr>
*/ ?>
<tr>
	<td>Featured Wine:</td>
	<td><input type="text" name="WineMakersChoice" value="<?= $WineMakersChoice ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Best LCBO Brand:</td>
	<td><input type="text" name="BestLCBOBrand" value="<?= $BestLCBOBrand ?>" class="full_width" /></td>
</tr>

<tr>
	<td>Email:</td>
	<td><input type="text" name="Email" value="<?= $Email ?>" class="full_width" /></td>
</tr>


<tr>
	<td colspan="2" align="right">
	<input type="submit" name="save" value="Submit" />
	<input type="reset" name="reset" value="Reset" />
	</td>
</tr>
</table>
</div>
</form>