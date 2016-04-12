<?php
connect2database();
//$things = good_query_table("SELECT * FROM Ads ORDER BY StartDate ASC");
?>

<div class="pretty_table_wrapper">
	<h1>Trade Ads</h1>
	<p class="instructions">Here are the Trade Ads that are in the system.<br /><br /></p>
	<table class="pretty chunktable" cellpadding="0" cellspacing="0">
		<tr>
			<th>Image</th>
			<th colspan="3">Name</th>			
		</tr>
		
		<?php
		
		$now = time();

		// FUTURE ADS
		$things = good_query_table("SELECT * FROM Ads WHERE StartDate > $now");
		echo '<tr><td colspan="4"><h2>Upcoming Ads</h2></td></tr>';
		foreach ($things as $thing) 
		{
			if($thing['AdID'] == 0) continue;
			if ($thing['IsActive'] == 0) { 
				$extra_html = ' inactive'; 
			} else { $extra_html = ''; 
			}
			echo '<tr>';
			echo '<td class="adImg"><a href="?view=ad&AdID=' . $thing['AdID'] . '"><img src="' . $thing['Image'] . '" alt="'.$thing['Name'].'" width="60" height="101" /></a></td>';			
			echo '<td class="info'. $extra_html .'"><a href="?view=ad&AdID=' . $thing['AdID'] . '">';
			echo '<strong>'.$thing['Name'].'</strong><br />';
			echo 'Start Date: '.date("l F d, Y", $thing['StartDate']).'<br />';
			echo 'End Date: '.date("l F d, Y", $thing['EndDate']).'<br />';
				if ($thing['IsActive'] == 0) {
					echo '<br />This Ad is not active';
				}
				if (!empty($thing['Notes'])) {
					echo '<div class="notes">';
					echo 'NOTES: <em>';
					echo $thing['Notes'];
					echo '</em>';
					echo '</div>';
				}
			echo '</a></td>';
			echo '<td class="dedit"><a href="?view=ad&AdID=' . $thing['AdID'] . '" class="edit">edit</a></td>';
			echo '<td class="dedit"><a href="javascript:deleteThing(\'' . $thing['AdID'] . '\')" class="delete">delete</a></td>';	
			echo '</tr>';
		}


		// CURRENT ADS
		$things = good_query_table("SELECT * FROM Ads WHERE StartDate < $now AND EndDate > $now ORDER BY AdID DESC");
		echo '<tr><td colspan="4"><h2>Currently Running Ads</h2></td></tr>';
		foreach ($things as $thing) 
		{
			if($thing['AdID'] == 0) continue;
			if ($thing['IsActive'] == 0) { 
				$extra_html = ' inactive'; 
			} else { $extra_html = ''; 
			}
			echo '<tr>';
			echo '<td><a href="?view=ad&AdID=' . $thing['AdID'] . '"><img src="' . $thing['Image'] . '" alt="'.$thing['Name'].'" width="60" height="101" /></a></td>';			
			echo '<td class="info'. $extra_html .'"><a href="?view=ad&AdID=' . $thing['AdID'] . '">';
			echo '<strong>'.$thing['Name'].'</strong><br />';
			echo 'Start Date: '.date("l F d, Y", $thing['StartDate']).'<br />';
			echo 'End Date: '.date("l F d, Y", $thing['EndDate']).'<br />';
				if ($thing['IsActive'] == 0) {
					echo '<br />This Ad is not active';
				}
				if (!empty($thing['Notes'])) {
					echo '<div class="notes">';
					echo 'NOTES: <em>';
					echo $thing['Notes'];
					echo '</em>';
					echo '</div>';
				}
			echo '</a></td>';
			echo '<td class="dedit"><a href="?view=ad&AdID=' . $thing['AdID'] . '" class="edit">edit</a></td>';
			echo '<td class="dedit"><a href="javascript:deleteThing(\'' . $thing['AdID'] . '\')" class="delete">delete</a></td>';	
			echo '</tr>';
		}


		// PAST ADS
		$things = good_query_table("SELECT * FROM Ads WHERE EndDate < $now");
		echo '<tr><td colspan="4"><h2>Expired Ads</h2></td></tr>';
		foreach ($things as $thing) 
		{
			if($thing['AdID'] == 0) continue;
			if ($thing['IsActive'] == 0) { 
				$extra_html = ' inactive'; 
			} else { $extra_html = ''; 
			}
			echo '<tr>';
			echo '<td><a href="?view=ad&AdID=' . $thing['AdID'] . '"><img src="' . $thing['Image'] . '" alt="'.$thing['Name'].'" width="60" height="101" /></a></td>';			
			echo '<td class="info'. $extra_html .'"><a href="?view=ad&AdID=' . $thing['AdID'] . '">';
			echo '<strong>'.$thing['Name'].'</strong><br />';
			echo 'Start Date: '.date("l F d, Y", $thing['StartDate']).'<br />';
			echo 'End Date: '.date("l F d, Y", $thing['EndDate']).'<br />';
				if ($thing['IsActive'] == 0) {
					echo '<br />This Ad is not active';
				}
				if (!empty($thing['Notes'])) {
					echo '<div class="notes">';
					echo 'NOTES: <em>';
					echo $thing['Notes'];
					echo '</em>';
					echo '</div>';
				}
			echo '</a></td>';
			echo '<td class="dedit"><a href="?view=ad&AdID=' . $thing['AdID'] . '" class="edit">edit</a></td>';
			echo '<td class="dedit"><a href="javascript:deleteThing(\'' . $thing['AdID'] . '\')" class="delete">delete</a></td>';	
			echo '</tr>';
		}
		?>



	</table>
</div>