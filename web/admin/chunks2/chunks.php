<?php
enable_chunks();
$progenitors	= getProgenitors();
$vagabonds		= getVagabonds();
$orpahns		= array();
//new dBug($chunks);
?>

<div class="pretty_table_wrapper">
	<h2>Nested Pages</h2>
	<table border="1" class="chunktable pretty">
	<thead>
		<tr>
			<th class="padID"></th>
			<th>NAME</th>
			<th width="64">ACTIONS</th>
		</tr>
	</thead>
	<tbody>
	<?php
	enable_chunks();
	function drillDescendants($ChunkID=0,$generation=0) {
	
		$generation = $generation + 1;
		$p = array('fields' => 'ChunkID,ChildOf,Name,Title,SEOName,UserLevels,SortValue','sortby' => 'SortValue ASC, UserLevels');
		$thisgen = getImmediateChildren($ChunkID,$p);
	
		foreach ($thisgen as $r) {
			if (sizeof($r)) {
				$r['hasKids'] = chunkHasChildren($r['ChunkID']);
				echo spitRow($r,$generation);			
				drillDescendants($r['ChunkID'],$generation);
			}
		}
	}

	function spitRow($r,$generation) {
		$pad	= '';
		$pad3	= '';
		for ($i = 1; $i < $generation; $i++) $pad .= '<img src="/admin/assets/arrow_blank.png" class="toggler" />';
		for ($i = 1; $i < $generation; $i++) $pad3 .= ' &raquo; ';
		$pad2 = '<img src="/admin/assets/arrow_blank.png" class="toggler" />';
		if ($r['hasKids']) $pad2 = '<a href="javascript:toggleKids(' . $r['ChunkID'] . ')"><img src="/admin/assets/arrow_right.png" id="toggler_' . $r['ChunkID'] .'" class="toggler" /></a>';	
		$le_row = <<<BLOCK
		<tr class="chunkrow childof_{$r['ChildOf']}">
			<td class="padID">{$pad}{$pad2}</td>
			<td><a href="?view=chunk&amp;ChunkID={$r['ChunkID']}"><strong>{$pad3}{$r['Name']}</strong></a><br />
				<span class="user"><em>Visible to:</em> <strong>{$r['UserLevels']}</strong></span>
			</td>
			<td align="right">
				<ul class="chunk_actions smalltext">
					<!--<li><a href="?action=spawn&amp;ChunkID={$r['ChunkID']}">SPAWN</a></li>-->
					<li><a href="?action=clone&amp;ChunkID={$r['ChunkID']}">CLONE</a></li>
					<li><a href="?view=chunk&amp;ChunkID={$r['ChunkID']}">EDIT</a></li>
					<li><a href="?view=preview&amp;ChunkID={$r['ChunkID']}" class="colorbox">PREVIEW</a></li>
					<li><a href="javascript:deleteChunk({$r['ChunkID']})">DELETE</a></li>
				</ul>
			</td>
		</tr>
BLOCK;
		return $le_row;
		}
		drillDescendants(0);
		?>
		</tbody>
		<tbody class="">
			<tr>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="clearer"></div>
<br />
<div class="clearer"></div>

<div class="pretty_table_wrapper">
	<h2>Vagabonds</h2>
	<table class="pretty">
		<thead>
		<tr>
			<th  class="padID"></th>
			<th>NAME</th>
			<th width="40">ACTIONS</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		$foot_msg = '';
		if (sizeof ($vagabonds))
		foreach ($vagabonds as $p) {
		echo '<tr>';
		echo '	<td class="padID"></td>';
		echo '	<td><a href="?view=chunk&amp;ChunkID='.$p['ChunkID'].'"><strong>'.$p['Name'] . '</strong></a><br />
				<span class="user"><em>Visible to:</em> <strong>'.$p['UserLevels'].'</strong></span></td>';
		echo '	<td align="right">
				<ul class="chunk_actions smalltext">
					<!--<li><a href="?action=spawn&amp;ChunkID='.$p['ChunkID'].'">SPAWN</a></li>-->
					<li><a href="?action=clone&amp;ChunkID='.$p['ChunkID'].'">CLONE</a></li>
					<li><a href="?view=chunk&amp;ChunkID='.$p['ChunkID'].'">EDIT</a></li>
					<!-- <li><a href="?view=pop_chunk&amp;ChunkID='.$p['ChunkID'].'" class="colorbox">POP_EDIT</a></li> -->
					<li><a href="?view=preview&amp;ChunkID='.$p['ChunkID'].'" class="colorbox">PREVIEW</a></li>
					<li><a href="javascript:deleteChunk('.$p['ChunkID'].')">DELETE</a></li>
				</ul>
				</td>';
		echo '</tr>';
		} else {
		$foot_msg = 'There are no vagabonds';
		}
		?>	
		</tbody>
		<tbody class="">
		<tr>
			<td colspan="3"><?= $foot_msg ?></td>
		</tr>
		</tfoot>
	</table>
</div>

<div class="clearer"></div>
<br />
<div class="clearer"></div>

<div class="pretty_table_wrapper">
	<h2>Orphans</h2>
	<table class="pretty">
		<thead>
		<tr>
			<th class="padID">ID</th>
			<th>TITLE</th>
			<th width="40">ACTIONS</th>
		</tr>
		</thead>
		<tbody>
		<?php 
		$foot_msg = '';
		if (sizeof ($orphans))
		foreach ($orphans as $p) {
		echo '<tr>';
		echo '	<td class="padID"></td>';
		echo '	<td>' . $p['Title'] . '</td>';
		echo '	<td align="right">
				<ul class="chunk_actions smalltext">
					<li><a href="?action=spawn&amp;ChunkID='.$p['ChunkID'].'">SPAWN</a></li>
					<li><a href="?action=clone&amp;ChunkID='.$p['ChunkID'].'">CLONE</a></li>
					<li><a href="?view=pop_chunk&amp;ChunkID='.$p['ChunkID'].'" class="colorbox">EDIT</a></li>
					<li><a href="?view=chunk&amp;ChunkID='.$p['ChunkID'].'">EDIT</a></li>
					<li><a href="javascript:deleteChunk('.$p['ChunkID'].')">DELETE</a></li>
				</ul>
				</td>';
		echo '</tr>';
		} else {
		$foot_msg = 'There are no orphans';
		}
		?>	
		</tbody>
		<tbody class="">
		<tr>
			<td colspan="3"><?= $foot_msg ?></td>
		</tr>
		</tfoot>
	</table>
</div>