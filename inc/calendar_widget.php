<?

/*
IF(!isset($_GET['year'])){
    $_GET['year'] = date("Y");
}
IF(!isset($_GET['month'])){
    $_GET['month'] = date("n");
}

$month = addslashes($_GET['month']);
$year = addslashes($_GET['year']);
*/

$_GET['year']	= localize('year');
$_GET['month']	= localize('month');


connect2database();
$db_table = "Events";

if ($RegionID) {
	$les_events = good_query_table("SELECT * FROM $db_table WHERE event_month='$month' AND event_year='$year' AND is_active = 1 AND event_region_ids LIKE '%$RegionID%' ORDER BY event_time");
} else {
	$les_events = good_query_table("SELECT * FROM $db_table WHERE event_month='$month' AND event_year='$year' AND is_active = 1 ORDER BY event_time");
}


//while ($info = mysql_fetch_array($query_result))
foreach ($les_events as $info)
{
	// populate more shit because of date spans
	if ($info['event_date_end'] != '0000-00-00') {
		$ymd		= explode('-',$info['event_date_end']);
		$last_day	= $ymd[2];
		$first_day	= $info['event_day'];
		for ($i = $first_day;$i <= $last_day;$i++) {
			$events[$i][]		= $info['event_id'];
		}
	}
    $day						= $info['event_day'];
    $event_id					= $info['event_id'];
    $events[$day][]				= $info['event_id'];
    $event_info[$event_id]['0'] = substr($info['event_title'], 0, 8);
    $event_info[$event_id]['1'] = $info['event_time'];
}


$todays_date = date("j");
$todays_month = date("n");

$days_in_month = date ("t", mktime(0,0,0,$_GET['month']+1,0,$_GET['year']));
$first_day_of_month = date ("w", mktime(0,0,0,$_GET['month'],1,$_GET['year']));
$first_day_of_month = $first_day_of_month + 1;
$count_boxes = 0;
$days_so_far = 0;

IF($_GET['month'] == 13){
    $next_month = 2;
    $next_year = $_GET['year'] + 1;
} ELSE {
    $next_month = $_GET['month'] + 1;
    $next_year = $_GET['year'];
}

IF($_GET['month'] == 2){
    $prev_month = 13;
    $prev_year = $_GET['year'] - 1;
} ELSE {
    $prev_month = $_GET['month'] - 1;
    $prev_year = $_GET['year'];
}

?>

<div class="calendar">
	<!--	nav		-->
	<table class="nav" id="head">
	<tr>
		<td id="previousmonth" align="left"><a href="events.php?month=<?= $prev_month ?>&amp;year=<?= $prev_year ?>"><img src="/assets/calendar_left_arrow.png" alt="previous month" /></a></td>
		<td id="currentdate" align="center"><h3><? echo date ("F Y", mktime(0,0,0,$_GET['month'],1,$_GET['year'])); ?></h3></td>
		<td id="nextmonth" align="right"><a href="events.php?month=<?= $next_month ?>&amp;year=<?= $next_year ?>"><img src="/assets/calendar_right_arrow.png" alt="next month" /></a></td>
	</tr>
	</table>
	<table class="nav" id="daysofweek">
	<tr class="topdays"> 
		<td class="topday"><a title="Sunday">S</a></td>
		<td class="topday"><a title="Monday">M</a></td>
		<td class="topday"><a title="Tuesday">T</a></td>
		<td class="topday"><a title="Wednesday">W</a></td>
		<td class="topday"><a title="Thursday">T</a></td>
		<td class="topday"><a title="Friday">F</a></td>
		<td class="topday"><a title="Saturday">S</a></td>
	</tr>
	</table>
	<!--	cal		-->
	<table class="cal">
	<tr> 
		<?
		for ($i = 1; $i <= $first_day_of_month-1; $i++) {
			$days_so_far = $days_so_far + 1;
			$count_boxes = $count_boxes + 1;
			echo "<td class=\"day non-day\"></td>\n";
		}
		for ($i = 1; $i <= $days_in_month; $i++) {
				$days_so_far = $days_so_far + 1;
				$count_boxes = $count_boxes + 1;
			IF($_GET['month'] == $todays_month){
				IF($i == $todays_date){
					$class = "today";
				} ELSE {
					$class = "dayboxes";
				}
			} ELSE {
				$class = "dayboxes";
			}
			
			
			if (isset($events[$i])) {
				$class = 'has-event';
				echo "<td class=\"day $class\">\n";
				//echo "<a href=\"javascript:popCalendarDay($i,$month,$year)\">";
				//echo '<a href="pop_viewEvent.php?d='.$i.'&m='.$month.'&y='.$year.'&keepThis=true&TB_iframe=true&height=300&width=500" title="events this day" class="thickbox">';
				echo '<a href="event?d='.$i.'&m='.$month.'&y='.$year.'" title="events this day">';
				echo $i;
				echo '</a>';
				echo '</td>';
			} else {
				echo "<td class=\"day $class\">\n";
				echo $i;
				echo '</td>';
			}
			
			$link_month = $_GET['month'] - 1;
			
			IF(($count_boxes == 7) AND ($days_so_far != (($first_day_of_month-1) + $days_in_month))){
				$count_boxes = 0;
				echo "</TR><TR valign=\"top\">\n";
			}
		}
		$extra_boxes = 7 - $count_boxes;
		for ($i = 1; $i <= $extra_boxes; $i++) {
			echo "<td class=\"day non-day\"></td>\n";
		}
		
		?>
	</tr>
	</table>
	<!--	end cal	-->
</div>


