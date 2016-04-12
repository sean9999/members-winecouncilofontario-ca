<?php
require_once 'function.WriteChunks.php';
enable_chunks();
$c = getChunk($_GET['ChunkID']);
//new dBug($c);
//new dBug($_REQUEST);
//new dBug($_GET);
?>

<div class="pretty_table_wrapper">

<h2>Edit your Page</h2>

<form action="index.php?action=edit_chunk" method="post">
<input type="hidden" name="ChunkID" value="<?= $_GET['ChunkID'] ?>" />
<table class="pretty">
<?php
include 'chunk_tableRows.php';
?>
<tr>
	<td align="right" colspan="2">
	<!--
	<button type="button" onclick="toggleAllEditors()">RTF/HTML</button>
	-->
	<button type="reset" class="clear">Undo</button>
	<button type="submit">Save</button>
	</td>
</tr>
</table>

</form>

</div>