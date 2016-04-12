
<div class="everything">


	<div id="row1">


	<form name="pair" action="?action=create_pair" method="post">
	
		<div class="foods">
		<h3>Foods</h3>
		<?php
		include 'foods.php';
		?>
		<hr />
		<?php
		include 'add_food.php';
		?>
		</div>
	
		
		<div class="goeswith">
		<p>Goes With...</p>
		<img src="/admin/pairings/right_arrow_16.png" alt="goes with" />
		</div>
		
	
		<div class="wines">
		<h3>Wines</h3>
		<?php
		include 'wines.php';
		?>
		<hr />
		<?php
		include 'add_wine.php';
		?>
		</div>
		
		<div class="goeswith">
		<button>Create this Pairing:<br /><img src="/admin/pairings/right_arrow_16.png" alt="goes with" /></button>
		</div>
		
	</form>

	</div>

	<div id="row2">
	

		<div class="pairings">
		<?php
		include 'pairings.php';
		?>
		</div>

	
	</div>

</div>



	

<?php 
/*



<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<th>WFPID</th>
	<th>WineID</th>
	<th>FoodID</th>
	<th><!-- edit --></th>
	<th><!-- delete --></th>
</tr>
<?php
foreach ($Attractions as $w) {
	echo '<tr>';
	echo '	<td>'.$w['AttractionID'].'</td>';
	echo '	<td>'.$w['Tags'].'</td>';
	echo '	<td>'.good_query_value("SELECT Name FROM Regions WHERE RegionID = $w[RegionID]").'</td>';
	echo '	<td>'.$w['Title'].'</td>';
	echo '	<td><a href="?view=attraction&AttractionID=' . $w['AttractionID'] . '">edit</a></td>';
	echo '	<td><a href="javascript:deleteAttraction(\'' . $w['AttractionID'] . '\')">delete</a></td>';
	echo '</tr>';
}
?>
</table>
</div>
	
*/

?>