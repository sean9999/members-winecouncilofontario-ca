<?php 
$bottle = array();
?>

<form name="new_user" action="?action=create_bottle" method="post">
	<div class="pretty_table_wrapper">
		<h1>add a bottle</h1>
		<table class="pretty" cellpadding="0" cellspacing="0">
			<?php 
				include 'bottle_fields.php';
			?>
			<tr>
				<td colspan="2" align="right">
				<button type="reset" class="clear">Clear</button>
				<button type="submit" >Add the Bottle</button>
				</td>
			</tr>
		</table>
	</div>
</form>