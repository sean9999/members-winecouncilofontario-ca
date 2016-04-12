<?php
connect2database();
$le_sql = "show fields from Wineries";
//$le_sql = "SHOW CREATE TABLE Wineries";
$x = good_query($le_sql);
new dBug($x);
?>