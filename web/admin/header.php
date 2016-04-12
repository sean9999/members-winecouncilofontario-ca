<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<title><?= $section_id ?> :: <?= Chunks_User ?></title>
	<link rel="stylesheet" href="/css/typo.css" type="text/css" />
	<link rel="stylesheet" href="/css/reset.css" type="text/css" />
	<link rel="stylesheet" href="/admin/admin.css" type="text/css" />
	
	
	<script src="/admin/admin.js" type="text/javascript"></script>
	<script src="js.js" type="text/javascript"></script>
	<?php
	if (isset($extra_header_content)) {
	echo $extra_header_content;
	}
	?>
</head>

<body onload="if(typeof init=='function')init();" onunload="if(typeof GUnload=='function')GUnload();">

	<div class="admin_header">
		<div id="adminTitle">
		<h1>
		<?php 
		echo '<a href="/admin/' . $section_id . '">';
		echo $section_title;
		echo '</a>';
		if ( strlen($page_title) && ($page_title != $section_title) ) {
		?>
		<span class="secondary_h1">
		&gt; <?= $page_title; ?>
		</span>
		<?php
		} 
		?>
		</h1>
		</div>
		<div class="clearer"></div>
	</div>
	<div id="mainBox">
	
	<div class="ob_flush">
	<!--	for debug info. in prod, nothing should be appearing in here	-->
	<?php
	if ($debug_stuff) {
		echo trim($debug_stuff);
	}
	?>
	</div>
	
	<p class="message"><?= $message ?></p>

