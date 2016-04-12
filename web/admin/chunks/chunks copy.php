<?php
enable_chunks();
$progenitors	= getProgenitors();
$vagabonds		= getVagabonds();
//new dBug($chunks);
?>

<div class="pretty_table_wrapper">
	<h2>Progenitors</h2>
	<table class="pretty">
		<thead>
		<tr>
			<th width="20">ID</th>
			<th>TITLE</th>
			<th width="30"><!-- EDIT --></th>
			<th width="30"><!--	DELETE	--></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($progenitors as $p) {
		echo '<tr>';
		echo '	<td>' . $p['ChunkID'] . '</td>';
		echo '	<td>' . $p['Title'] . '</td>';
		echo '	<td><a href="/admin/chunks/?view=chunk&ChunkID='.$p['ChunkID'].'">EDIT</a></td>';
		echo '	<td><a href="javascript:deleteChunk('.$p['ChunkID'].')">DELETE</a></td>';
		echo '</tr>';
		}
		?>	
		</tbody>
		<tfoot>
		<tr>
			<td colspan="4"></td>
		</tr>
		</tfoot>
	</table>
</div>

<div class="pretty_table_wrapper">
	<h2>Vagabonds</h2>
	<table class="pretty">
		<thead>
		<tr>
			<th width="20">ID</th>
			<th>TITLE</th>
			<th width="30"><!-- EDIT --></th>
			<th width="30"><!--	DELETE	--></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($vagabonds as $p) {
		echo '<tr>';
		echo '	<td>' . $p['ChunkID'] . '</td>';
		echo '	<td>' . $p['Title'] . '</td>';
		echo '	<td><a href="/admin/chunks/?view=chunk&ChunkID='.$p['ChunkID'].'">EDIT</a></td>';
		echo '	<td><a href="javascript:deleteChunk('.$p['ChunkID'].')">DELETE</a></td>';
		echo '</tr>';
		}
		?>	
		</tbody>
		<tfoot>
		<tr>
			<td colspan="4"></td>
		</tr>
		</tfoot>
	</table>
</div>