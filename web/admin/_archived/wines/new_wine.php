<?php 
$wine = array();
?>

<form name="new_user" action="?action=create_wine" method="post">
	<div class="pretty_table_wrapper">
		<h1>add a wine</h1>
		<table class="pretty" cellpadding="0" cellspacing="0">
			<?php 
				include 'wine_fields.php';
			?>
			<tr>
				<td colspan="2" align="right">
				<button type="reset" class="clear">Clear</button>
				<button type="submit" >Add the Wine</button>
				</td>
			</tr>
		</table>
	</div>
</form>