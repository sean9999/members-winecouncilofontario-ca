<?php
require_once '../../vars.php';
extract($_GET);
if (isset($action) && strlen($action)) include 'actions.php';
$section = 'Attractions';

if (!strlen($view)) $view = 'everything';

$extra_header_content = <<<BLOCK
	<link rel="stylesheet" href="/admin/pairings/everything.css" type="text/css" />
	<script src="/admin/pairings/js.js" type="text/javascript"></script>
BLOCK;

instantiate_header();
$header->addcss('/admin/pairings/everything.css');
$header->addjs("/admin/pairings/js.js");

switch ($view) {
	
	case 'everything':
	include '../header.php';
	include 'everything.php';
	break;
	
	default:
	$extra_header_content = $tiny_MCE_load_js;
	include '../header.php';
	include $view . '.php';

}
include '../footer.php';
?>