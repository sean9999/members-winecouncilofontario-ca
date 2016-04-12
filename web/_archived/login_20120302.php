<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'account';
$section_title	= $self;
$page_title		= 'Please Login';


if(isset($_GET['logout']))
{
	unset($_SESSION['userID']);
	session_destroy();
}

session_start();

instantiate_header ();
$header -> body_id = 'home';
$header->addjs('login.js');
include 'header.php';

$message = '';

//Handle incoming $_POST info 
if(isset($_POST['FormLogin']))
{
	connect2database();
	$result = good_query_assoc("SELECT * FROM Users WHERE Email = '" . $_POST['email']."' AND Password = '" . $_POST['password'] . "'");
	if ($result) {
		$winery	= good_query_assoc("SELECT * FROM Wineries WHERE WineryID = " . $result['WineryID']);
	}
	
	if($result)
	{
		if($result['Approved'] == 'False')
		{
			$message = 'Login Failed: Account has not yet been approved.';
		}
		else 
		{
			//session_start();
			$S['userID'] 	= (int) 	$result['UserID'];
			$S['WineryID']	= (int)		$result['WineryID'];
			$S['Name']		= (string)	$result['Name'];
			$S['IsMember']	= (int) 	$winery['IsMember'];
			
			$_SESSION = $S;
			
			echo "<script>window.location = 'index.php'</script>";
		}
	}
	else 
	{
		$message = 'Login Failed: Invalid email/password combination.';
	}
}

?>

<div class="clearer"></div>


<div id="mainNav">
</div>

<div id="mainContent">

<div id="Content">

<h1>Please Login</h1>
<p class="message"><?php echo $message; ?></p>
<form name="login" method="post" action="login.php" onsubmit="return validateForm(this);">
<input type="hidden" name="FormLogin" value="True"/>	
<table class="form">
	<tr>
		<td class="left">
			Email:
		</td>
		<td class="right">
			<input type="text" name="email" id="#" value="" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Password:
		</td>
		<td class="right">
			<input type="password" name="password" id="#" value="" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			<button type="submit" class="submit">Submit</button>
		</td>
	</tr>
	
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			Don't have an account? <a href="/account-create.php" class="bold">Apply Now!</a><br />
			Forgot your password? <a href="/reset_password.php" class="bold">Reset Password</a>
		</td>
	</tr>

</table>
</form>	
<div id="rightNav">
<div class="clearer"></div>
</div>

<div class="clearer"></div>
</div>

<div class="clearer"></div>
</div>

<?php include 'footer.php'; ?>