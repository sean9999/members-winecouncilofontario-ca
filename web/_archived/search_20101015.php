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
	
//	search events
connect2database();
require_once 'function.dateConversions.php';
$e_SQL = 'SELECT * FROM Events WHERE ';
foreach ($termsarr as $word) {
	$e_SQL .= "event_title LIKE '%$word%' OR ";
	$e_SQL .= "event_desc LIKE '%$word%' OR ";
	$e_SQL .= "event_attraction_tags LIKE '%$word%' OR ";
	$e_SQL .= "info_location LIKE '%$word%' OR ";
	$e_SQL .= "info_website LIKE '%$word%' OR ";
}
$mysqlnow = timeStampToMySQLDate(time());
$e_SQL .= "event_title = 'Boobz!' AND is_active > 0 AND event_date_end > '$mysqlnow' ORDER BY event_date_end ASC";
$events_results = good_query_table($e_SQL);	
	
	
//	search wineries
connect2database();
$w_SQL = 'SELECT * FROM Wineries WHERE ';
foreach ($termsarr as $word) {
	$w_SQL .= "Name LIKE '%$word%' OR ";
	$w_SQL .= "Description LIKE '%$word%' OR ";
	$w_SQL .= "WineryNumber LIKE '%$word%' OR ";
	$w_SQL .= "Address LIKE '%$word%' OR ";
	$w_SQL .= "Town LIKE '%$word%' OR ";
	$w_SQL .= "WineMakersChoice LIKE '%$word%' OR ";
	$w_SQL .= "BestLCBOBrand LIKE '%$word%' OR ";
	$w_SQL .= "WineMakers LIKE '%$word%' OR ";
	$w_SQL .= "Website LIKE '%$word%' OR ";			 	
}
$w_SQL .= 'WineryID = 99999';
$wineries_results = good_query_table($w_SQL);



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

		<?php if(sizeof($wineries_results)) { ?>
		<!--	WINERIES RESULTS	-->
		<h1>Wineries' Results</h1>	
		<?php } ?>
		<?php foreach ($wineries_results as $result) { ?>	
		<div class="SearchResult WineryResult">
			<h2><a href="/pop_winery.php?WineryID=<?= $result['WineryID'] ?>&keepThis=true&TB_iframe=true&height=520&width=680" class="thickbox" title="<?= $result['Name'] ?> <?= $result['WineryNumber'] ?>"><?= $result['Name'] ?> <?= $result['WineryNumber'] ?></a></h2>
			<p class="SearchResultDescription">
			<?php 
			$shortened_description = shortenText(strip_tags($result['Description']),250,'fancy');
			echo $shortened_description;
			?>
			<span class="morelink"><a href="/pop_winery.php?WineryID=<?= $result['WineryID'] ?>&keepThis=true&TB_iframe=true&height=520&width=680" class="thickbox" title="<?= $result['Name'] ?> <?= $result['WineryNumber'] ?>">...more</a></span>
			</p>
		</div>
 		<?php } ?>

		<?php if(sizeof($events_results)) { ?>
		<!--	EVENTS RESULTS	-->		
		<h1>Events' Results</h1>	
		<?php } ?>
		<?php foreach ($events_results as $result) { ?>	
		<div class="SearchResult EventResult">
			<h2><a href="/event.php?event_id=<?= $result['event_id'] ?>"><?= $result['event_title'] ?></a></h2>
			<p class="SearchResultDescription">
			<?php 
			$shortened_description = shortenText(strip_tags($result['event_desc']),250,'fancy');
			echo $shortened_description;
			?>
			<span class="morelink"><a href="/event.php?event_id=<?= $result['event_id'] ?>">...more</a></span>
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