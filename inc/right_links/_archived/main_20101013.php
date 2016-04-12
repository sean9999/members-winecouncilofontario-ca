<?php
// create an accordian list of all available assets either global or specific to a Region
// as part of the /lib/extrander library
connect2database();
if (isset($_GET['RegionID'])) $RegionID = $_GET['RegionID']; else $RegionID = 0;
$downloads		= good_query_table("SELECT * FROM Downloads WHERE RegionID = $RegionID OR RegionID = 0");
$attractgroups	= good_query_table("SELECT DISTINCT Tags FROM Attractions WHERE RegionID = $RegionID OR RegionID = 0");
?>
<div class="extrander">
	<div class="extrand">
	<h2><a href="javascript:animatedcollapse.toggle('downloads')" onclick="toggle_visibility('downloads');">
	<?php
			if ($lang == 'fr') {
				echo 'T&eacute;l&eacute;chargements';
			} else {
				echo 'Downloads';
	} ?></a></h2>
	<div id="downloads">
	<ul>
		<li>These are currently pulling from the public side and won't display. FPO.</li>
		<?php
		$downloads = good_query_table("SELECT * FROM Downloads WHERE RegionID = $RegionID OR RegionID = 0");
		foreach ($downloads as $dd) {
		echo '<li>';
		echo '<a href="/content/downloads/' . $dd['FileName'] . '" class="download" target="externalwindow">';
		echo $dd['Title'];
		echo '</a></li>';
		}
		?>
	</ul>
	</div>
	</div>
	
	<div class="extrand">
	<h2><a href="javascript:animatedcollapse.toggle('upcoming_events')" onclick="toggle_visibility('upcoming_events');">
	<?php
			if ($lang == 'fr') {
				echo '&Agrave; venir';
			} else {
				echo 'Upcoming Events';
	} ?></a></h2>
	<?php
	require_once 'function.dateConversions.php';
	$today = StampToMySQLDate(time());
	$ue	= good_query_table("SELECT event_id,event_title,info_location,event_month,event_day,event_year,event_date,event_date_end FROM Events WHERE (event_date >= '$today' OR event_date_end >= '$today') AND is_active = 1 ORDER BY is_priority DESC, event_date ASC LIMIT 4");
	?>
	
	<div id="upcoming_events">
	<ul>
		<li>These are currently pulling from the public side and won't display. FPO.</li>
		<?php foreach ($ue as $e) {
		//	if the event spans several days
		if ($e['event_date_end'] > $e['event_date']) {
		$spantext	 = MySQLToPretty($e['event_date'],'F j');
		$spantext	.= ' &mdash; ';
		$spantext	.= MySQLToPretty($e['event_date_end'],'F j, Y');
		//	if it does not
		} else {
		$spantext	= MySQLToPretty($e['event_date'],'F j, Y');
		}
		$pretty_date = $spantext;
		?>
		<li><a href="event.php?event_id=<?= $e['event_id'] ?>" title="<?= $e['event_title'] ?>"><strong><?= $e['event_title'] ?></strong><br />
		<?= $pretty_date ?>, <?= $e['info_location'] ?></a></li>
		<?php
		}
		?>
		<li class="extrandRight"><a href="events.php">See All Events</a></li>

	</ul>
	</div>
	</div>

	<div class="extrand hide">
	<h2><a href="javascript:animatedcollapse.toggle('my_route')">Another Drop-Down</a></h2>
		<div id="my_route">
		<p>Here's another dropdown menu. It's going to be the coolest thing ever.</p>
		</div>
	</div>

</div>
