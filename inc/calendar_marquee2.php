<?php
// get the next 14 days worth of events
connect2database();
require_once 'function.dateConversions.php';
$year			= localize('year');
$month			= localize('month');
$present_month 	= date('n');
$present_year	= date('Y');
if ($month == $present_month && $year == $present_year) {
	$go_day 	= date('j');
} else {
	$go_day 	= 1;
}
$start_date 	= makestamp($year,$month,$go_day);
$zbasedate		= $start_date;
$formatted_start_date = StampToMySQLDate($start_date);
/*
$next14_SQL 	= <<<BLOCK
	SELECT	event_id,event_title,info_location
	FROM	Events
	WHERE	event_date >= '$formatted_start_date'
	AND		is_active = 1
BLOCK;
$next14	= good_query_table(trim($next14_SQL));
*/
$counter = 0;
?>

<div id="boxHolder">
	<?php
	//	don't even bother getting events if the first event starts on the next month
	$there_is_an_event_this_month = (bool) good_query_value("SELECT event_date FROM Events WHERE event_month = $month LIMIT 1"); 
	
	if (!$there_is_an_event_this_month) {
		?>
		<div class="box topleft">&nbsp;</div>
		<div class="box top">&nbsp;</div>
		<div class="box top">&nbsp;</div>
		<div class="box top">&nbsp;</div>
		<div class="box top">&nbsp;</div>
		<div class="box top">&nbsp;</div>
		<div class="box topright">&nbsp;</div>
		<div class="box botleft">&nbsp;</div>
		<div class="box botleft">&nbsp;</div>
		<div class="box bot">&nbsp;</div>
		<div class="box bot">&nbsp;</div>
		<div class="box bot">&nbsp;</div>
		<div class="box bot">&nbsp;</div>
		<div class="box botright">&nbsp;</div>
		<?php
	} else {
	
		for ($i = 0; $i < 13; $i++) {

			$counter++;
			if 		($counter == 1)		$classname = 'topleft';
			else if ($counter == 7)		$classname = 'topright';
			else if ($counter == 8)		$classname = 'botleft';
			else if ($counter == 14)	$classname = 'botright';
			else if ($counter > 14)		$classname = 'bot';
			else						$classname = 'top';
			?>
			<div class="box <?= $classname ?>">
			<?php
			//	get the first day that there is 1+ event
			$thisStartDaySQL = <<<BLOCK
			SELECT	event_date FROM Events
			WHERE	event_date >= '$formatted_start_date'
			OR 		event_date_end >= '$formatted_start_date'
			ORDER BY event_date ASC
			LIMIT 1
BLOCK;
			$thisStartDay	= good_query_value(trim($thisStartDaySQL));
			
			if (!strlen($thisStartDay)) {
			echo '</div>';
			} else {
			
			//	if start date is too low, we will set it as the lowest possible value
			$zstart			= MySQLDateToStamp($thisStartDay);
			$zlow			= $zbasedate + (86400 * $i);
			if ($zstart < $zlow) {
				$start_date = $zlow;
				$thisStartDay = StampToMySQLDate($zlow);
			}
			
			if ($zstart == $old_start_date) {
				//echo 'fuckMe';
			}
			
			
			
			//	get all events that fall on that day
			$eventsThisDaySQL = <<<BLOCK
			SELECT * FROM Events
			WHERE (event_date = '$thisStartDay' AND (event_date_end IS NULL OR event_date_end = '0000-00-00' OR event_date_end = event_date))
			OR (event_date <= '$thisStartDay' AND event_date_end >= '$thisStartDay')
BLOCK;
			$eventsThisDay	= good_query_table(trim($eventsThisDaySQL));
				?>
					<h4><span class="eventdate"><?= date('j',MySQLDateToStamp($thisStartDay)) ?></span> <?= date('D',MySQLDateToStamp($thisStartDay)) ?></h4>
					<ul>
					<?php
					foreach ($eventsThisDay as $e) {
					?>
						<li><strong><?= $e['event_title'] ?></strong>, <?= $e['info_location'] ?></li>
					<?php
					}
					?>
						<li class="more"><a class="thickbox" href="pop_viewEvent.php?d=<?= date('j',MySQLDateToStamp($thisStartDay)) ?>&m=<?= date('n',MySQLDateToStamp($thisStartDay)) ?>&y=<?= date('Y',MySQLDateToStamp($thisStartDay)) ?>&TB_iframe=true&height=300&width=500">more &rarr;</a></li>
					</ul>
				</div>
				<?php
				if ($counter == 7) {
				echo '<div class="clearer"></div>';
				}
			//	now set $start_date for the next iteration
			$lastStartDay				= $thisStartDay;
			$old_start_date				= MySQLDateToStamp($thisStartDay);
			$start_date					= $old_start_date + 86400;
			$formatted_start_date		= timeStampToMySQLDate($start_date);
			
			}	// end if (!strlen($thisStartDay))			
		}
	}	//	end if (!$there_is_an_event_this_month)
	?>
<!-- </div> -->

<div class="clearer"></div>