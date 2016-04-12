<?php
require_once 'vars.php';
require_once 'getSetUID.php';
require_once 'function.textConversions.php';
require_once 'function.characterConversions.php';
connect2database();
$winery = good_query_assoc("SELECT * FROM Wineries WHERE WineryID = " . $_GET['WineryID']);
$back_button_URL = '/' . good_query_value("SELECT SEOName FROM Regions WHERE RegionID = $winery[RegionID]");
$UsersHome		= 'City Hall, 100 Queen Street West, Toronto, ON';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="user-scalable=no, width=device-width" />
	<title><?= $winery['Name'] ?></title>
	<base href="<?= HomePathWeb ?>" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/popup.css" rel="stylesheet" type="text/css" />	
	<script src="http://www.google.com/jsapi?key=ABQIAAAAp9Tl3rO5vkJcTs-ZMJ6kWhROjz-P0gwSC5av7D8pmg5PuGE6lxTTEdNdY6Gr-FcrI0S3Idh7R4fRVQ" type="text/javascript"></script>
	<script type="text/javascript">
	google.load("jquery","1");
	//google.load("jqueryui");	
	var wineryName	= '<?= $winery['Name'] ?>';
	var wineryID	= '<?= $winery['WineryID'] ?>';
	var usersLocale	= 'en_CA';
	var usersHome	= '<?= $UsersHome ?>';
	var userID		= '<?= $UserID ?>';
	var regionID	= <?= $winery['RegionID'] ?>;
	var googleMapsURL = 'http://maps.google.ca';
	</script>
	
	<style type="text/css">
	p#add2routemessage {
		text-align: right;
		font-weight: bold;
	}
	</style>
	
	<script src="/js/myroute.js" type="text/javascript"></script>
	
</head>
<body>

<div id="popup">
	<div class="clearer"></div>
	<h1><?= $winery['Name'] ?></h1>
	<?= $winery['Description'] ?>

	<hr class="clearer" />

	<div id="popCol1">
		<?php
		$numberofwinemakers = 0;
		if (strlen(trim($winery['WineMakers'])))			$numberofwinemakers = 1;
		if (substr_count($winery['WineMakers'],',') > 0)	$numberofwinemakers = substr_count($winery['WineMakers'],',') + 1;
		switch ($numberofwinemakers) {
		case 0:
		// display nothing
		break;
		case 1:
		?>
		<p><strong>Winemaker:</strong><br />
		<?= trim($winery['WineMakers']) ?></p>
		<?php
		break;
		default:
		?>
		<p><strong>Winemakers:</strong><br />
		<?= str_replace(',','<br />',trim($winery['WineMakers'])) ?></p>
		
		<?php
		break;
		}
		?>
		
		<?php if (strlen($winery['WineMakersChoice'])) { ?> 
		<p><strong>Winemaker's Choice:</strong><br />
		<?= $winery['WineMakersChoice'] ?></p>
		<? } ?>
		<?php if (strlen($winery['BestLCBOBrand'])) { ?> 
		<p><strong>Best LCBO Brand:</strong><br />
		<?= $winery['BestLCBOBrand'] ?></p>
		<? } ?>
		
		
		<p>
			<strong>Location:</strong><br />
			<?= $winery['Address'] ?><br/>
			<?= $winery['Town'] ?> <?= $winery['Province'] ?>
		</p>
		
		<p><a href="<?= $winery['GeoLocation'] ?>" target="googlemaps" class="googleMap">Google Map Link <span class="arrow">></span></a></p>
		
		<p>	
			<?php if (strlen($winery['Phone'])) { ?> 
			<?= $winery['Phone'] ?><br />
			<? } ?>
			
			<?php if (strlen($winery['Email'])) { ?> 
			<a href="mailto:<?= $winery['Email'] ?>"><?= $winery['Email'] ?> <span class="arrow">></span></a><br />
			<? } ?>
			
			
			<?php if (strlen($winery['Website'])) { ?> 
			<a href="<?= validURL($winery['Website']) ?>" target="externallink"><?= niceURL($winery['Website']) ?> <span class="arrow">></span></a>
			<? } ?>
		</p>
		
		
		<div class="clearer"></div>
	</div>    

	<div id="popCol2">
		<?php if (strlen($winery['Hours'])) { ?> 
		<p><strong>Hours:</strong><br />
		<?= str_replace("\r\n",'<br />',$winery['Hours']) ?></p>
		<? } ?>
		<?php if (strlen($winery['TourHours'])) { ?> 
		<p><strong>Tour Hours:</strong><br />
		<?= str_replace("\r\n",'<br />',$winery['TourHours']) ?></p>
		<? } ?>
		<div class="clearer"></div>	
	</div>
	
	
	<div id="popImages">
		<div class="clearer"></div>
	</div>
	
	<div class="clearer"></div>
</div>
  
  
</body>
</html>  
