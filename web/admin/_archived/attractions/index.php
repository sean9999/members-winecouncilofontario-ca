<?php
require_once '../../vars.php';
extract($_GET);
if (isset($action) && strlen($action)) include 'actions.php';
$section = 'Attractions';

$tiny_MCE_load_js = <<<BLOCK
	<!-- TinyMCE -->
	<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "textareas",
			editor_selector : "richText",
			theme : "advanced",
			invalid_elements : "span",
			extended_valid_elements : "-p,li,ul[type]",
			plugins : "imagemanager",
			theme_advanced_disable : "strikethrough,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,cut,copy,paste,help,code,hr,removeformat,styleselect,sub,sup,forecolor,backcolor,forecolorpicker,backcolorpicker,charmap,visualaid,anchor,newdocument,blockquote,separator,cleanup",
			theme_advanced_buttons1_add_before : "insertimage,image,bullist,numlist,undo,redo,link,unlink",
			theme_advanced_buttons2 : "",
        	theme_advanced_buttons3 : "",
        	theme_advanced_blockformats : "h1,h2,h3,h4,p,blockquote"
		});
	</script>
	<script type="text/javascript">
	function toggleEditor(id) {
		if (!tinyMCE.getInstanceById(id))
			tinyMCE.execCommand('mceAddControl', false, id);
		else
			tinyMCE.execCommand('mceRemoveControl', false, id);
	}
	</script>
	<!-- /TinyMCE -->	
BLOCK;

if (!strlen($view)) $view = 'attractions';

switch ($view) {
	
	case 'attractions':
	$extra_header_content = $tiny_MCE_load_js;
	include '../header.php';
	include 'attractions.php';
	include 'new_attraction.php';
	break;
	
	default:
	$extra_header_content = $tiny_MCE_load_js;
	include '../header.php';
	include $view . '.php';

}
include '../footer.php';
?>