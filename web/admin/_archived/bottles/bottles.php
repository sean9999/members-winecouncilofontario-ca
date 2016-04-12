<?php
connect2database();
$bottles = good_query_table("SELECT b.WineID as WineID, b.*, w.* FROM Bottles as b LEFT JOIN Wines as w ON b.WineID = w.WineID ORDER BY Brand ASC, Name ASC");

?>

<div class="pretty_table_wrapper">
	<h1>Bottles</h1>
	<table class="pretty" cellpadding="0" cellspacing="0">
		<tr>
			<th>BottleID</th>
			<th>Winery</th>
			<th>Wine</th>
			<th>Volume</th>
			<th>Price</th>
			<th><!-- edit --></th>
		    <th><!-- delete --></th>
		</tr>
		<?php
		foreach ($bottles as $b) 
		{
			$winery = good_query_value("SELECT Name from Wineries WHERE WineryID = " . $b['WineryID']);
		
			echo '<tr>';
			echo '	<td><a href="?view=bottle&BottleID=' . $b['BottleID'] . '">' . $b['BottleID'] . '</a></td>';
			echo '	<td><a href="?view=bottle&BottleID=' . $b['BottleID'] . '">' . $winery . '</a></td>';
			echo '	<td><a href="?view=bottle&BottleID=' . $b['BottleID'] . '">' . $b['Brand'] . ' - ' . $b['Name'] . '</a></td>';
			echo '	<td><a href="?view=bottle&BottleID=' . $b['BottleID'] . '">' . $b['Volume'] . ' mL' .  '</a></td>';
			echo '	<td><a href="?view=bottle&BottleID=' . $b['BottleID'] . '">' . "$" . $b['Price'] . '</a></td>';
			echo '	<td><a href="?view=bottle&BottleID=' . $b['BottleID'] . '">edit</a></td>';
			echo '	<td><a href="javascript:deleteBottle(\'' . $b['BottleID'] . '\')">delete</a></td>';	
			echo '</tr>';
		}
		?>
	</table>
</div>