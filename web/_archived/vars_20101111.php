<?php
// GLOBAL VARIABLES AND CONSTANTS FOR wcomembers.pimediastaging.com
// Framework	by	crazyHorseCoding.com
// Licenced		to	PiMedia.com
// Design		by	SobuleDesign.com
if ($_SERVER['SCRIPT_NAME'] == '/vars.php') exit();

//tmp for now:
//$UserID = 99;

// db
define("DB_SERVER",			"internal-db.s26279.gridserver.com");
define("DB_USER",			"db26279_wco");
define("DB_PASSWORD",		"78fAzg0QsY0Aw");
define("DB_DB",				"db26279_wco");

//chunks
define('Chunks_User',		'WCO');
define('Chunks_Project',	'WCO_Members');
define('Chunks_Password',	'78fAzg0QsY0Aw_chunks');
define('Chunks_db_host',	'internal-db.s26279.gridserver.com');
define('Chunks_db_user',	'db26279_wco');
define('Chunks_db_pass',	'78fAzg0QsY0Aw');
define('Chunks_db',			'db26279_Chunks');
define('Chunks_Stratum',	0);

// site stuff
define('SITE_INC','/home/26279/domains/wcomembers.pimediastaging.com/inc/');
define('CHC_INC','/home/26279/domains/pimediastaging.com/frameworks/chc3/');
set_include_path(get_include_path() . PATH_SEPARATOR . SITE_INC . PATH_SEPARATOR . CHC_INC);
define('DEBUG','On');		// change this to 'Off' when site is in production for best performance.
if 	  (DEBUG == 'On') 		include_once 'dBug.php';
define('HomePathLocal',		'/home/26279/domains/wcomembers.pimediastaging.com/html/');
define('HomePathWeb',		'http://wcomembers.pimediastaging.com/');
define('PathToTinyMCE',		'/admin/tinymce/jscripts/tiny_mce/');
define('PathToImageManager',PathToTinyMCE.'plugins/imagemanager/');
define('WineryImagesPath',	'content/wineries/');
define('DownloadsPath',		'content/downloads/');
define('EventsBannerPath',	'content/events/banners/');

/*
// google :: http://code.google.com/apis/ajaxsearch/signup.html
define('GoogleAPIKey', 'ABQIAAAADJDWbORKG_WlrYdMmJ4AHBSOFPvGywZw_-xxecJrRzdp1N3TbRR0JFTTlUkktF9_1CI1jKsfUzY8VA');
*/

//define('EVENTS_EMAIL_RECEIVER','aniestroj@gmail.com');

define('EVENTS_EMAIL_RECEIVER','sean@crazyhorsecoding.com');
define('EVENTS_EMAIL_SENDER','events@wcomembers.pimediastaging.com');

define('EMAIL_RECEIVER', 'sean@crazyhorsecoding.com');
define('EMAIL_SENDER', 'info@wcomembers.pimediastaging.com');

define('EMAIL_DEV','seant@crazyhorsecoding.com');

//	session
require_once 'functions.global.php';
$action = localize('action');
session_start();
$S = $_SESSION;

/*
//	language
if (isset($_COOKIE['lang'])) $lang = $_COOKIE['lang'];
if (isset($_GET['lang'])) {
	$cookie_length_in_days	= 100;
	$cookie_expire			= time() + (60 * 60 * 24 * $cookie_length_in_days);
	$lang					= $_GET['lang'];
	setcookie('lang',$lang,$cookie_expire);
}
if (!isset($lang)) $lang	= 'en';

*/

//	user agent detection
if (!isset($S['Browser'])) {
	$uaobj	= getUserAgent();
	$ua		= get_object_vars($uaobj);
	$S['Browser']['Name']			= (string)	$ua['Browser'];
	$S['Browser']['MajorVersion']	= (string)	$ua['MajorVer'];
	$S['Browser']['MinorVersion']	= (string)	$ua['MinorVer'];
	require_once 'function.isMobile.php';	
	$S['Browser']['IsMobile']		= (bool) isMobile();
	if ($ua['Browser'] == 'IE' && $ua['MajorVer'] == 6)	$S['Browser']['IsIE6']	= true;
	else 												$S['Browser']['IsIE6']	= false;
}
if (isset($S['Browser']['IsMobile']) && $S['Browser']['IsMobile'])	$is_mobile	= true;
else 																$is_mobile	= false;


?>