<?php
require_once 	'vars.php';
$section_title	= 'home';
$section_id		= 'home';

$page_title		= 'Search Results';
$page_id		= 'search';

instantiate_header();

$header -> body_id = $page_id;

//	search terms should be cleaned
$terms		= $_GET['q'];
$termsarr	= explode(' ',$_GET['q']);

//	search chunks
enable_chunks();
$chunks_results = searchChunks($terms);

include 'header.php';

?>

<div class="clearer"></div>

<div id="mainNav">
<?php
include 'side_links/mainNav.php';
?>
</div>

<div id="mainContent">

	<div id="Content">
	
	<p>Here are the results for <?= $terms ?>:</p>
	
	<?php require_once 'function.shortenText.php'; ?>
	
	<div id="SearchResults">
		

		<?php if(sizeof($chunks_results)) { ?>
		<!--	CHUNKS RESULTS	-->
		<h1>Content Results</h1>		
		<?php } ?>
		<?php foreach ($chunks_results as $result) { ?>	
		<div class="SearchResult ChunksResult">
			<h2><a href="/<?= $result['SEOName'] ?>"><?= $result['Title'] ?></a></h2>
			<p class="SearchResultDescription">
			<?php 
			$shortened_description = shortenText(strip_tags($result['Content']),250,'fancy');
			echo $shortened_description;
			?>
			<span class="morelink"><a href="/<?= $result['SEOName'] ?>">...more</a></span>
			</p>
		</div>
 		<?php } ?>

	
	</div>
	
	<div class="clearer"></div>
	</div>


<div id="rightNav">

	<?php include 'right_links/main.php'; ?>
	<div class="clearer"></div>

</div>

<div class="clearer"></div>

</div>
<?php
include 'footer.php';
?>