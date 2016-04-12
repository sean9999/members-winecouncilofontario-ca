<?php
enable_chunks();

$cq['criterea'] = "ChunkID = 46";
$cq['fields']	= 'ChunkID';
$little_eds		= getImmediateChildren(getChunk($cq));

foreach ($little_eds as $key => $row) {
    $arrChunkID[$key]	= $row['ChunkID'];
    $arrztamp[$key]		= $row['ztamp'];
}

array_multisort($arrChunkID, SORT_DESC, $arrztamp, SORT_DESC, $little_eds);

?>


<h2>Past Meeting Minutes</h2>

<div id="minutes">
	<ul>
	
	<?php foreach ($little_eds as $ed) { ?>
	
		<li><a href="/<?= $ed['SEOName'] ?>" name="<?= $ed['Name'] ?>"><?= $ed['Title'] ?></a></li>
	
	<?php } ?>
	</ul>
	<div class="clearer"></div>
</div>



