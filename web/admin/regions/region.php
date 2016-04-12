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
		<table class="pretty fixedWidth" cellpadding="0" cellspacing="0">
			<tr>
				<td class="leftCol">NAME (en):</td>
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
			<!--
			<tr>
				<td>LANGUAGE:</td>
				<td><input type="text" name="Language" value="<?= $Language ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>Google Maps Link:</td>
				<td><input type="text" name="GeoLocation" value="<?= $GeoLocation ?>" class="full_width" /></td>
			</tr>
			-->
			<tr>
				<td>Description (en):</td>
				<td><textarea name="Description" id="Description" class="full_width richText tinyMCE tinymce" cols="50" rows="10"><?= $Description ?></textarea>
					<p class="toggler"><a href="javascript:toggleEditor('Description','Description_fr','MobileContent');">[ RTF / HTML ]</a></p></td>
			</tr>
			<tr>
				<td>Description (fr):</td>
				<td><textarea name="Description_fr" id="Description_fr" class="full_width richText tinyMCE tinymce" cols="50" rows="10"><?= $Description_fr ?></textarea>
					<p class="toggler"><a href="javascript:toggleEditor('Description_fr');">[ RTF / HTML ]</a></p></td>
			</tr>
			<tr>
				<td>Description (Mobile):</td>
				<td><textarea name="MobileContent" id="MobileContent" class="full_width richText tinyMCE tinymce" cols="50" rows="10"><?= $MobileContent ?></textarea>
					<p class="toggler"><a href="javascript:toggleEditor('MobileContent');">[ RTF / HTML ]</a></p></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
				<button type="reset" class="clear">clear</button>
				<button type="submit">add it</button>
				</td>
			</tr>
		</table>
	</div>
</form>