<?php
require_once 'vars.php';

$address = getAddress();

$pieces = explode('/',$address);

switch (sizeof($pieces)) {

	case 0:
	echo 'WTF! zero?';
	break;
	
	case 1:		//	region
	$address = trim($address,'/');
	connect2database();
	$region = good_query_assoc("SELECT * FROM Regions WHERE SEOName = '$address'");
	if (sizeof($region) > 1) {
		$RegionID = $region['RegionID'];
		include 'region.php';
	} else {
		include 'showchunk.php';
	}
	break;

	case 2:		// winery
	$RegionSEOName		= trim($pieces[0],'/');
	$WinerySEOName		= trim($pieces[1],'/');
	connect2database();
	//$winery	= good_query_assoc("SELECT * FROM Wineries WHERE WineryID = $WineryID OR SEOName = '$WinerySEOName'");
	$winery = array();
	if (sizeof($winery) > 1) {
		$designer			= good_query_assoc("SELECT *, CONCAT_WS(' ',FirstName,LastName) AS Name FROM Designers WHERE DesignerID = $collection[DesignerID]");
		$DesignerSEOName	= $designer['SEOName'];
		$DesignerName		= $designer['Name'];
		$DesignerID			= $desginer['DesignerID'];
		$section_id 		= 'collection';
		include 'collection.php';
	} else {
		include 'showchunk.php';
	}
	break;

	case 3:
	
	if ($pieces[2] == 'Sand-Cast') {
		//	Collection that is Sand-Cast
		$DesignerSEOName	= $pieces[0];
		$CollectionSEOName	= $pieces[1];
		$CastType			= 'Sand';
		$CollectionID		= (int) localize('CollectionID');
		connect2database();
		$collection			= good_query_assoc("SELECT * FROM Collections WHERE CollectionID = $CollectionID OR SEOName = '$CollectionSEOName' AND Name LIKE '%Sand-Cast%'");
		if (sizeof($collection) > 1) {
			$designer		= good_query_assoc("SELECT *, CONCAT_WS(' ',FirstName,LastName) AS Name FROM Designers WHERE DesignerID = $collection[DesignerID]");
			$DesignerSEOName= $designer['SEOName'];
			$DesignerName	= $designer['Name'];
			$DesignerID		= $desginer['DesignerID'];
			$section_id 	= 'collection';
			include 'collection.php';
		}
	} else {
		//	Product	
		$DesignerSEOName	= $pieces[0];
		$CollectionSEOName	= $pieces[1];
		$ProductSEOName		= $pieces[2];
		//$ItemID			= $pieces[3];
		$ProductID			= (int) localize('ProductID');
		connect2database();
		$product = good_query_assoc("SELECT * FROM Products WHERE ProductID = $ProductID OR SEOName = '$ProductSEOName' LIMIT 1");
		if (sizeof($product) > 1) {
			$ProductID		= (int) $product['ProductID'];
			$CollectionID	= (int) $product['CollectionID'];
			$section_id 	= 'product';
			include 'product.php';
		} else {
			include 'showchunk.php';
		}
	}
	break;

	case 4:		//	Product with SKU
	//echo '<p>case 4</p>';
	$CastType = 'Aluminum Die';
	if ($pieces[3] == 'Sand-Cast') 	$CastType 	= 'Sand';
	//else							$ItemID		= $pieces[3];
	$DesignerSEOName	= $pieces[0];
	$CollectionSEOName	= $pieces[1];
	$ProductSEOName		= $pieces[2];
	$ItemID				= $pieces[3];
	$ProductID			= (int) localize('ProductID');
	connect2database();
	$product = good_query_assoc("SELECT * FROM Products WHERE ProductID = $ProductID OR SEOName = '$ProductSEOName' AND CastType = '$CastType' LIMIT 1");
	//new dBug($product);
	if (sizeof($product) > 1) {
		$ProductID		= (int) $product['ProductID'];
		$CollectionID	= (int) $product['CollectionID'];
		$section_id 	= 'product';
		include 'product.php';
	} else {
		include 'showchunk.php';
	}
	break;
	
	case 5:
	//echo '<p>case 5</p>';
	$CastType = 'Aluminum Die';
	if ($pieces[4] == 'Sand-Cast') 	$CastType 	= 'Sand';
	else							$ItemID		= $pieces[3];
	$DesignerSEOName	= $pieces[0];
	$CollectionSEOName	= $pieces[1];
	$ProductSEOName		= $pieces[2];
	$ItemID				= $pieces[3];
	$ProductID			= (int) localize('ProductID');
	connect2database();
	$product = good_query_assoc("SELECT * FROM Products WHERE ProductID = $ProductID OR SEOName = '$ProductSEOName' AND CastType = '$CastType' LIMIT 1");
	if (sizeof($product) > 1) {
		$ProductID		= (int) $product['ProductID'];
		$CollectionID	= (int) $product['CollectionID'];
		$section_id 	= 'product';
		include 'product.php';
	} else {
		include 'showchunk.php';
	}
	break;
	
	default:
	$message = 'Too many SEO Tokens: ' . sizeof($pieces);
	break;

}

?>