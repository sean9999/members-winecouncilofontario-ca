<?php
connect2database();
//$things = good_query_table("SELECT * FROM Ads ORDER BY StartDate ASC");
?>

<div class="pretty_table_wrapper">
	<h1>Test</h1>
	<table class="pretty chunktable" cellpadding="0" cellspacing="0">
		<tr>
			<th>ID</th>
			<th colspan="3">Name</th>			
		</tr>
		
		<?php
		
		$things = good_query_table("SELECT * FROM TestTable");
		foreach ($things as $thing) 
		{
			echo '<tr>';
			echo '<td>'.$thing['testID'].'</td>';			
			echo '<td class="info"><a href="?view=ad&testID=' . $thing['testID'] . '">';
			echo '<strong>'.$thing['Name'].'</strong><br />';
			echo $thing['Description'].'<br />';
			echo '<hr />';
			echo '<em>User Levels</em>';
			echo '<ul>';
				$array = explode(",",$thing['UserLevels']);
				foreach ($array as $a) {
					echo '<li>'. $a .'</li>';
				}
			echo '</ul>';

			echo '</a></td>';
			echo '<td class="dedit"><a href="?view=ad&testID=' . $thing['testID'] . '" class="edit">edit</a></td>';
			echo '<td class="dedit"><a href="javascript:deleteThing(\'' . $thing['testID'] . '\')" class="delete">delete</a></td>';	
			echo '</tr>';
		}
		?>



	</table>
	
</div>