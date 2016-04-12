<?php
require_once '../../vars.php';
extract($_GET);
if (isset($action) && strlen($action)) include 'actions.php';
$section = 'Wineries';

$tiny_MCE_load_js = <<<BLOCK
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

	<script src="/chunks/chunks.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="/chunks/chunks.css" />
	<link rel="stylesheet" type="text/css" href="/chunks/chunks_dev.css" />
	<script type="text/javascript" src="http://winecountryontario.ca/lib/tinymce/jscripts/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
	<script src="http://www.google.com/jsapi" type="text/javascript"></script>
	<script type="text/javascript">
	//<![CDATA[
	google.load("jquery", "1");
	google.setOnLoadCallback(function() {
		$(document).ready(function() {
			chunks_init();
		});
	});
	//]]>
	</script>
	<script type="text/javascript" src="http://winecountryontario.ca/lib/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
	<script type="text/javascript" src="/chunks/chunks_init2.js"></script>
	
	<script>
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
</script>
	
BLOCK;

if (!strlen($view)) $view = 'wineries';

switch ($view) {
	
	case 'wineries':
	$extra_header_content = $tiny_MCE_load_js;
	include 'header.php';
	echo '	<ul class="tabs">
			<li><a href="#tabOne">Wineries</a></li>
			<li><a href="#tabTwo">No Region (inactive Wineries for now)</a></li>
			<li><a href="#tabThree">Add a Winery</a></li>
			</ul>
			<div class="tab_container">
		    <div id="tabOne" class="tab_content">
';
	include 'wineries.php';
	echo	'	</div>
				<div id="tabTwo" class="tab_content">
';
	include 'nowineries.php';
	echo	'	</div>
				<div id="tabThree" class="tab_content">
';
	include 'new_winery.php';
	echo '	</div>
			</div>
			<div class="clearer"></div>
';
	break;
	
	default:
	$extra_header_content = $tiny_MCE_load_js;
	include 'header.php';
	include $view . '.php';

}
include 'footer.php';
?>