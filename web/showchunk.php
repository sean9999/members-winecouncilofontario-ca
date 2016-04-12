<?php
require_once 'vars.php';
enable_chunks();

$le_chunk		= getChunkFromPath($address);
$section_id		= $le_chunk['Name'];
$section_title	= $le_chunk['Title'];
$chunk_content	= $le_chunk['Content'];
$page_title		= $le_chunk['Title'];

include '../inc/checkLogin.php';

instantiate_header ();
$header -> body_id = $le_chunk['SEOName'];
//	fix? hack?
//$le_chunk = array_map('utf8_decode',$le_chunk);
include 'header.php';
//new dBug($le_chunk);
?>
<div class="clearer"></div>
<div id="mainNav">
	<?php include 'side_links/mainNav.php'; ?>
</div>
<div id="mainContent">
	<div id="Content">
	
<?php
	$UserLevels = explode(",",$le_chunk['UserLevels']);
	if (in_array($UserLevel, $UserLevels)) {
		if ($le_chunk['ChunkID'] != '39') { 
			echo '<h1>';
			echo $page_title;
			echo '</h1>';
		}
		echo $chunk_content;
		echo '<div class="clearer"></div>';
		
		// HOME PAGE FOR MEMBERS, show the meeting minutes
		if 	($le_chunk['ChunkID'] == '46') { 
			include 'widget_meeting-minutes-list.php';	
			echo '<div class="clearer"></div>';
		}	
	
		// HOME PAGE FOR TRADE, show the members' list
		if 	($le_chunk['ChunkID'] == '455') { 
			include 'widget_members2.php';	
			echo '<div class="clearer"></div>';
		}

	}
	else {
		echo '<h1>You must be a member to view this page.</h1>';
		echo '<p>If you are a member of the Wine Council of Ontario and believe you should see this page, please <a href="/Contact">contact us</a>.</p>';
	}
			
	/*		
	// DEBUG STUFF
	echo '<br /><br /><br />';
	echo '<p style="font-family:monospace;">User Levels for this Page: ';
	echo $le_chunk['UserLevels'];
	echo '</p>';
	*/
?>
		
	</div>
<div id="rightNav">
	<?php 
		include 'right_links/main.php'; 
	?>
<div class="clearer"></div>
</div>
<div class="clearer"></div>
</div>
<?php include 'footer.php'; ?>