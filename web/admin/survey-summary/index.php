<?php
require_once '../../vars.php';
extract($_GET);
if (isset($action) && strlen($action)) 
	include 'actions.php';
$section = 'Summary';

$section_id = 'summary';

connect2database();

$years = good_query_table("SELECT DISTINCT Year FROM SurveyAnswersSummary ORDER BY Year DESC");

if (empty($view)) {
	$view = 'summary';
}

switch ($view) {
	
	case 'summary':
		//$extra_header_content = $tiny_MCE_load_js;

		$extra_header_content = '
<link rel="stylesheet" href="summary.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>' . "\n" . file_get_contents(__DIR__.'/summary.js') . "\n" . '</script>
';

		include '../header.php'; 
		
		if($years) {?>
				
			<ul class="tabs">
			<?php foreach ($years as $y) {?>
				<li><a href="#tab<?= $y['Year'] ?>"><?= $y['Year'] ?></a></li>
			<?php } ?>			
			</ul>
			
			<div class="tab_container">
			<?php 
			foreach ($years as $y) 
			{
				$thisYear = $y['Year'];
			?>
				<div id="tab<?= $y['Year'] ?>" class="tab_content">
				<?php include 'summary.php'; ?>
				</div>
			<?php } ?>
			</div>
		<?php }
		else {
		?>
			<h2>There are no no reports to view at this time.</h2>
		<?php }

		break;
	default:
		$extra_header_content = $tiny_MCE_load_js;
		include '../header.php';
		include $view . '.php';
		break;
}


echo '<p>view is ' . $view . ' and action is ' . $action;

include '../footer.php';
?>
