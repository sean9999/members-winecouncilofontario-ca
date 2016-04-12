<?php
connect2database();
$le_sql = "show fields from Wines";
//$le_sql = "SHOW CREATE TABLE Wines";
$x = good_query($le_sql);
new dBug($x);
?>