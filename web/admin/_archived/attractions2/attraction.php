<?php
 

connect2database();
include 'function.characterConversions.php';
$w = good_query_assoc('SELECT * FROM Attractions WHERE AttractionID = ' . $_GET['AttractionID']); 
extract($w);

$currentTag = good_query_assoc("SELECT * FROM Attractions WHERE AttractionID = $AttractionID"); 

?>

<div class="breadcrumb"><a href="index.php"><? $section ?></a> &raquo; <?= $Tags ?></div>

<form method="post" action="?action=update_attraction">
<input type="hidden" name="AttractionID" value="<?= $AttractionID ?>" />

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td>Choose Category</td>
	<td>
	<select name="Tags1">
		<option value=""> -- choose a category -- </option>
		<?php
		$cats = good_query_table("SELECT DISTINCT Tags FROM Attractions");
		foreach ($cats as $c) {
		if ($Tags == $c['Tags'])	$extra_HTML = ' selected="selected"';
		else										$extra_HTML = '';
		echo '<option value="'.$c['Tags'].'" '.$extra_HTML.'>'.$c['Tags'].'</option>';
		}
		?>
	</select>
	</td>
</tr>
<tr>
	<td>Or Type a New Category:</td>
	<td><input type="text" name="Tags2" value="<?= $Tags ?>" class="full_width" /></td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td>Choose Mobile Category</td>
	<td>
	<select name="MobileTags">
		<option value=""> -- choose a category -- </option>
		<?php
		$catsMobile = good_query_table("SELECT DISTINCT MobileTags FROM Attractions");
		foreach ($catsMobile as $c2) {
		if ($currentTag['MobileTags'] == $c2['MobileTags'])	$extra_HTML = ' selected="selected"';
		else										$extra_HTML = '';
		echo '<option value="'.$c2['MobileTags'].'" '.$extra_HTML.'>'.$c2['MobileTags'].'</option>';
		}
		?>
	</select>
	</td>
</tr>
<tr>
	<td>Title:</td>
	<td><input type="text" name="Title" value="<?= $Title ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Content:</td>
	<td><textarea name="Content" class="richText" rows="10" cols="50" id="Content"><?= super_clean($Content) ?></textarea></td>
</tr>
<tr>
	<td>Region:</td>
	<td>
	<select name="RegionID">
	<option value="0"> -- chose region -- </option>
	<?php
	$regions = good_query_table("SELECT Name,RegionID FROM Regions");
	foreach ($regions as $region) {
		if ($region['RegionID'] == $w['RegionID'])	$extra_HTML = ' selected="selected"';
		else										$extra_HTML = '';
		echo '<option value="'.$region['RegionID'].'"'.$extra_HTML.'>'.$region['Name'].'</option>';
	}
	?>
	</select>
	</td>
</tr>
<tr>
	<td colspan="2" align="right">
	<input type="submit" name="save" value="Submit" />
	<input type="reset" name="reset" value="Reset" />
	<a href="javascript:toggleEditor('Content');">[ RTF / HTML ]</a>
	</td>
</tr>
</table>
</div>
</form>
</div>


