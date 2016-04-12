<?php
connect2database();
require_once 'function.characterConversions.php';
$w = good_query_assoc('SELECT * FROM Wineries WHERE WineryID = ' . $_GET['WineryID']); 
extract($w);
?>

<div class="pretty_table_wrapper">

<div class="breadcrumb"><a href="index.php"><?= $section ?></a> &raquo; <?= $Name ?></div>

<form method="post" action="?action=update_winery">
<input type="hidden" name="WineryID" value="<?= $WineryID ?>" />

<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td>Number:</td>
	<td><input type="text" name="WineryNumber" value="<?= $WineryNumber ?>" class="full_width" /></td>
</tr>
<tr>
	<td>NAME:</td>
	<td><input type="text" name="Name" value="<?= $Name ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Region:</td>
	<td>
	<select name="RegionID">
	<?php
	$regions = good_query_table("SELECT RegionID,Name FROM Regions ORDER BY Name ASC");
	foreach ($regions as $r) {
	if ($w['RegionID'] == $r['RegionID'])	$extra_HTML = ' selected="selected"';
	else									$extra_HTML = '';
	echo '<option value="'.$r['RegionID'].'"'.$extra_HTML.'>'.$r['Name'].'</option>';
	}
	?>
	</select>
	</td>
</tr>
<tr>
	<td>DESCRIPTION:</td>
	<td><textarea name="Description" class="full_width richText" rows="10"><?= stripslashes($Description) ?></textarea></td>
</tr>

<?php
require_once 'function.filesAndDirectories.php';
require_once 'function.characterConversions.php';
$legalImgFolder	= LegalizeText(good_query_value("SELECT Name FROM Regions WHERE RegionID = $RegionID"));
$path2Images	= HomePathLocal.WineryImagesPath.$legalImgFolder;
$imgz			= listFilesIn($path2Images);

?>
<tr>
	<td>Small Image</td>
	<td>
	<!--
	/<?= WineryImagesPath . '/' . $legalImgFolder .'/' ?>
	-->
	<select name="SmallImage1">
	<option value=""> -- no image -- </option>
	<?php
	foreach ($imgz as $i) {
		$extra_HTML = '';
		if ($i == $SmallImage1) $extra_HTML = ' selected="selected"';
		echo '<option value="'.$i.'"'.$extra_HTML.'>'.$i.'</option>';
	}
	?>
	</select>
	</td>
</tr>
<!--
<tr>
	<td>Small Image 2:</td>
	<td>
	<select name="SmallImage2">
	<option value=""> -- no image -- </option>
	<?php
	foreach ($imgz as $i) {
		$extra_HTML = '';
		if ($i == $SmallImage2) $extra_HTML = ' selected="selected"';
		echo '<option value="'.$i.'"'.$extra_HTML.'>'.$i.'</option>';
	}
	?>
	</select>
	</td>
</tr>
-->
<tr>
	<td>Wine Maker(s):</td>
	<td><input type="text" name="WineMakers" value="<?= $WineMakers ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Wine Maker's Choice:</td>
	<td><input type="text" name="WineMakersChoice" value="<?= $WineMakersChoice ?>" class="full_width" /></td>
</tr>
<tr>
<input type="hidden" name="FeaturedWineID" value="0" />

<tr>
	<td>Best LCBO Brand:</td>
	<td><input type="text" name="BestLCBOBrand" value="<?= $BestLCBOBrand ?>" class="full_width" /></td>
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
	<td>Phone:</td>
	<td><input type="text" name="Phone" value="<?= $Phone ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Email:</td>
	<td><input type="text" name="Email" value="<?= $Email ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Website:</td>
	<td><input type="text" name="Website" value="<?= $Website ?>" class="full_width" /></td>
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
	<td>Is Member:</td>
	<?php
	$extra_HTML = '';
	if($IsMember) $extra_HTML = ' checked="checked"';
	?>
	<td><input type="checkbox" name="IsMember" value="1" id="IsMember"<?= $extra_HTML ?> /></td>
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
</div>


