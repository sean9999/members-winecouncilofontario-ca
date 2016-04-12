<style>
	#bannerBox {
		margin-top: 30px;
		font-family: monospace;
		font-size: 12px;
		color: #333;
		height: 400px;
		overflow: hidden;
	}
	
	#bannerBox ul#trade-ads li {
		padding: 0px;
		margin: 0px 0px 200px 0;
		list-style: none;
		font-family: monospace;
		font-size: 10px;
		text-align: center;
	}
	
	#bannerBox ul#trade-ads li span.advert {
		font-size: 10px;
		text-transform: uppercase;
		color: #999999;
	}
	
	#bannerBox ul#trade-ads li div.dBug {
		margin-top: 10px;
		border: 1px dotted silver;
		width: 208px;
		text-align: left;
		padding: 5px;
	}
</style>


<div id="bannerBox">

<?php
	connect2database();
	// Grab some random ADs. The table is small so RAND() is okay for now and probably forever.
	// Make sure you've got ADs between the StartDate and EndDate
	$now = time();
	$ads = good_query_table("SELECT * FROM Ads WHERE IsActive = 1 AND StartDate < $now AND EndDate > $now ORDER BY RAND() LIMIT 3");
	$formatString = "Y-m-d"; 
	echo '<ul id="trade-ads">';
	foreach ($ads as $ad) {
		echo '<li>';
		echo '<span class="advert">Advertisement</span><br />';
		if (!empty($ad['URL'])) {
			echo '<a href="'. $ad['URL'] .'" target="_blank" title="'. $ad['Title'].' '. $ad['Blurb'].'">';
		}
		echo '<img src="http://members.winecouncilofontario.ca'. $ad['Image'] .'" alt="'.$ad['Name'].'"  width="220" height="369" />';
		if (!empty($ad['URL'])) {
			echo '</a>';
		}
		/*
		echo '<div class="dBug">';
		echo '<strong>dBug Info</strong><br />';
		echo 'Name: <strong>';
		echo $ad['Name'];
		echo '</strong><br />';
		echo 'Image: <strong>';
		echo $ad['Image'];
		echo '</strong><br />';
		echo 'URL: <strong>';
		if (!empty($ad['URL'])) {
			echo $ad['URL'];	
		} else {
			echo '<em>No URL</em>';
		}
		echo '</strong><br />';
		echo 'now: <strong>';
		echo date($formatString, $now);
		echo '</strong><br />';
		echo 'StartDate: <strong>';
		echo date($formatString, $ad['StartDate']);
		echo '</strong><br />';
		echo 'EndDate: <strong>';
		echo date($formatString, $ad['EndDate']);
		echo '</strong><br />';
		echo '</div>';
		*/
		echo '</li>';
	}
	echo '</ul>';

?>

</div>