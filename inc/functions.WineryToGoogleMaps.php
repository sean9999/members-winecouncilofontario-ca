<?php
/** functions.parseGeo.php: various functions for parsing out useful data to be used in a google maps object
 * 
 * It accepts an associative array of data from the Wineries table.
 *
 * This function is very specific to WCO and may need to be rewritten in the future if applied to other types of input stings. It will break if it cannot find the variable sll in an array that looks like this: { http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=990+Closson+Road,+K0K+2J0&sll=43.952754,-77.445573&sspn=0.009709,0.00765&ie=UTF8&z=17&iwloc=A }. It is also worth noting that it expects to find the sll variable in the exact same spot sequentially.
 *
 * @param	$w:array	{ 1 record from the Wineries table }
 * @return	$o:string	{ usually a string. depends on the nature of the function }
*/

function getLongitude($w) {
	$latlong	= explode(',',getLatLong($w['GeoLocation']));
	$o			= $latlong[1];
	return $o;
}

function getLatitude($w) {
	$latlong	= explode(',',getLatLong($w['GeoLocation']));
	$o			= $latlong[0];
	return $o;
}

function getAddress($w) {
	$o			= 'No address found.';
	$gmapsURL	= explode('&',$w['GeoLocation']);
	foreach ($gmapsURL as $goog) {
		$g		= explode('=',$goog);
		if ($g[0] == 'q') {
			$o	= urldecode($g[1]);
		}
	}
	return $o;
}

function getTitle($w) {
	$o			= $w['Name'] . ' (' . $w['WineryNumber'] . ')';
	return $o;
}

function createMarkerInfo($w) {
	$RegionName = good_query_value("SELECT Name FROM Regions WHERE RegionID = " . $w['RegionID']);
	$friendly_RegionName = $RegionName;
	$friendly_RegionName = str_replace(' ','_',trim($friendly_RegionName));
	$friendly_RegionName = str_replace('','-',trim($friendly_RegionName));
	$titletag	= '<a target="ext" href="http://'.$w['Website'].'"><strong>'.$w['Name'].'</strong></a>';
	$imagetag	= '<img height="115" src="/content/wineries/'.$friendly_RegionName.'/'.$w['SmallImage1'].'" alt="'.$w['Name'].'" />';
	$addrtag	= $w['Address'] . '<br />' . $w['Town'] . '<br />' . $w['Phone'] . '<br />';
	$o			= $titletag . '<br />' . $imagetag . '<br />' . $addrtag;
	return $o;
}

function getLatLong($i) {
	// a helper function for getLongitude() and getLatitude()
	try {
	$g			    = explode('&',$i);
	$coordsarray	= explode('=',$g[5]);
	$coords 		= $coordsarray[1];
	$o				= $coords;
	} catch (Exception $e) {
	$o				= 'ERROR: ' . $e->getMessage();
	}
	return $o;
}
?>