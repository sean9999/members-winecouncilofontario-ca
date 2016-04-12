<?php 

$wines = good_query_table('SELECT * FROM Wines ORDER BY Brand ASC, Name ASC');

?>

<input type="hidden" name="BottleID" value="<?= empty($bottle['BottleID'])?'':$bottle['BottleID'] ?>" />
<tr>
	<td>BottleID:</td>
	<td><input type="text" name="BottleID" value="<?= empty($bottle['BottleID'])?'':$bottle['BottleID'] ?>" class="full_width" readonly="readonly" disabled="disabled"/></td>
</tr>
<tr>
	<td>Wine:</td>
	<td>
		<select name="WineID">
			<option value="0">--None--</option>
			<?php foreach($wines as $w) {?>
			<option value="<?= $w['WineID']?>" <?php if(!empty($bottle['WineID']) && $bottle['Wine'] == $w['WineID']) echo 'selected="selected"'; ?>><?= $w['Brand'] . ' - ' . $w['Name']?></option>
			<?php } ?>
		</select>
	</td>
</tr>
<tr>
	<td>Volume (in mL):</td>
	<td><input type="text" name="Volume" value="<?= empty($bottle['Volume'])?'':$bottle['Volume'] ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Price:</td>
	<td><input type="text" name="Price" value="<?= empty($bottle['Price'])?'':$bottle['Price'] ?>" class="full_width" /></td>
</tr>

