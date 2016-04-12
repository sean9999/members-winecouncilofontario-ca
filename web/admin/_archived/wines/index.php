<?php
require_once '../../vars.php';
extract($_GET);
if (isset($action) && strlen($action)) include 'actions.php';
$section = 'Wines';

$tiny_MCE_load_js = <<<BLOCK
	<!-- TinyMCE -->
	<script type="text/javascript" src="../../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
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

connect2database();
$rows = good_query_table("SELECT TastingNotes FROM Wines");

$tagPool = Array();

foreach($rows as $r)
{
	$tags = explode(',',$r['TastingNotes']);
	//new dBug($tags);
	
	$tagPool = array_merge($tagPool, $tags);
	$tagPool = array_unique($tagPool);
}

$tastingNotesTP = $tagPool;

$rows = good_query_table("SELECT Awards FROM Wines");

$tagPool = Array();

foreach($rows as $r)
{
	$tags = explode(',',$r['TastingNotes']);
	//new dBug($tags);
	
	$tagPool = array_merge($tagPool, $tags);
	$tagPool = array_unique($tagPool);
}

$AwardsTP = $tagPool;


//	<link href="css/reset.css" rel="stylesheet" type="text/css" />
//	<link href="css/master.css" rel="stylesheet" type="text/css" />

$tagsHeader = '
	<link href="css/jquery-ui/jquery.ui.autocomplete.custom.css" rel="stylesheet" type="text/css"  />

	<script src="js/jquery/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery-ui/jquery-ui-1.8.core-and-interactions.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery-ui/jquery-ui-1.8.autocomplete.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/tag-it.js" type="text/javascript" charset="utf-8"></script>
	
	<script>	
	$(document).ready(function(){
		$("#TastingNotes").tagit({
			availableTags: ' . json_encode($tastingNotesTP) . '
		});
	});
	</script>';

//		$("#Awards").tagit({
//			availableTags: ' . json_encode($AwardsTP) . '
//		});

if (!strlen($view)) $view = 'wines';

$extra_header_content = $tiny_MCE_load_js . $tagsHeader;

switch ($view) 
{
	case 'wines':
		include '../header.php';
		echo '	<ul class="tabs">
				<li><a href="#tabOne">Wines</a></li>
				<li><a href="#tabTwo">Add a Wine</a></li>
				</ul>
				<div class="tab_container">
			    <div id="tabOne" class="tab_content">
		';
		include 'wines.php';
		echo	'	</div>
					<div id="tabTwo" class="tab_content">
		';
		echo '<hr />';
		include 'new_wine.php';
		echo '	</div>
				</div>
				<div class="clearer"></div>
		';
		break;
	
	default:
		include '../header.php';
		include $view . '.php';
}


echo '<p>view is ' . $view . ' and action is ' . $action;



include '../footer.php';
?>