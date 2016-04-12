<?php
connect2database();
require_once 'function.characterConversions.php';
require_once 'function.readChunks.php';

$RegionID = localize('RegionID');

$t = good_query_assoc("SELECT * FROM Regions WHERE RegionID = $RegionID");
extract($t);
?>

<div class="breadcrumb"><a href="index.php"><? $section ?></a> &raquo; <?= $Name ?></div>

<form method="post" action="?action=update_region">
<input type="hidden" name="RegionID" value="<?= $RegionID ?>" />

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td>NAME (en):</td>
	<td><input type="text" name="Name" value="<?= $Name ?>" class="full_width" /></td>
</tr>
<tr>
	<td>NAME (fr):</td>
	<td><input type="text" name="Name_fr" value="<?= $Name_fr ?>" class="full_width" /></td>
</tr>
<tr>
	<td>SEO Name:</td>
	<td><input type="text" name="SEOName" value="<?= strlen($SEOName) ? $SEOName : convertFromTitleToPath($Name) ?>" class="full_width" /></td>
</tr>
<tr>
	<td>LANGUAGE:</td>
	<td><input type="text" name="Language" value="<?= $Language ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Google Maps Link:</td>
	<td><input type="text" name="GeoLocation" value="<?= $GeoLocation ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Description (en):</td>
	<td><textarea name="Description" id="Description" class="richText" cols="50" rows="10"><?= $Description ?></textarea></td>
</tr>
<tr>
	<td>Description (fr):</td>
	<td><textarea name="Description_fr" id="Description_fr" class="richText" cols="50" rows="10"><?= $Description_fr ?></textarea></td>
</tr>
<tr>
	<td colspan="2" align="right">
	<input type="submit" name="save" value="Submit" />
	<input type="reset" name="reset" value="Reset" />
	<a href="javascript:toggleEditor('Description');">[ RTF / HTML ]</a>
	</td>
</tr>
</table>
</div>
</form>
</div>


