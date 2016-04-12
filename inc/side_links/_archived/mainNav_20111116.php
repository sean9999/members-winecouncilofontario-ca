<?php if ($S['IsMember'] > 0) { ?>

<ul class="tier1">
	<?php 
	enable_chunks();
	$fl = array('fields' => 'ChunkID,SEOName,Title', 'tags' => "",'return_structure' => '3d','criterea' => 'ChildOf = 0','sortby' => 'Tags ASC');
	$main_nav = getChunk($fl);
	//new dBug($main_nav);
	foreach ($main_nav as $p) {
	
	if ($p['SEOName'] == $le_chunk['SEOName']) $extra_HTML = ' class="active"';
	
		if (chunkHasChildren($p['ChunkID'])) {
			//$children = getImmediateChildren($p['ChunkID']);
			$children = getImmediateChildren($p['ChunkID'],array('sortby' => 'Tags DESC'));
			$children = array_reverse($children);
			?>
			<li<?= $extra_HTML ?> id="<?= $p['SEOName'] ?>"><a href="/<?= $p['SEOName'] ?>" class="tier1"><?= $p['Title'] ?></a>
				<?php
				if (strlen($extra_HTML) || $le_chunk['ChildOf'] == $p['ChunkID']) { 
				?>
				<ul class="tier2 <?= $p['SEOName'] ?>">
					<?php
					foreach ($children as $c) {
					$extra_HTML = '';
					if ($c['SEOName'] == $le_chunk['SEOName']) $extra_HTML = ' class="subActive"';
					?>
						<li<?= $extra_HTML ?> id="<?= $p['SEOName'] ?>"><a href="/<?= $p['SEOName'] ?>/<?= $c['SEOName'] ?>"><?= $c['Title'] ?></a></li>
					<?php } ?>
				</ul>
				<?php
				}
				?>
			</li>
	
			<?php
			} else {
			
					$extra_HTML = '';
					if ($p['SEOName'] == $le_chunk['SEOName']) $extra_HTML = ' class="active"';
			?>

		<li <?= $extra_HTML ?> id="<?= $p['SEOName'] ?>"><a href="/<?= $p['SEOName'] ?>" class="tier1"><?= $p['Title'] ?></a></li>
	
		<?php
		}
		$extra_HTML = '';
}

//new dBug($p); 
//new dBug($le_chunk);

?>
</ul>

<?php
	}
	else
	{
	echo '<p>&nbsp;</p>';
	}
?>


<ul class="tier1">
<?php if ($S['IsMember'] > 0) { ?>

	<li id="winery"><a href="/winery-edit.php">Winery Info</a></li>
	<?php
//	if($S['WineryID'] == 302)
//	{
		echo '<li id="wines"><a href="/wines.php" class="tier1">Your Wines</a>';
		 
		if ($section_id == 'wines')
			echo '<ul class="tier2"><li id="wine"><a href="/add_wine.php">Add a Wine</a></li></ul>';
		
		echo '</li>';
//	}
	?>
	
<?php
	}
	else
	{
	}
?>
	<li id="survey"><a href="/survey_closed.php">Winery Sustainability Survey</a></li>
</ul>

<?php if ($S['IsMember'] > 0) { ?>
<?php include 'widget_searchbox.php'; ?>
<?php
	}
	else
	{
	echo '<p>&nbsp;</p>';
	}
?>
