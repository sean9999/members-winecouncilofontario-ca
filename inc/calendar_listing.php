<?php
//	assumes either {$month and $year} or $event_id are already set.
require_once 'function.dateConversions.php';
$yesterday_sql = timeStampToMySQLDate(time()+-(60*60*24));

$daysinmonth	= date('t',mktime(0,0,0,$month,1,$year));

if ($month == date('n',time()) && $year == date('Y',time())) {
	$yesterday_day = date('j',time()) +- 1;
	$start_day_of_month = $yesterday_day;
} else {
	$start_day_of_month = 1;
}


for ($i = $start_day_of_month;$i <= $daysinmonth;$i++) {
	$this_z	= mktime(0,0,0,$month,$i,$year);
	$this_formatted_date = StampToMySQL($this_z);
	
	
	if ($RegionID) {
	$eSQL	= <<<BLOCK
	SELECT	* FROM Events
	WHERE	event_year 	=  $year
	AND		event_month	=  $month
	AND		is_active	= 1
	AND		((event_date	<= '$this_formatted_date' AND event_date_end >= '$this_formatted_date')
	OR		(event_date	= '$this_formatted_date'))
	AND 	event_region_ids LIKE '%$RegionID%'
BLOCK;
	} else {
	$eSQL	= <<<BLOCK
	SELECT	* FROM Events
	WHERE	event_year 	=  $year
	AND		event_month	=  $month
	AND		is_active	= 1
	AND		((event_date	<= '$this_formatted_date' AND event_date_end >= '$this_formatted_date')
	OR		(event_date	= '$this_formatted_date'))
BLOCK;
	}
	
	
	$eventsthisday = good_query_table(trim($eSQL));
	if (sizeof($eventsthisday)) {
	?>
	<div class="event">
		<h3><span class="eventdate"><?= $i ?></span> <?= date('F, Y',$this_z) ?><!-- July, 2009 --></h3>
		<ul>
			<?php foreach ($eventsthisday as $e) {
			echo '<li><a href="event.php?event_id='.$e['event_id'].'"><strong>'.$e['event_title'].'</strong>, '.$e['info_location'].'</a>';
			//echo ' - ' . $e['event_date'] . '->' . $e['event_date_end'];
			echo '</li>';
			}
			?>
		</ul>
	</div>
	<?php
	}
}
?>