<?php
require_once 'vars.php';

if (isset($action)) require_once 'actions.php';

$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'home';
$section_title	= $self;
$page_title		= 'Home';


enable_chunks();

include '../inc/checkLogin.php';

instantiate_header ();
$header -> body_id = 'Welcome';
$header->addcss('/lib/colorbox/example2/colorbox.css');
//$header->addjs('/lib/colorbox/jquery.colorbox-min.js"');
$header->addonload('
	$(".colorbox").colorbox({
		width:		600, 
		iframe:		true, 
		scrolling:	false,
		height:		600
	});
');


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
		$UserLevels = array('Owner','Employee');
		if (in_array($UserLevel, $UserLevels)) {
			$chunk = getChunkBySEOName('Welcome');
			echo $chunk['Content'];
		} elseif ($UserLevel == 'Non-Member') {
			$noMemberchunk = getChunkBySEOName('Non-Member-Welcome');
			echo $noMemberchunk['Content'];
		} elseif ($UserLevel == 'Trade') {
			$noMemberchunk = getChunkBySEOName('Trade-Welcome');
			echo $noMemberchunk['Content'];
			echo '<div class="clearer"></div>';
			include 'widget_members2.php';
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