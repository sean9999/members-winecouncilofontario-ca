<?php
require_once '../../vars.php';
enable_chunks();

$chunk		= getChunk($_GET['ChunkID']);
$ancestry	= getAncestry($_GET['ChunkID']);

$path_so_far = '/' . $chunk['SEOName'];

//	BEGIN	BREADCRUMB

if (isset($ancestry) && is_array($ancestry) && sizeof($ancestry) > 1) {
	
	$breadcrumb = array_reverse($ancestry);
	$path_so_far = '';
	$counter = 0;
	
	echo '<div class="breadcrumb">';
	
	foreach ($breadcrumb as $crumb) {
		$counter++;
		$path_so_far .= '/' . $crumb['SEOName'];
		if (sizeof($breadcrumb) > $counter) {
			echo '<a href="?ChunkID='. $crumb['ChunkID'] . '">' . $crumb['Title'] . '</a>';
			echo ' &raquo; ';
		} else {
			echo '<strong>' . $crumb['Title'] . '</strong>';
		}
	}
	
	echo '</div>';
}

//	END		BREADCRUMB

$page_title = $path_so_far;

$extra_header_content = <<<BLOCK
<style type="text/css">
div.breadcrumb {
	font-family:	"Verdana";
	font-size:		10px;
	padding-bottom: 2em;
	color:			gray;
}
div.the_chunk {
	marging:		auto;
	width:			99%;
	height:			90%;
	border:			1px solid silver;
}
</style>
<link rel="stylesheet" href="/css/typo.css" type="text/css" />
BLOCK;

include 'simple_header.php';

//new dBug($ancestry);

//echo '<h1>' . $chunk['Title'] . '</h1>';

echo '<div class="the_chunk">';

echo $chunk['Content'];

echo '</div>';

include 'simple_footer.php';
?>