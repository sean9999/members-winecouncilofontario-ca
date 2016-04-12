<?php 
$ad = array();
?>

<form name="new_user" action="?action=create_thing" method="post">
	<div class="pretty_table_wrapper">
		<h1>add an ad</h1>
		<table class="chunktable pretty" cellpadding="0" cellspacing="0">
			<?php 
				include 'ad_fields_new.php';
			?>
			<tr>
				<td colspan="2" align="right">
				<button type="reset" class="clear">Clear</button>
				<button type="submit" >Add the Ad</button>
				</td>
			</tr>
		</table>
	</div>
</form>