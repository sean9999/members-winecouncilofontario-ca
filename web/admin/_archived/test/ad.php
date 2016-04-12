<?php
connect2database();
require_once 'function.characterConversions.php';
require_once 'function.readChunks.php';

$G			= cleanForDB($_GET);
$thing = good_query_assoc("SELECT * FROM TestTable WHERE testID = " . $G['testID']);

?>

<form method="post" action="?action=update_thing">
	<div class="pretty_table_wrapper">
		<table class="chunktable pretty" cellpadding="0" cellspacing="0">
			<?php 
				include 'ad_fields.php';
			?>
			<tr>
				<td colspan="2" align="right">
					<button type="reset" name="reset" class="clear">Reset</button>
					<button type="submit" name="save">Submit</button>
				</td>
			</tr>
		</table>
	</div>
</form>


