<?php // if (($S['IsMember'] > 0) || ($WineryID == 88888) || ($WineryID == 99999) { ?>

<ul class="tier1">
	<?php 
	enable_chunks();
	$fl = array('fields' => 'ChunkID,SEOName,Title,UserLevels', 'tags' => "",'return_structure' => '3d','criterea' => 'ChildOf = 0','sortby' => 'Tags ASC');
	$main_nav = getChunk($fl);
	//new dBug($main_nav);

	if ($UserLevel == 'Owner' || $UserLevel == 'Employee') {
		echo '<li '. $extra_HTML.' id="Welcome"><a href="/" class="tier1">Welcome</a></li>';
	} elseif ($UserLevel == 'Non-Member') {
		echo '<li '. $extra_HTML.' id="Welcome"><a href="/" class="tier1">Welcome</a></li>';
	} elseif ($UserLevel == 'Trade') {
		echo '<li '. $extra_HTML.' id="Welcome"><a href="/" class="tier1">Welcome</a></li>';
	}
	
	
	foreach ($main_nav as $p) {
	$UserLevels = explode(",",$p['UserLevels']);
	if ($p['ChunkID'] != 39) {
		if (in_array($UserLevel, $UserLevels)) {
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
	}
}

//new dBug($p); 
//new dBug($le_chunk);

?>
</ul>

<?php
//	}
//	else
//	{
//	echo '<p>&nbsp;</p>';
//	}
?>



<?php 
	echo '<ul class="tier1">';
/*	
	$UserLevels = array('Owner', 'Employee');
	if (in_array($UserLevel, $UserLevels)) {
		echo '<li id="winery"><a href="/winery-edit.php">Winery Info</a></li>';
		echo '<li id="wines"><a href="/wines.php" class="tier1">Your Wines</a>'; 
		if ($section_id == 'wines')
			echo '<ul class="tier2"><li id="wine"><a href="/add_wine.php">Add a Wine</a></li></ul>';
		echo '</li>';	
	}
*/	
	$UserLevels = array('Owner','Employee','Non-Member');
	if (in_array($UserLevel, $UserLevels)) {	
	//	if($S['WineryID'] == 302) {
			echo '<li id="survey"><a href="/survey.php">Winery Sustainability Survey</a></li>';
	//	} else {
	//		echo '<li id="survey"><a href="/survey_closed.php">Winery Sustainability Survey.</a></li>';
	//	}
	}

	$UserLevels = array('Owner','Employee');
	if (in_array($UserLevel, $UserLevels)) {
		include 'widget_searchbox.php';
	}

	echo '</ul>';	

//	include 'widget_navDbug.php'; 
?>

