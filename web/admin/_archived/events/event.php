<div class="pretty_table_wrapper">


<?php

connect2database();


//	get banners
require_once 'function.filesAndDirectories.php';
$banners = listFilesIn(HomePathLocal . EventsBannerPath);

//	get list of tags
/*
$agroup = good_query_table("SELECT DISTINCT Tags FROM Attractions");
$attractions = array();
foreach ($agroup as $t) {
	$tarr = explode(',',$t['Tags']);
	foreach ($tarr as $t1) $attractions[] = $t1;
}
$attractions = array_unique($attractions); 
*/

$tags = good_query_table("SELECT * FROM Tags ORDER BY Tag ASC");

//	get regions
$regions = good_query_table("SELECT * FROM Regions WHERE Language = 'en'");

if (!sizeof($e)) {
?>
<form name="create_event" id="create_event" action="?action=create_event" method="post">
<?php
} else {
?>
<form name="edit_event" id="edit_event" action="?action=edit_event" method="post">
<?php
}
?>
<input type="hidden" name="event_id" value="<?= (int) $e['event_id'] ?>" />
<table class="pretty">
<tr>
	<td>Title</td>
	<td><input type="text" name="event_title" value="<?= $e['event_title'] ?>" /></td>
</tr>
<tr>
	<td>Banner:</td>
	<td>
	<select name="event_banner">
		<option value=""> - select banner - </option>
		<?php
		foreach ($banners as $b) {
		$extra_HTML = '';
		if ($b == $e['event_banner']) $extra_HTML = ' selected="selected"';
 		echo '<option value="'.$b.'"'.$extra_HTML.'>'.$b.'</option>';
		}
		?>
	</select>
	</td>
</tr>
<tr>
	<td>EventDate (YYYY:MM:DD)</td>
	<td><input type="text" name="event_date" id="EventDate" value="<?= $e['event_date'] ?>" /></td>
</tr>
<tr>
	<td>EventDate End (YYYY:MM:DD)</td>
	<td><input type="text" name="event_date_end" id="EventDateEnd" value="<?= $e['event_date_end'] ?>" /></td>
</tr>
<tr>
	<td>StartTime (24 hr -> HH:MM:SS)</td>
	<td><input type="text" name="event_time" id="StartTime" value=" <?= $e['event_time'] ?>" /></td>
</tr>
<tr>
	<td>EndTime (24 hr -> HH:MM:SS)</td>
	<td><input type="text" name="event_time_end" id="EndTime" value=" <?= $e['event_time_end'] ?>" /></td>
</tr>
<tr>
	<td>Description</td>
	<td><textarea name="event_desc" id="Description" cols="50" rows="5"><?= htmlspecialchars($e['event_desc']) ?></textarea><br /><a href="javascript:toggleEditor();" class="rtfhtml">[ RTF / HTML ]</a></td>
</tr>
<tr>
	<td>Free Tag</td>
	<td>
	<!--
	<select name="event_attraction_tags[]" multiple="multiple" size="<?= (int) sizeof($tags) ?>">
	-->
		<?php 
		$eagroup = explode(',',$e['event_attraction_tags']);
		foreach ($tags as $a) {
			$extra_HTML = '';
			foreach ($eagroup as $t) {
				//if ($t == $a['Tag']) $extra_HTML = ' selected="selected"';
				if ($t == $a['Tag']) $extra_HTML = ' checked="checked"';
			}
			//echo '<option value="'.$a['Tag'].'"'.$extra_HTML.'>'.$a['Tag'].'</option>';
			echo '<input type="checkbox" name="event_attraction_tags[]" value="'.$a['Tag'].'"'.$extra_HTML.' /> ' . $a['Tag'];
			echo '<br />';
		} ?>
	<!--	
	</select>
	-->
	</td>
</tr>
<tr>
	<td>Region</td>
	<td>
	<!--
	<select name="event_region_ids[]" multiple="multiple" size="<?= (int) sizeof($regions) ?>">
	-->
		<?php
		$ergroup = explode(',',$e['event_region_ids']);
		foreach ($regions as $r) {
			$extra_HTML = '';
			foreach ($ergroup as $er) {
				//if ($er == $r['RegionID']) $extra_HTML = ' selected="selected"';
				if ($er == $r['RegionID']) $extra_HTML = ' checked="checked"';
			}
			//echo '<option value="'.$r['RegionID'].'"'.$extra_HTML.'>'.$r['Name'].'</option>';
			echo '<input type="checkbox" name="event_region_ids[]" value="'.$r['RegionID'].'"'.$extra_HTML.' /> ' . $r['Name'];
			echo '<br />';
		}
		?>
	<!--	
	</select>
	-->
	</td>
</tr>
<tr>
	<td>Info Hours</td>
	<td><textarea name="info_hours" id="InfoHours" cols="50" rows="3"><?= htmlspecialchars($e['info_hours']) ?></textarea></td>
</tr>
<tr>
	<td>Info Location</td>
	<td><input type="text" name="info_location" id="InfoLocation" value="<?= $e['info_location'] ?>" /></td>
</tr>
<tr>
	<td>Info Phone</td>
	<td><input type="text" name="info_phone" id="InfoPhone" value="<?= $e['info_phone'] ?>" /></td>
</tr>
<tr>
	<td>Info Email</td>
	<td><input type="text" name="info_email" id="InfoEmail" value="<?= $e['info_email'] ?>" /></td>
</tr>
<tr>
	<td>Info Website</td>
	<td><input type="text" name="info_website" id="InfoWebsite" value="<?= $e['info_website'] ?>" /></td>
</tr>
<tr>
	<td>Info Price</td>
	<td><input type="text" name="info_price" id="infoPrice" value="<?= $e['info_price'] ?>" /></td>
</tr>

<tr>
	<td>Event is Active:</td>
	<?php
	if ($e['is_active']) {
		$extra_html = ' checked="checked"';
	} else {
		$extra_html = '';
	}
	?>
	<td><input type="checkbox" name="is_active" value="1"<?= $extra_html ?> /></td>
</tr>
<tr>
	<td>Event is Priority:</td>
	<?php
	if ($e['is_priority']) {
		$extra_html = ' checked="checked"';
	} else {
		$extra_html = '';
	}
	?>
	<td><input type="checkbox" name="is_priority" value="1"<?= $extra_html ?> /></td>
</tr>
<tr>
	<td colspan="2" align="right">
	<button type="reset">cancel</button>
	<?php if (!sizeof($e)) {
	?>
	<button type="submit">create event</button>
	<?php
	} else {
	?>
	<button type="submit">modify event</button>
	<?php
	}
	?>
	</td>
</tr>
</table>

</form>
</div>