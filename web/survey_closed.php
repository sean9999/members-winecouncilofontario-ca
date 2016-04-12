<?php
require_once 'vars.php';

if (isset($action)) require_once 'actions.php';

$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'survey';
$section_title	= $self;
enable_chunks();

include '../inc/checkLogin.php';

instantiate_header ();
$header -> body_id = 'survey';
include 'header.php';
enable_chunks();
?>
<div class="clearer"></div>
<div id="mainNav">
<?php
include 'side_links/mainNav.php';
?>
</div>
<div id="mainContent">
	<div id="Content">
	<?php
	if ($S['IsMember'] > 0) { 
		//$chunk = getChunkByName('Survey Closed');
		$chunk = getChunkByName('Welcome Survey 2014');
		echo '<h1>' . $chunk['Title'] . '</h1>';
		echo $chunk['Content'];
	} else {
		$noMemberchunk = getChunkByName('Non-Member Welcome');
		echo $noMemberchunk['Content'];
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
<?php 

include 'footer.php'; ?>