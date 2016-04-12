<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'account';
$section_title	= $self;

instantiate_header ();
$header -> body_id = 'home';
$header->addjs('account-create.js');
include 'header.php';

//Handle incoming $_POST info 
if(isset($_POST['FormAccount']))
{
	connect2database();	
	
	$result = good_query_assoc("SELECT UserID FROM Users WHERE Email = '" . $_POST['email'] ."'");
	
	if($result)
	{
		echo "<script>alert('Account Creation Failed: Duplicate Email Address')</script>";
	}
	else
	{ 
	
		$P = cleanForDB($_POST);
	
		//	send the admin an email
		include('Mail.php');
		include('Mail/mime.php');
		require_once 'function.characterConversions.php';
		$sujet	= 'A new user has applied to Members.';
		$mailbody = 'A new user has applied to the system to members.winesofontario.org. ' . $P['name'] . ' - ' . $P['email'];		
		$crlf	= "\n";
		$hdrs	= array('From' => EMAIL_SENDER,'Subject' 	=> $sujet);
		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($mailbody);
		$mime->setHTMLBody($mailbody);
		$body	= $mime->get();
		$hdrs	= $mime->headers($hdrs);
		$mail 	=& Mail::factory('mail');
		$mail->send(EMAIL_RECEIVER, $hdrs, $body);
		//	send email
		
	    $pwd = md5(trim($P['Password']));
		good_query("INSERT INTO Users (Name, Title, Email, Password, WineryID, Notes, ztamp) VALUES ('" . $P['name'] . "', '" . $P['title'] . "', '" . $P['email'] . "', '" . $P['password'] . "', " . $P['wineryID'] . ", '" . $P['notes'] . "', NOW())");
		echo "<script>window.location = 'account-create-thanks.php'</script>";
	}
}

?>

<div class="clearer"></div>


<div id="mainNav">
</div>

<div id="mainContent">

<div id="Content">

<h1>	
	<?php
		enable_chunks();
		$chunk = getChunkByName('Sign-up page');
		echo $chunk['Title'];
	?>
</h1>
	<?php 	
		echo $chunk['Content'];
	?>

<form name="account-create" method="post" action="account-create.php" onsubmit="return validateForm(this);">
<input type="hidden" name="FormAccount" value="True" />
<table class="form">
	<tr>
		<td class="left">
			Name:
		</td>
		<td class="right">
			<input type="text" name="name" id="#" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Title:
		</td>
		<td class="right">
			<input type="text" name="title" id="#" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>" width="50" />
		</td>
	</tr>	
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
			Re-enter Password:
		</td>
		<td class="right">
			<input type="password" name="password2" id="#" value="" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			Winery:
		</td>
		<td class="right">
			<?php
			connect2database ();
			$wineries = good_query_table("SELECT * FROM Wineries ORDER BY Name" );
			//$wineries = good_query_table("SELECT * FROM Wineries" );
			?>
			<select name="wineryID">
				<option value=""> - Select Your Winery - </option>
				<?php
				foreach ($wineries as $w) {
				echo '<option value="';
				echo $w['WineryID'];
				if(isset($_POST['wineryID']) && ($w['WineryID'] == $_POST['wineryID']))
					echo '" selected="selected">';
				else
					echo '">';
				echo $w['Name'];
				echo '</option>';
				}
				?>
			</select>
		</td>
	</tr>	
	<tr>
		<td class="left">
			Notes:
		</td>
		<td class="right">
			<textarea name="notes" id="#" cols="50" rows="5"></textarea>
		</td>
	</tr>
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			<button type="submit" class="submit">Submit</button>
		</td>
	</tr>
	

</table>
</form>
</div>
	
<div id="rightNav">
<div class="clearer"></div>
</div>
<div class="clearer"></div>
</div>
<?php include 'footer.php'; ?>