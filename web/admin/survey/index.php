<?php
require_once '../../vars.php';
extract($_GET);
if (isset($action) && strlen($action)) include 'actions.php';
$section = 'Survey';

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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
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

if (!strlen($view)) $view = 'survey';

switch ($view) {
	
	case 'survey':
	$extra_header_content = $tiny_MCE_load_js;
	include '../header.php';
	echo '	<ul class="tabs">
			<li><a href="#tabOne">Survey</a></li>
			<li><a href="#tabTwo">Add a Survey Question</a></li>
			</ul>
			<div class="tab_container">
		    <div id="tabOne" class="tab_content">
	';
	include 'survey.php';
	echo	'	</div>
				<div id="tabTwo" class="tab_content">
	';
	echo '<hr />';
	include 'new_question.php';
	echo '	</div>
			</div>
			<div class="clearer"></div>
	';
	break;
	
	default:
	$extra_header_content = $tiny_MCE_load_js;
	include '../header.php';
	include $view . '.php';

}


echo '<p>view is ' . $view . ' and action is ' . $action;



include '../footer.php';
?>