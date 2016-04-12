<?php
require_once 'vars.php';
if (isset($action)) require_once 'actions.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'account';
$section_title	= $self;

instantiate_header();
$header->body_id = 'home';
include 'header.php';

?>

<div class="clearer"></div>

<div id="mainNav"></div>

	<div id="mainContent">
		<div id="Content">

		<h1>Please enter your email to reset your password</h1>	
		<p class="message"><?php echo $message; ?></p>
		<form name="reset" method="post" action="reset_password.php?action=reset_password">
		<table class="form">
		<tr>
			<td class="left">Email:</td>
			<td class="right"><input type="text" name="email" id="email" width="50" /></td>
		</tr>
		<tr>
			<td class="left"></td>
			<td class="right"><button type="submit" class="submit">Submit</button></td>
		</tr>
		</table>
		</form>
		
			<div id="rightNav">
				<div class="clearer"></div>
			</div>
			<div class="clearer"></div>
		
		</div>

<div class="clearer"></div>

</div>	<!--	WTF? extra div	-->

<?php include 'footer.php'; ?>