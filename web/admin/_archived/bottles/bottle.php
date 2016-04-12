<?php
connect2database();
require_once 'function.characterConversions.php';
require_once 'function.readChunks.php';

$G			= cleanForDB($_GET);
$bottle = good_query_assoc("SELECT * FROM Bottles WHERE BottleID = " . $G['BottleID']);

?>

<form method="post" action="?action=update_bottle">
	<div class="pretty_table_wrapper">
		<table class="pretty" cellpadding="0" cellspacing="0">
			<?php 
				include 'bottle_fields.php';
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
</div>


