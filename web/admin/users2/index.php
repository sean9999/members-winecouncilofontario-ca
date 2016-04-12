<?php
require_once '../../vars.php';
if (isset($action)) require_once 'actions.php';

$section_title = 'Users';
require_once 'resolvePageVariables.php';

$tabs = <<<BLOCK
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	$(".tab_content").hide();							//Hide all content
	$("ul.tabs li:first").addClass("active").show();	//Activate first tab
	$(".tab_content:first").show();						//Show first tab content
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); 			//Remove any "active" class
		$(this).addClass("active"); 					//Add "active" class to selected tab
		$(".tab_content").hide(); 						//Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); 							//Fade in the active ID content
		return false;
	});
});
</script>
BLOCK;

$del_user = <<<BLOCK
<script type="text/javascript">
function deleteUser(UserID) {
	if (confirm('Are you sure?')) location.href = '?action=delete_user&UserID=' + UserID;
}
</script>
BLOCK;

$view = localize('view');

if ($view == '' || $view == 'index') $view = 'users';

switch ($view) {

	case 'users':
	$extra_header_content = $tabs . $del_user;
	include '../header.php';
//	echo '<h1>'.DB_USER.'</h1>';
	echo '	<ul class="tabs">
			<li><a href="#tabOne">Users</a></li>
			<li><a href="#tabTwo">Add a User</a></li>
			</ul>
			<div class="tab_container">
		    <div id="tabOne" class="tab_content">
	';
	include 'users.php';
	echo	'	</div>
				<div id="tabTwo" class="tab_content">
	';
	echo '<hr />';
	include 'add_user.php';
	echo '	</div>
			</div>
			<div class="clearer"></div>
	';
	
	include '../footer.php';	
	break;
	
	case 'user':
	connect2database();
	$G		= cleanForDB($_GET);
	$user	= good_query_assoc("SELECT * FROM Users WHERE UserID = $G[UserID]");
	$page_title = $user['FirstName'] . ' ' . $user['LastName'];
	include '../header.php';
	include 'user.php';
	include '../footer.php';
	break;
	
	default:
	$page_title = $view;

	
	include '../header.php';
	include $view . '.php';
	include '../footer.php';
	break;

}
?>