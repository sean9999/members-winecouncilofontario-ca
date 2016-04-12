<?php
connect2database();
$regions = good_query_table("SELECT RegionID,Name FROM Regions");
?>
<ul>
	<?php	// regions
	foreach ($regions as $r) { 
	if ($r['RegionID'] == $_GET['RegionID']) {
	?>
	<li><strong><a href="region.php?regionID=<?= $r['RegionID'] ?>" id="<?= $r['RegionID'] ?>"><?= $r['Name'] ?></a></strong></li>
	<?php
		} else {
	?>
	<li><a href="region.php?regionID=<?= $r['RegionID'] ?>" id="<?= $r['RegionID'] ?>"><?= $r['Name'] ?></a></li>
	<?php
		}
	}
	// non-region pages
	if ($page_id == 'about') {
	?>
	<li><strong><a href="about.php">About Us</a></strong></li>
	<?php
	} else {
	?>
	<li><a href="about.php">About Us</a></li>
	<?php
	}
	?>
	
</ul>