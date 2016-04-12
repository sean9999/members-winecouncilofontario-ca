<?php

require_once '../../vars.php';
require_once 'function.WriteChunks.php';
enable_chunks();

?>

<div class="pretty_table_wrapper">

<h2>Add a Page</h2>

<form action="index.php?action=add_chunk" method="post">

<table class="pretty">
<?php
$c = array();
$c['Language']	= 'en';	// deafult language
$c['Stratum']	= 1;	// default to "beta"
include 'chunk_tableRows.php';
?>
<tr>
	<td align="right" colspan="2">
	<button type="reset" class="clear">reset</button>
	<button type="submit">add it!</button>
	</td>
</tr>
</table>

</form>

</div>