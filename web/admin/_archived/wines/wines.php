<?php
connect2database();
$wines = good_query_table("SELECT * FROM Wines ORDER BY WineID ASC");

?>

<div class="pretty_table_wrapper">
	<h1>Wines</h1>
	<table class="pretty" cellpadding="0" cellspacing="0">
		<tr>
			<th>WineID</th>
			<th>WineryID</th>
			<th>Brand</th>
			<th>Name</th>
			<th>Year</th>
			<th>Style</th>
		    <th><!-- edit --></th>
		    <th><!-- delete --></th>
		</tr>
		<?php
		foreach ($wines as $w) 
		{
			echo '<tr>';
			echo '	<td><a href="?view=wine&WineID=' . $w['WineID'] . '">' . $w['WineID'] . '</a></td>';
			echo '	<td><a href="?view=wine&WineID=' . $w['WineID'] . '">' . $w['WineryID'] . '</a></td>';
			echo '	<td><a href="?view=wine&WineID=' . $w['WineID'] . '">' . $w['Brand'] . '</a></td>';
			echo '	<td><a href="?view=wine&WineID=' . $w['WineID'] . '">' . $w['Name'] . '</a></td>';
			echo '	<td><a href="?view=wine&WineID=' . $w['WineID'] . '">' . $w['Year'] . '</a></td>';
			echo '	<td><a href="?view=wine&WineID=' . $w['WineID'] . '">' . $w['Colour'] . ' ' . $w['SpecialType'] . '</a></td>';
			echo '	<td><a href="?view=wine&WineID=' . $w['WineID'] . '">edit</a></td>';
			echo '	<td><a href="javascript:deleteWine(\'' . $w['WineID'] . '\')">delete</a></td>';	
			echo '</tr>';
		}
		?>
	</table>
</div>