<?php
// create an accordian list of all available assets either global or specific to a Region
// as part of the /lib/extrander library
connect2database();
if (isset($_GET['RegionID'])) $RegionID = $_GET['RegionID']; else $RegionID = 0;
?>



<?php if ($S['IsMember'] > 0) { ?>

<div class="extrander">
	<div class="extrand hide">
	<h2><a href="javascript:animatedcollapse.toggle('whatsnew')" onclick="toggle_visibility('downloads');">What's New</a></h2>
	
	<?php
	enable_chunks();
	$most_recent_chunks = getMostRecentChunks();

	echo '<div id="whatsnew">';
	echo '<ul>';
		foreach ($most_recent_chunks as $mrc) {
			
			echo '<li>';
			echo '<a href="/'. $mrc['SEOName'] .'">';
			echo $mrc['Title'];
			echo '</a>';
			echo '</li>';
		
		}
	echo '</ul>';
	echo '</div>';
	echo '</div>';
	?>
	
	<?php
	require_once 'function.filesAndDirectories.php';
	$download_directory = HomePathLocal . DownloadsPath;
	$filez		= listFilesIn($download_directory);
	sort($filez);
	$filez		= array_reverse($filez);
	?>
	<div class="extrand hide">
	<h2><a href="javascript:animatedcollapse.toggle('my_route')">Recent E-blasts</a></h2>
		<div id="my_route">
			<ul>
			<?php
			$count = 0;
			foreach ($filez as $le_file) {
				echo '<li><a href="/content/eblasts/'.$le_file.'" target="_blank" title="Open '.$le_file.' in a new window">'.$le_file.'</a></li>';
				$count++;
				if ($count == 5) break;
			}
			?>
			</ul>
		</div>
	</div>

</div>


<?php
	}
	else
	{
	echo '<p>&nbsp;</p>';
	}
?>
