<div class="pretty_table_wrapper">

<?php
connect2database();

require_once 'function.dateConversions.php';
$yesterday_sql = timeStampToMySQLDate(time()+-(60*60*24));

$events_pending = good_query_table("SELECT * FROM Events WHERE is_active = 0 ORDER BY event_date ASC");
$events_active	= good_query_table("SELECT * FROM Events WHERE is_active = 1 AND event_date_end >= '$yesterday_sql' ORDER BY event_date ASC");
//new dBug($events);
?>

<p>$yesterday_sql = <?= $yesterday_sql ?></p>

<?php if (sizeof($events_pending)) {
?>	
	<h1><br />Pending events</h1>
	<table class="pretty">
	<tr>
		<th>Title</th>
		<th>Date</th>
		<th>Location</th>
		<td><!--	edit	--></td>
		<td><!--	delete	--></td>
	</tr>
	<?php
	foreach($events_pending as $e) {
	?>
	<tr>
		<td><?= $e['event_title'] ?></td>
		<td><?= $e['event_date'] ?></td>
		<td><?= $e['info_location'] ?></td>
		<td><button name="edit" type="button" onclick="editEvent(<?= $e['event_id'] ?>)">edit</button></td>
		<td><button name="delete" type="button" onclick="deleteEvent(<?= $e['event_id'] ?>)">delete</button></td>
	</tr>
	<?php
	}
}
?>
</table>
<hr />

<?php if (sizeof($events_active)) {
?>
	<h1><br />Active events</h1>
	<table class="pretty">
	<tr>
		<th>Title</th>
		<th>Date</th>
		<th>Location</th>
		<td><!--	edit	--></td>
		<td><!--	delete	--></td>
	</tr>
	<?php
	foreach($events_active as $e) {
	?>
	<tr>
		<td><?= $e['event_title'] ?></td>
		<td><?= $e['event_date'] ?></td>
		<td><?= $e['info_location'] ?></td>
		<td><button name="edit" type="button" onclick="editEvent(<?= $e['event_id'] ?>)">edit</button></td>
		<td><button name="delete" type="button" onclick="deleteEvent(<?= $e['event_id'] ?>)">delete</button></td>
	</tr>
	<?php
	}
}
?>

</table>

</div>