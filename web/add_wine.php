<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'wines';
$section_title	= $self;

include '../inc/checkLogin.php';

instantiate_header ();
$header -> body_id = 'wines';
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

<?php if ($S['IsMember'] > 0) { ?>
	<h1>
	<?php
		enable_chunks();
		$chunk = getChunkByName('Your Wines');
		echo $chunk['Title'];
	?>
	</h1>

	<?php 	
			echo $chunk['Content'];
			
			connect2database();
			
			$wine = array();
	?>
	<div class="clearer"></div>
	
	<form name="new_user" action="wines.php?action=create_wine" method="post">
	<table class="form">
		<?php include 'wine_fields.php';?>
		<tr>
			<td class="left">
				
			</td>
			<td class="right">
				<button type="submit" name="save" class="submit right">Add a Wine</button>
			</td>
		</tr>
		
	
	</table>
	</form>
	
	<div class="clearer"></div>	
	
<?php
	}
	else
	{
	echo '<p>You must be a Wines of Ontario member to view this page.</p>';
	}
?>
	
	
	
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