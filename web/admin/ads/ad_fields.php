<input type="hidden" name="AdID" value="<?= empty($thing['AdID'])?'':$thing['AdID'] ?>" />
<tr class="hidden">
	<td class="name">AdId:</td>
	<td><input type="text" name="AdID" value="<?= empty($thing['AdID'])?'':$thing['AdID'] ?>" class="full_width" readonly="readonly" disabled="disabled"/></td>
</tr>
<tr>
	<td>Name:</td>
	<td><input type="text" name="Name" value="<?= empty($thing['Name'])?'':$thing['Name'] ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Image:</td>
	<td><input type="text" name="Image" id="Image" value="<?= empty($thing['Image'])?'':$thing['Image'] ?>" class="full_width" />
		<p class="changeRow">
		<a href="#" onclick="mcImageManager.browse({fields : 'Image', no_host: true, rootpath : '{0}/trade-ads'});">[Browse]</a>
		</p>
	</td>
</tr>
<tr>
	<td>Target URL:</td>
	<td><input type="text" name="URL" id="URL" value="<?= empty($thing['URL'])?'':$thing['URL'] ?>" class="full_width" /><br />
		<p class="changeRow">
		<a href="#" onclick="mcImageManager.browse({fields : 'URL', no_host: true, rootpath : '{0}/pdf'});">[Browse]</a>
		</p>
		<em>The whole URL including "http://" as copied from your browser window.<br />
		Or, Browse to upload a PDF that associates to this ad (in the case of an application form, etc)</em></td>
</tr>
<tr>
	<td>Blurb:</td>
	<td><textarea name="Blurb" class="full_width blurb"><?= empty($thing['Blurb'])?'':$thing['Blurb'] ?></textarea></td>
</tr>
<tr>
	<td>Notes:</td>
	<td><textarea name="Notes" class="full_width blurb"><?= empty($thing['Notes'])?'':$thing['Notes'] ?></textarea></td>
</tr>
<?php 
	$formatString = "d/m/Y H:i"; 
	$now = date($formatString);
	$StartDate = '';

	if(!isset($thing['StartDate']))
	{
		$StartDate = date($formatString, $now);
	} else {
		$StartDate = date($formatString, $thing['StartDate']);
	 }
?>
<tr>
	<td>Start Date:</td>
	<td>
		<div class="timePad">
			<input type="text" name="StartDate" id="StartDate" value="<?= $StartDate ?>" class="timePicker StartTime full_width" /><br />
		</div>
	</td>
</tr>
<?php
	$then = date($formatString);
	$endTime = '';

	if($thing['EndDate'] == '')
	{
		$endTime = date($formatString, $then);
	} else {
		$endTime = date($formatString, $thing['EndDate']);
	}
?>
<tr>
	<td>End Date:</td>
	<td>
		<div class="timePad">
			<input type="text" name="EndDate" id="EndDate" value="<?= $endTime ?>" class="timePicker full_width" />
		</div>		
	</td>
</tr>


<tr>
	<td>IsActive:</td>
	<td>
	<?php
		if ($thing['IsActive'] == 1) {
			echo '<input type="checkbox" value="1" name="IsActive" checked="checked" class="not_full_width" /> Active';
		} else {
			echo '<input type="checkbox" value="1" name="IsActive" class="not_full_width" />';		
		}
	?>
	</td>
</tr>



