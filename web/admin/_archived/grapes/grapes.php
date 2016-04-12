<?php
connect2database();
$grapes = good_query_table("SELECT * FROM Grapes ORDER BY GrapeID ASC");

?>

<div class="pretty_table_wrapper">
	<h1>Grapes</h1>
	<table class="pretty" cellpadding="0" cellspacing="0">
		<tr>
			<th>GrapeID</th>
			<th>Name</th>
			<th>Colour</th>
		    <th><!-- edit --></th>
		    <th><!-- delete --></th>
		</tr>
		<?php
		foreach ($grapes as $g) 
		{
			if($g['GrapeID'] == 0) continue;
			echo '<tr>';
			echo '	<td><a href="?view=grape&GrapeID=' . $g['GrapeID'] . '">' . $g['GrapeID'] . '</a></td>';
			echo '	<td><a href="?view=grape&GrapeID=' . $g['GrapeID'] . '">' . $g['Name'] . '</a></td>';
			echo '	<td><a href="?view=grape&GrapeID=' . $g['GrapeID'] . '">' . $g['Colour'] . '</a></td>';
			echo '	<td><a href="?view=grape&GrapeID=' . $g['GrapeID'] . '">edit</a></td>';
			echo '	<td><a href="javascript:deleteGrape(\'' . $g['GrapeID'] . '\')">delete</a></td>';	
			echo '</tr>';
		}
		?>
	</table>
</div>