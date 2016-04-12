<?php
enable_chunks();

$ProgenitorID = localize('ProgenitorID');


$children = getImmediateChildren($ProgenitorID);
//new dBug($children);
//new dBug($_REQUEST);

$progenitor = getChunk($ProgenitorID);

?>


<div class="pretty_table_wrapper">
	<h2>Children of <em><?= $progenitor['Title'] ?></em></h2>
	<table class="pretty">
		<thead>
		<tr>
			<th width="20">ID</th>
			<th>TITLE</th>
			<th width="30"><!--	EDIT	--></th>
			<th width="68"><!--	MOVE	--></th>
			<th width="30"><!--	DELETE	--></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($children as $c) {
		echo '<tr>';
		echo '	<td>' . $c['ChunkID'] . '</td>';
		echo '	<td>' . $c['Title'] . '</td>';
		echo '	<td><a href="/admin/chunks/?view=chunk&ChunkID='.$c['ChunkID'].'">EDIT</a></td>';
		echo '	<td><a href="?action=move&direction=down&ChunkID='.$c['ChunkID'].'&SortValue='.$c['SortValue'].'"><img src="/admin/assets/arrow_down.png" alt="move down" /></a> <a href="?action=move&direction=up&ChunkID='.$c['ChunkID'].'&SortValue='.$c['SortValue'].'"><img src="/admin/assets/arrow_up.png" alt="move down" /></a></td>';
		echo '	<td><button type="button" onclick="deleteChunk(xxx)">DELETE</button></td>';
		echo '</tr>';
		}
		?>	
		</tbody>
		<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
		</tfoot>
	</table>
</div>