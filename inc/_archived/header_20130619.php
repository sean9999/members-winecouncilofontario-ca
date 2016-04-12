<?php

include_once 'resolvePageVariables.php';
instantiate_header();

$header->title = $page_title .' :: Wine Council Of Ontario Members Site';
$header->addmeta('<base href="http://'.$_SERVER['HTTP_HOST'].'" />');
$header->addmeta('<link rel="icon" type="image/gif" href="/assets/favicon.gif" />');
$header->addmeta('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">');

$header->addcss('/lib/extrander/extrander.css');
$header->addjs('/lib/extrander/animatedcollapse.js');
$header->addjquery('var x = 2;');
$header->addonload('
animatedcollapse.addDiv("downloads", 		"fade=1,speed=400,group=extrander1")
animatedcollapse.addDiv("upcoming_events",	"fade=1,speed=400,group=extrander1")
animatedcollapse.addDiv("attractions",		"fade=1,speed=400,group=extrander1")
animatedcollapse.addDiv("my_route",			"fade=1,speed=400,group=extrander1")
animatedcollapse.addDiv("whatsnew",			"fade=1,speed=400,group=extrander1")
animatedcollapse.ontoggle=function($, divobj, state){
}
animatedcollapse.init();
');
$header->addrawcss('div#downloads, div#upcoming_events, div#attractions, div#my_route, div#whatsnew { display: none; }');


$header->addmeta('<base href="http://'.$_SERVER['HTTP_HOST'].'" />');
$header->addmeta('<link rel="icon" type="image/gif" href="/assets/favicon.gif" />');

$header->addcss('css/reset.css');
$header->addcss('css/structure.css');
$header->addcss('css/typo.css');
$header->addcss('css/dev.css');

//	thickbox
//$header->addcss('/lib/thickbox/thickbox.css');
//$header->addjs('/lib/thickbox/thickbox.js');

//  colorbox
$header->addcss('/lib/colorbox/example2/colorbox.css');
$header->addjs('/lib/colorbox/jquery.colorbox.js');


$WineryID = localize('WineryID');

if (isset($userData['UserLevel'])) {
	$UserLevel = $userData['UserLevel'];
} else {
	$UserLevel = 'Non-Member';
}


$header->display();
?>



<div id="container">
	<div id="topbar">
    	<div id="header">
		<!-- Header start -->
		<div id="logoBox">
        <a href="/"><img src="http://www.winecouncilofontario.ca/assets/wineries_logo.png" alt="Wineries of Ontario — Members' Only Website" /></a>
        </div>
        <div id="loginBox">
        <?php include 'widget_loginBox.php'; ?>
        </div>
        <div class="clearer"></div>
		<!-- Header end -->
    	</div>
	</div>

	<div id="body">
	
