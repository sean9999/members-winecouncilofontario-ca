<?php
require_once 	'vars.php';
$section_title	= 'Members';
$section_id		= 'Members';
$page_title		= 'Members';
$page_id		= 'Members';

connect2database ();
$regions = good_query_table("SELECT * FROM Regions ORDER BY SortOrder" );
//$wineries = good_query_table("SELECT * FROM Wineries WHERE RegionID = $r[RegionID] AND IsMember > 0 ORDER BY Name" );
$wineries = good_query_table("SELECT * FROM Wineries WHERE IsMember > 0 AND WineryID != 302 AND WineryID != 300 ORDER BY Name" );

$self = (basename($_SERVER['PHP_SELF']));

include '../inc/checkLogin.php';



instantiate_header();

$header->addcss('/css/members.css');

include 'header.php';

if ($UserLevel == 'Trade') {

$odd = 1;
echo '<table class="members">';
	echo '<tr />';
	echo '<th>Winery</th>';
	echo '<th>Region</th>';
	echo '<th>Location</th>';
	echo '<th>Wine Maker</th>';
	echo '<th>General Manager</th>';
	echo '<th>Marketing Manager</th>';
	echo '<th>Retail Manager</th>';
	echo '<th>PR Manager</th>';
	echo '<th>Other</th>';	
	echo '</tr>';
foreach ($wineries as $w) {
	$odd++;
	
	if ($odd & 1) {
		$odder = ' class="odd"';
	} else {
		$odder = '';
	}

	echo '<tr '. $odder .'>';
		echo '<td class="name">';
		echo $w['Name'];
	//	echo '<br />'. $w['WineryID'];	
		echo '</td>';
		
		echo '<td>';
		foreach ($regions as $r) {
			if ($w['RegionID'] == $r['RegionID']) {
				echo $r['Name'];
			}
		}
		echo '</td>';

		echo '<td>';
		echo $w['Address'];	
		echo ', ';
		echo $w['Town'];	
		echo ', ';
		echo $w['Province'];
		echo '<br />';
		echo $w['Phone'];
		echo '<br />';
		echo $w['Website'];	
		echo '</td>';

		echo '<td>';
		echo $w['WineMakers'];	
		echo '<br />';
		echo $w['WineMakersEmail'];		
		echo '<br />';
		echo $w['WineMakersPhone'];	
		echo '</td>';

		echo '<td>';
		echo $w['GenMgrName'];		
		echo '<br />';
		echo $w['GenMgrEmail'];		
		echo '<br />';
		echo $w['GenMgrPhone'];	
		echo '</td>';

		echo '<td>';
		echo $w['MktMgrName'];		
		echo '<br />';
		echo $w['MktMgrEmail'];		
		echo '<br />';
		echo $w['MktMgrPhone'];	
		echo '</td>';

		echo '<td>';
		echo $w['RetMgrName'];		
		echo '<br />';
		echo $w['RetMgrEmail'];		
		echo '<br />';
		echo $w['RetMgrPhone'];	
		echo '</td>';

		echo '<td>';
		echo $w['PRName'];		
		echo '<br />';
		echo $w['PREmail'];		
		echo '<br />';
		echo $w['PRPhone'];	
		echo '</td>';

		echo '<td>';
		echo $w['OtherTitle'];		
		echo '<br />';
		echo $w['OtherName'];		
		echo '<br />';
		echo $w['OtherEmail'];		
		echo '<br />';
		echo $w['OtherPhone'];	
		echo '</td>';


	echo '</tr>';
}

echo '</table>';

} else {
	echo '<div class="pleaseLogin">';
	echo '<h2>You must be logged-in to view this page</h2>';
	echo '<p>Please <a href="/login.php" >login</a> before trying to view this page, or speak to a Wine Council of Ontario representative to gain access</p>';
	echo '</div>';
}	

include 'footer.php';
?>