<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'account';
$section_title	= $self;
instantiate_header ();
$header -> body_id = 'home';
include 'header.php';
?>

<div class="clearer"></div>


<div id="mainNav">
</div>

<div id="mainContent">

<div id="Content">

<h1>Please Login</h1>
	
<table class="form">
	<tr>
		<td class="left">
			Email:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Password:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			<button class="submit">Submit</button>
		</td>
	</tr>
	
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			Don't have an account? <a href="/account-create.php" class="bold">Apply Now!</a><br />
			Forgot your password? <a href="#" class="bold">Reset Password</a>
		</td>
	</tr>

</table>
	
<div id="rightNav">
<div class="clearer"></div>
</div>

<div class="clearer"></div>
</div>

<div class="clearer"></div>
</div>

<?php include 'footer.php'; ?>