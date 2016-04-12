<?php
require_once '../../vars.php';
if ($action) require_once 'actions.php';
$section_title = 'Chunks';
require_once 'resolvePageVariables.php';
enable_chunks();
$view = localize('view');

if ($view == '') $view = 'chunks';

$just_tinyMCE_content = <<<BLOCK
<script src="/admin/chunks/chunks.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/admin/chunks/chunks.css" />
<link rel="stylesheet" type="text/css" href="/admin/chunks/chunks_dev.css" />
<script type="text/javascript" src="/lib/tinymce/jscripts/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
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
<script type="text/javascript" src="/lib/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="/admin/chunks/chunks_init2.js"></script>
BLOCK;

$extra_header_content .= <<<BLOCK
<script src="/admin/chunks/chunks.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/lib/colorbox/example1/colorbox.css" />
<link rel="stylesheet" type="text/css" href="/admin/chunks/chunks.css" />
<link rel="stylesheet" type="text/css" href="/admin/chunks/chunks_dev.css" />
<script type="text/javascript" src="/lib/tinymce/jscripts/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
google.load("jquery", "1");
google.load("jqueryui", "1");
google.setOnLoadCallback(function() {
	$(document).ready(function() {
		chunks_init();
		// colorbox init
		$(".colorbox").colorbox({width:"75%", height:"75%",opacity:0.5, iframe:true});
	});
});
//]]>
</script>
<script src="/lib/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<script type="text/javascript" src="/lib/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="/admin/chunks/chunks_init2.js"></script>
BLOCK;

switch ($view) {

	case 'preview':
	include 'preview.php';
	break;

	case 'chunk_modal':
	$extra_header_content  = $just_tinyMCE_content;
	include 'simple_header.php';
	include 'chunk.php';
	include 'simple_footer.php';
	break;

	case 'chunks':
	include '../header.php';
	include 'chunks.php';
	include '../footer.php';	
	break;
	
	case 'pop_chunk':
	$extra_header_content .= <<<BLOCK
	<link rel="stylesheet" href="/admin/admin.css" type="text/css" />
	<link rel="stylesheet" href="/admin/chunks/chunks.css" type="text/css" />
	<link rel="stylesheet" href="/css/typo.css" type="text/css" />
	<link rel="stylesheet" href="/css/reset.css" type="text/css" />
	<style type="text/css">
	body {
		background-color: red;
	}
	</style>
BLOCK;
	include 'simple_header.php';
	include 'chunk.php';
	include 'simple_footer.php';
	break;
	
	default:
	include '../header.php';
	include $view . '.php';
	include '../footer.php';
	break;

}
?>