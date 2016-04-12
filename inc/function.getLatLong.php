<?php
/**
 * parse out longitude / langitude from a google-maps URL
 *
 * Take a URL like this:
 * http://maps.google.com/maps?q=20+Bees+Winery&hl=en&cd=1&ei=ytYTTNmtJqHUyQTLrIjAAQ&sll=43.212236,-79.135208&sspn=0.014639,0.016916&ie=UTF8&view=map&cid=1780647175706330232&ved=0CEUQpQY&hq=20+Bees+Winery&hnear=&ll=43.206607,-79.142257&spn=0.009994,0.013272&z=17&iwloc=A
 * ...and return "43.212236,-79.135208"
 *
 * @param	$i:string
 * @return	$o:string
*/

function parseGoogleMapURL($url) {
	$o = array();
	$bits = explode('?',$url);
	$o['URL'] = $bits[0];
	$args = explode('&',$bits[1]);
	foreach ($args as $arg) {
		$varval = explode('=',$arg);
		$var = $varval[0];
		$val = $varval[1];
		$o['args'][$var] = $val;
	}
	return $o;
}


function getLatLong($i) {
	$o = '';
	$g = parseGoogleMapURL($i);
	$o = $g['args']['sll'];
	if (!strlen($o)) $o = $g['args']['ll'];
	return $o;
}


function getLangLong($i) {
	//	this is old and buggy and breaks.
	//	Also, it contains a spelling mistake.
	//	Langitude?
	//	How embarassing!
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