<input type="hidden" name="UserID" value="<?= $user['UserID'] ?>" />
<tr>
	<td>Name</td>
	<td><input type="text" name="Name" value="<?= $user['Name'] ?>" size="50" /></td>
</tr>
<tr>
	<td>Title</td>
	<td><input type="text" name="Title" value="<?= $user['Title'] ?>" size="50" /></td>
</tr>
<?php
	if(isset($user['WineryID']))
		$currentWinery = good_query_assoc("SELECT Name, WineryID FROM Wineries WHERE WineryID = " . $user['WineryID']);
	else
		$currentWinery = null;		 
?>
<tr>
	<td>Winery</td>
	<td>
		<Select name="WineryID">
			<?php
				$wineries = good_query_table("SELECT WineryID, Name FROM Wineries ORDER BY Name ASC");
				
				foreach ($wineries as $w)
				{ ?>
					<option value="<?php echo $w['WineryID']; ?>"  <?php if($w['WineryID'] == $user['WineryID']) echo 'selected="selected"';?>><?php echo $w['Name']; ?></option>			
				<?php }?>
		</Select>
	</td>
</tr>
<tr>
	<td>User Level</td>
	<td>
		<select name="UserLevel" width="50">
			<option value="Owner" <?php if($user['UserLevel'] == 'Owner') echo 'selected="selected"';?>>Owner</option>
			<option value="Employee" <?php if($user['UserLevel'] == 'Employee') echo 'selected="selected"';?>>Employee</option>
		</select>
	</td>
</tr>
<tr>
	<td>Email</td>
	<td><input type="text" name="Email" value="<?= $user['Email'] ?>" size="50" /></td>
</tr>
<tr class="hiddenSometimes">
	<td>Password</td>
	<td><input type="text" name="Password" <?php if($user['Password'] != '') echo 'readonly="readonly"';?> value="<?php echo $user['Password']; ?>" size="50" /></td>
</tr>
<tr>
	<td>Notes</td>
	<td><textarea name="Notes" class="richText" cols="50" rows="10"><?php echo $user['Notes']?></textarea></td>
</tr>

<tr>
	<td>Approved</td>
	<?php
	$extraHTML = '';
		if ($user['Approved'] == "True") $extraHTML = ' checked="checked"';
	?>
	<td><input type="checkbox" name="Approved" value="True"<?PHP echo $extraHTML; ?> /></td>
</tr>

<tr>
	<td>ztamp</td>
	<td><input type="text" name="ztamp" readonly="readonly" value="<?= $user['ztamp'] ?>" size="50" /></td>
</tr>