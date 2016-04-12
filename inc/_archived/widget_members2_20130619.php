<div id="winerylist">
	<h2>Here's a list of all the members in the database</h2>
	<div id="wineries">
	<?php
		connect2database ();
		$regions = good_query_table("SELECT * FROM Regions ORDER BY SortOrder" );
	
	
		foreach ($regions as $r) {
	?>
		<h2>Wineries of <?= $r['Name'] ?></h2>
		<?php
			$wineries = good_query_table("SELECT * FROM Wineries WHERE RegionID = $r[RegionID] AND IsMember > 0 ORDER BY Name" );
		?>
		<ul>
			<?php
			foreach ($wineries as $w) {
				?>
				<li><a href="/pop_winery.php?WineryID=<?= $w['WineryID'] ?>" title="<?= $w['Name'] ?>" class="colorbox"><?= $w['Name'] ?></a></li>
				<?php
				}
			?>
		</ul>
		<div class="clearer"></div>
		<?php	
		}
	?>
	</div>
</div>