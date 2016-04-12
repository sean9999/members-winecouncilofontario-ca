<?php
// GLOBAL VARIABLES AND CONSTANTS FOR MEMBERS.WINECOUNCILOFONTARIO.CA ON SJCCLOUD
// Framework	by	gourdisgood.com
if ($_SERVER['SCRIPT_NAME'] == '/vars.php') exit();
//require_once '/var/www/admin.winesofontario.org/frameworks/vars_council.php';

//tmp for now:
//$UserID = 99;

// db
define("DB_SERVER",			"localhost");
define("DB_USER",			"c1wco3");
define("DB_PASSWORD",		"C3lrrMFYeH");
define("DB_DB",				"c1wco3");

//chunks
define('Chunks_User',		'WCO');
define('Chunks_Project',	'WCO_Members');
define('Chunks_Password',	'78fAzg0QsY0Aw_chunks');

define('Chunks_db_host',	"localhost");
define('Chunks_db_user',	'c1chunksusr');
define('Chunks_db_pass',	"VUqEmN2casuSc624");
define('Chunks_db',			'c1chunksdb');
define('Chunks_Stratum',	0);
define('ProjectID',			2);

// site stuff
define('SITE_INC','/var/www/members.winecouncilofontario.ca/inc/');
define('CHC_INC','/var/www/admin.winesofontario.org/frameworks/chc3b/');
set_include_path(get_include_path() . PATH_SEPARATOR . SITE_INC . PATH_SEPARATOR . CHC_INC);
define('DEBUG','Off');		// change this to 'Off' when site is in production for best performance.
//if 	  (DEBUG == 'On') 		include_once 'dBug.php';
define('HomePathLocal',		'/var/www/members.winecouncilofontario.ca/web/');
define('HomePathWeb',		'http://members.winesofontario.org/');
define('PathToTinyMCE',		'/lib/tinymce/jscripts/tiny_mce/');
define('PathToImageManager', PathToTinyMCE.'plugins/imagemanager/');
define('WineryImagesPath',	'content/wineries/');
define('DownloadsPath',		'content/eblasts/');
define('EventsBannerPath',	'content/events/banners/');


//define('EVENTS_EMAIL_RECEIVER',	'reginafoisey@gmail.com');
define('EVENTS_EMAIL_RECEIVER',	'alison@winecouncilofontario.ca');
define('EVENTS_EMAIL_SENDER',	'info@winesofontario.org');
//define('EMAIL_RECEIVER', 		'reginafoisey@gmail.com');
define('EMAIL_RECEIVER', 		'alison@winecouncilofontario.ca');
define('EMAIL_SENDER', 			'info@winecouncilofontario.ca');
define('EMAIL_DEV',				'adam.clarke@stjoseph.com');

//	values used in debugging
//	define('EMAIL_RECEIVER', 'regina.foisey@winesofontario.org');
//	define('EMAIL_RECEIVER', 'sean.r.macdonald@gmail.com');
//	define('EMAIL_RECEIVER', 'reginafoisey@gmail.com');
//	define('EMAIL_RECEIVER', 'aniestroj@gmail.com');
//	define('EVENTS_EMAIL_RECEIVER',	'regina.foisey@winesofontario.org');

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


$MASTER_TIME_STAMP = mktime(date('H'),date('i'),date('s'),date('n'),date('j'),date('Y'));
?>
