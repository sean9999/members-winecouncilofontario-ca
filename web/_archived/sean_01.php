<?php
require_once 'vars.php';

$page_title = 'Some example code';

include 'header.php';


connect2database();

$some_wineries = good_query_table("SELECT * FROM Wineries WHERE WineryID > 25 LIMIT 4");	//	3-dimensinal array

$awesome_winery = good_query_assoc("SELECT * FROM Wineries WHERE WineryID = 17");	// 2-dimensional array

$highest_winery_id = good_query_value("SELECT Max(WineryID) FROM Wineries");	// scalar value


//	you can dBug() anything and it simply spits out your array or object or scalar
new dBug($some_wineries);

new dBug($awesome_winery);

?>


<p>The highest WineryID (and therefore the latest) is <?= $highest_winery_id ?></p>


<p>Low let's loop through $some_wineries</p>
<ul>
<?php
	foreach ($some_wineries as $w) {
		echo '<li>The number of this winery is ' . $w['WineryNumber'] . ' and it\'s name is ' . $w['Name'] . '</li>';
	}
?>
</ul>


<?php include 'footer.php' ?>