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
<?php
include 'side_links/mainNav.php';
?>
</div>

<div id="mainContent">

<div id="Content">

<h1>Keep your account up-to-date</h1>

<table class="form">
	<tr>
		<td class="left">
			Name:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Title:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>	
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
			
		</td>
		<td class="right">
			<button class="cancel">Cancel</button>
			<button class="submit">Save</button>
		</td>
	</tr>
</table>

<h2>Additional Options</h2>
<ul>
<li><a href="#" class="bold">Update Password</a></li>
<li><a href="/winery-edit.php" class="bold">Change Your Winery Information</a></li>
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