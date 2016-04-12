<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'account';
$section_title	= $self;

include '../inc/checkLogin.php';

//Handle incoming $_POST info 
if(isset($_POST['FormPasswordUpdate']))
{
	connect2database();	
		
	if($_POST['oldPassword'] == $userData['Password'])
	{
		good_query("UPDATE Users SET Password = '" . $_POST['password'] . "' WHERE UserID = $userData[UserID]");
		echo "<script>alert('Password Change Successful')</script>";
		echo "<script>window.location = 'account.php'</script>";
	}
	else
	{
		echo "<script>alert('Password Change Failed: Password was incorrect.')</script>";	
	}
}

instantiate_header ();
$header -> body_id = 'home';
$header->addjs('account-password.js');
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

<h1>Update Password</h1>

<form name="password-update" method="post" action="account-password.php" onsubmit="return validateForm(this);">
<input type="hidden" name="FormPasswordUpdate" value="true" />
<input type="hidden" name="userID" value="<?php echo $userData['UserID']; ?>" />
<table class="form">
	<tr>
		<td class="left">
			Old Password:
		</td>
		<td class="right">
			<input type="password" name="oldPassword" id="#" value="" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			New Password:
		</td>
		<td class="right">
			<input type="password" name="password" id="#" value="" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			Re-enter New Password:
		</td>
		<td class="right">
			<input type="password" name="password2" id="#" value="" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			<button type="submit" class="submit">Save</button>
			<button type="button" class="cancel" onclick="javascript: window.location = 'account.php';">Cancel</button>
		</td>
	</tr>
</table>
</form>

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