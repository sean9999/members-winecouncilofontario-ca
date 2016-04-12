<div id="winerylist">
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
				<li><a href="http://winecountryontario.ca/<?= $r['SEOName'] ?>/<?= $w['SEOName'] ?>" title="<?= $w['Name'] ?>" target="_blank"><?= $w['Name'] ?></a></li>
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