<?php
require_once 'vars.php';
require_once 'getSetUID.php';
require_once 'function.textConversions.php';
require_once 'function.characterConversions.php';
connect2database();
$w = good_query_assoc("SELECT * FROM Wineries WHERE WineryID = " . $_GET['WineryID']);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="viewport" content="user-scalable=no, width=device-width" />
	<title><?= $w['Name'] ?></title>
	<base href="<?= HomePathWeb ?>" />
	<link href="css/reset.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/popup.css" rel="stylesheet" type="text/css" />	
	
</head>
<body>

<div id="popup">
	<div class="clearer"></div>
	<h1><?= $w['Name'] ?></h1>
	
	<div id="popCol1">		
		<p>
			<strong>Location:</strong><br />
			<?= $w['Address'] ?><br/>
			<?= $w['Town'] ?> <?= $w['Province'] ?>
		</p>	
		<p>	
			<?php if (strlen($w['Phone'])) { ?> 
			<?= $w['Phone'] ?><br />
			<? } ?>
			
<!--
			<?php if (strlen($w['Email'])) { ?> 
			<a href="mailto:<?= $w['Email'] ?>"><?= $w['Email'] ?> <span class="arrow">></span></a><br />
			<? } ?>
-->
			
			
			<?php if (strlen($w['Website'])) { ?> 
			<a href="<?= validURL($w['Website']) ?>" target="externallink"><?= niceURL($w['Website']) ?> <span class="arrow">></span></a>
			<? } ?>
		</p>
<!--
		<?php if (strlen($w['Hours'])) { ?> 
		<p><strong>Hours:</strong><br />
		<?= str_replace("\r\n",'<br />',$w['Hours']) ?></p>
		<? } ?>
-->
		
		<?php if (strlen($w['WCOURL'])) { 
			echo '<p><a href="'.$w['WCOURL'].'" target="_blank">';
			echo 'View on WineCountryOntario.ca';
			echo ' <span class="arrow">></span>';
			echo '</a></p>';
		} ?>
		

		
		
		<div class="clearer"></div>
	</div>    

	<div id="popCol2">
		<?php
		$numberofwinemakers = 0;
		if (strlen(trim($w['WineMakers'])))			$numberofwinemakers = 1;
		if (substr_count($w['WineMakers'],',') > 0)	$numberofwinemakers = substr_count($w['WineMakers'],',') + 1;
		switch ($numberofwinemakers) {
		case 0:
		// display nothing
		break;
		case 1:
		?>
		<p><strong><?= trim($w['WineMakers']) ?>, Winemaker</strong><br />
		<?php
		break;
		default:
		?>
		<p><strong><?= str_replace(',','<br />',trim($w['WineMakers'])) ?>, Winemakers:</strong><br />
		
		<?php
		break;
		}
		if (!empty($w['WineMakersEmail'])) {
			echo '<a href="mailto:'.$w['WineMakersEmail'].'">'. $w['WineMakersEmail'] .' <span class="arrow">></span></a><br />';
		}
		if (!empty($w['WineMakersPhone'])) {
			echo ''. $w['WineMakersPhone'] .'<br />';
		}
		
		?>
		</p>
	
	
		<?php
			if (!empty($w['GenMgrName'])) {
				echo '<p>';
				echo '<strong>'. $w['GenMgrName'].', General Manager</strong><br />';
				if (!empty($w['GenMgrEmail'])) {
					echo '<a href="mailto:'.$w['GenMgrEmail'].'">'. $w['GenMgrEmail'] .' <span class="arrow">></span></a><br />';
				}
				if (!empty($w['GenMgrPhone'])) {
					echo ''. $w['GenMgrPhone'] .'<br />';
				}
				echo '</p>';				
			}
		
			if (!empty($w['MktMgrName'])) {
				echo '<p>';
				echo '<strong>'. $w['MktMgrName'].', Marketing Manager</strong><br />';
				if (!empty($w['MktMgrEmail'])) {
					echo '<a href="mailto:'.$w['MktMgrEmail'].'">'. $w['MktMgrEmail'] .' <span class="arrow">></span></a><br />';
				}
				if (!empty($w['MktMgrPhone'])) {
					echo ''. $w['MktMgrPhone'] .'<br />';
				}
				echo '</p>';				
			}

			if (!empty($w['RetMgrName'])) {
				echo '<p>';
				echo '<strong>'. $w['RetMgrName'].', Retail Manager</strong><br />';
				if (!empty($w['RetMgrEmail'])) {
					echo '<a href="mailto:'.$w['RetMgrEmail'].'">'. $w['RetMgrEmail'] .' <span class="arrow">></span></a><br />';
				}
				if (!empty($w['RetMgrPhone'])) {
					echo ''. $w['RetMgrPhone'] .'<br />';
				}
				echo '</p>';				
			}

			if (!empty($w['PRName'])) {
				echo '<p>';
				echo '<strong>'. $w['PRName'].', Public Relations</strong><br />';
				if (!empty($w['PREmail'])) {
					echo '<a href="mailto:'.$w['PREmail'].'">'. $w['PREmail'] .' <span class="arrow">></span></a><br />';
				}
				if (!empty($w['PRPhone'])) {
					echo ''. $w['PRPhone'] .'<br />';
				}
				echo '</p>';				
			}

			if ((!empty($w['OtherTitle'])) || (!empty($w['OtherName']))) {
				echo '<p>';
				echo '<strong>';
				if (!empty($w['OtherName'])) {
					echo $w['GenMgrName'];
				}
				if ((!empty($w['OtherTitle'])) && (!empty($w['OtherName']))) {
					echo ', ';
				}
				if (!empty($w['OtherTitle'])) {
					echo $w['OtherTitle'];
				}
				if ((!empty($w['OtherTitle'])) || (!empty($w['OtherName']))) {				
					echo '</strong><br />';
				}
				if (!empty($w['OtherEmail'])) {
					echo '<a href="mailto:'.$w['OtherEmail'].'">'. $w['OtherEmail'] .' <span class="arrow">></span></a><br />';
				}
				if (!empty($w['OtherPhone'])) {
					echo ''. $w['OtherPhone'] .'<br />';
				}
				echo '</p>';				
			}

		
		
		?>
	
		<div class="clearer"></div>	
	</div>
	
	
</div>
</body>
</html>
