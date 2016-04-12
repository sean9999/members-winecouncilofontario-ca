<?php
require_once 	'vars.php';
$section_title	= 'Members';
$section_id		= 'Members';
$page_title		= 'Members';
$page_id		= 'Members';

connect2database ();

instantiate_header();
$header -> body_id = 'Members';

include 'header.php';

?>


<div id="marquee">
	<?php
		enable_chunks(); 
		$chunk = getChunkByName('Member List');
		echo $chunk['Excerpt'];
	?>
</div>
<div class="clearer"></div>


<div id="mainNav">
<?php
	 if ($S['IsMember'] > 0) {
		connect2database ();
		include 'side_links/mainNav.php';
		}
?>
</div>

<div id="mainContent">
	<div id="Content">
<?php if ($S['IsMember'] > 0) { ?>

	<?php
		enable_chunks(); 
		$chunk = getChunkByName('Member List');
		echo $chunk['Content'];
		echo '<div class="clearer"></div>';
		include 'widget_members.php';	
		echo '<div class="clearer"></div>';
	?>

<?php
	}
	else
	{
	echo '<p>You must be a Wines of Ontario member to view this page.</p>';
	}
?>
	

	<div class="clearer"></div>

</div>

<div id="rightNav">

	<?php 
		include 'right_links/main.php'; 
	?>

<div class="clearer"></div>
</div>

<div class="clearer"></div>


<hr />

<div class="clearer"></div>


</div>
<?php
include 'footer.php';
?>