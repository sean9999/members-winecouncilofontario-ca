<?php
//$attractions = good_query_table("SELECT * FROM Attractions WHERE RegionID = $RegionID");
$attractions = good_query_table("SELECT DISTINCT Tags FROM Attractions WHERE RegionID = $RegionID");
?>
<h2>Attractions</h2>
