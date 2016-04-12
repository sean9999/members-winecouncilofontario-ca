<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'account';
$section_title	= $self;

include '../inc/checkLogin.php';

$tempEmail = $userData['Email'];

$message = '';

//Handle incoming $_POST info 
if(isset($_POST['FormAccountUpdate']))
{
	connect2database();	
	
	$emailUser = good_query_assoc("SELECT UserID FROM Users WHERE Email = '" . $_POST['email'] . "'");

	if(isset($emailUser['UserID']) && $emailUser['UserID'] != $userData['UserID'])
	{
		$message = 'Account update failed: email address in use by another user.';
	}
	else
	{
		good_query("UPDATE Users SET Name = '" . $_POST['name'] . "', Title = '" . $_POST['title'] . "', Email = '" . $_POST['email'] . "', ztamp = NOW() WHERE UserID = " . $userData['UserID']);
		
		$tempEmail = $_POST['email'];

		$message = 'Account updated.';
	}
}


instantiate_header ();
$header -> body_id = 'home';
$header->addjs('account.js');
include 'header.php';

?>

<div class="clearer"></div>


<div id="mainNav">
<?php
include 'side_links/mainNav.php';
?>
</div>

<div id="mainContent">

<div id="Content">

<h1>Keep your account up-to-date</h1>
<p class="message"><?php echo $message;?></p>
<form name="account-update" method="post" action="account.php" onsubmit="return validateForm(this);">
<input type="hidden" name="FormAccountUpdate" value="true" />
<input type="hidden" name="userID" value="<?php echo $userData['UserID']; ?>" />
<table class="form">
	<tr>
		<td class="left">
			Name:
		</td>
		<td class="right">
			<input type="text" name="name" id="#" value="<?php echo $userData['Name']; ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Title:
		</td>
		<td class="right">
			<input type="text" name="title" id="#" value="<?php echo $userData['Title']; ?>" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			Email:
		</td>
		<td class="right">
			<input type="text" name="email" id="#" value="<?php echo $tempEmail; ?>" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			<button type="submit" class="submit">Save</button>
			<button type="button" class="cancel">Cancel</button>
		</td>
	</tr>
</table>
</form>
<?php
		echo '<p>You are a: <strong>';
		echo $userData['UserLevel'];
		echo '</strong>.</p>';
		
		if ($userData['UserLevel'] == 'Owner') {
			echo '<p>You can see this</p>';
		} elseif ($userData['UserLevel'] == 'Employee') {
			echo '<p>You cannot see this</p>';
		}

?>

<h2>Additional Options</h2>
<ul>
<li><a href="/account-password.php" class="bold">Update Password</a></li>
<?php if ($S['IsMember'] > 0) { ?>
<li><a href="/winery-edit.php" class="bold">Change Your Winery Information</a></li>
<?php
	}
?>

</ul>

</div>
	
<div id="rightNav">
	<?php 
		include 'right_links/main.php'; 
	?>
<div class="clearer"></div>
</div>
<div class="clearer"></div>
</div>
<?php include 'footer.php'; ?>