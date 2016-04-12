<input type="hidden" name="GrapeID" value="<?= empty($grape['GrapeID'])?'':$grape['GrapeID'] ?>" />
<tr>
	<td>GrapeID:</td>
	<td><input type="text" name="GrapeID" value="<?= empty($grape['GrapeID'])?'':$grape['GrapeID'] ?>" class="full_width" readonly="readonly" disabled="disabled"/></td>
</tr>
<tr>
	<td>Name:</td>
	<td><input type="text" name="Name" value="<?= empty($grape['Name'])?'':$grape['Name'] ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Colour:</td>
	<td>
		<select name="Colour">
			<option value="Red" <?php if(!empty($grape['Colour']) && $grape['Colour'] == 'Red') echo 'selected="selected"'; ?>>Red</option>
			<option value="White" <?php if(!empty($grape['Colour']) && $grape['Colour'] == 'White') echo 'selected="selected"'; ?>>White</option>
		</select>	
	</td>
</tr>
<tr>
	<td>Description:</td>
	<td>
		<textarea name="Description" id="Description" class="richText" cols="50" rows="10"><?= empty($grape['Description'])?'':$grape['Description'] ?></textarea>
	</td>
</tr>