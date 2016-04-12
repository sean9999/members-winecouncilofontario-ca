<?php // TRADE ADS MODULE
require_once '../../vars.php';
extract($_GET);
if (isset($action) && strlen($action)) include 'actions.php';
$section = 'Trade Ads';

//	date and time picker


$tiny_MCE_load_js = <<<BLOCK
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/datetimepicker.js"></script>
	<link rel="stylesheet" href="http://fox.gourdisgood.com/z/lib/jquery-ui/css/gourd-skywalker/jquery-ui.css" />
	
	<!-- TinyMCE -->
	<script type="text/javascript" src="/lib/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="/lib/tinymce/jscripts/tiny_mce/plugins/imagemanager/js/mcimagemanager.js"></script>

	<script type="text/javascript" src="/admin/chunks/chunks_init2.js"></script>
	
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

	<script type="text/javascript">
	$(document).ready(function() {
		$('#StartDate').datetimepicker({
			showOn: 'button',
			buttonImage: '/assets/83-calendar.png',
			buttonImageOnly: true,
			dateFormat: 'dd/mm/yy',
			parseDate: 'yy-mm-dd',
			stepMinute: 15,
			hourGrid: 4,
			minuteGrid: 15
		});

		$('#EndDate').datetimepicker({
			showOn: 'button',
			buttonImage: '/assets/83-calendar.png',
			buttonImageOnly: true,
			dateFormat: 'dd/mm/yy',
			parseDate: 'yy-mm-dd',
			stepMinute: 15,
			hourGrid: 4,
			minuteGrid: 15
		});


		});
	</script>

BLOCK;

if (!strlen($view)) $view = 'ads';

switch ($view) 
{
	case 'ads':
		$extra_header_content = $tiny_MCE_load_js;
		include '../header.php';
		echo '	<ul class="tabs">
				<li><a href="#tabOne">Trade Ads</a></li>
				<li><a href="#tabTwo">Add an Ad</a></li>
				</ul>
				<div class="tab_container">
			    <div id="tabOne" class="tab_content">
		';
		include 'ads.php';
		echo	'	</div>
					<div id="tabTwo" class="tab_content">
		';
		echo '<hr />';
		include 'new_ad.php';
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