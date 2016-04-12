<h1>Stay, Dine, Play</h1>

<div id="winerylist">

<?php
connect2database();
$tags = good_query_verticallist("SELECT DISTINCT Tags FROM Attractions");
foreach ($tags as $tag) {
	$attractions = good_query_table("SELECT * FROM Attractions WHERE Tags = '$tag'")	
	?>

	<div id="wineries">
	<h2><?= $tag ?></h2>
		<ul>
			<?php foreach($attractions as $attraction) { ?>
			<li><a href="pop_attraction.php?AttractionID=<?= $attraction['AttractionID'] ?>&RegionID=<?= $attraction['RegionID'] ?>&Tags=<?= $tag ?>" class="thickbox"><?= $attraction['Title'] ?></a></li>
			<?php } ?>
		</ul>
		<div class="clearer"></div>
	</div>
	
	<?php } ?>

</div>