<?php

require_once 'vars.php';

enable_chunks();

$chunks = good_query_table("SELECT * FROM Chunks WHERE ProjectID = 2");

$projects = good_query_table("SELECT * FROM Projects");

new dBug($chunks);

new dBug($projects);

?>