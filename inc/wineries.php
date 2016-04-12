<?php
$wineries = good_query_table("SELECT Name,WineryID FROM Wineries WHERE RegionID = $RegionID");
?>
<ul>
	<?php
	foreach ($wineries as $w) {
	echo '<li><a href="pop_winery.php?WineryID=';
	echo $w['WineryID'];
	echo '&keepThis=true&TB_iframe=true&height=520&width=680"';
	echo ' title="'.$w['Name'].'" class="thickbox">';
	echo $w['Name'];
	echo '</a></li>';
	}
	?>
</ul>
