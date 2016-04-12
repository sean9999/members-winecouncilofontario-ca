<?php
$downloads = good_query_table("SELECT * FROM Downloads");
?>
<h2>Downloads</h2>
<ul>
	<?php
	foreach ($downloads as $d) {
	echo '<li><a href="'.DownloadsPath.$d['FileName'].'" target="downloads">' . $d['Title'] . '</a></li>';
	}
	?>
</ul>