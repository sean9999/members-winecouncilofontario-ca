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
	
<?php if ($S['IsMember'] > 0) { ?>
	
	<?php
	if ($le_chunk['ChunkID'] != '39') { 
	echo '<h1>';
	echo $page_title;
	echo '</h1>';
	}
	?>

		<?= $chunk_content ?>
		
		<div class="clearer"></div>
		<?php 
			if 	($le_chunk['ChunkID'] == '46')		
			{ 
			include 'widget_meeting-minutes-list.php';	
			echo '<div class="clearer"></div>';
			}
		?>

	
<?php
	}
	else
	{
	echo '<p>You must be a Wines of Ontario member to view this page.</p>';
	}
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