<?php
require_once '../../vars.php';
if (isset($action) && strlen($action)) require_once 'actions.php';

$extra_header_content = <<<BLOCK
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
google.load("jquery","1");
google.load("jqueryui","1");
function init() {
	$(document).ready(function() {
		add_event_datepicker_init();
		timepicker_init();
	});	
}
//]]>
</script>
<link rel="stylesheet" href="/css/themes/JQueryUI_DJC/ui.all.css" />
<link rel="stylesheet" href="/lib/time-picker/time_picker.css" />
<script src="/lib/time-picker/time_picker.js" type="text/javascript"></script>
<script src="/admin/events/timepicker_init.js" type="text/javascript"></script>
<script src="/admin/events/datepicker_init.js" type="text/javascript"></script>
<script type="text/javascript" src="/admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/admin/events/tinymce_init.js"></script>
BLOCK;

$view = localize('view');
switch ($view) {

	case 'event':
	localize('EventID');
	connect2database();
	$G = cleanForDB($_GET);
	$e = good_query_assoc("SELECT * FROM Events WHERE event_id = ".$G['event_id']);
	$page_title = htmlspecialchars($e['event_title']);
	$section_title = 'Event';
	include '../header.php';
	include 'event.php';
	include '../footer.php';
	break;

	default:	// default is 'events'
	$page_title = 'Events';
	include '../header.php';
	include 'add_event.php';
	echo	'<hr />';
	include 'events.php';
	include '../footer.php';
	break;
}

?>