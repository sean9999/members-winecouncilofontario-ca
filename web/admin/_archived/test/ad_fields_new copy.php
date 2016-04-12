<input type="hidden" name="testID" value="" />
<tr class="hidden">
	<td class="name">testID:</td>
	<td><input type="text" name="testID" value="" class="full_width" readonly="readonly" disabled="disabled"/></td>
</tr>
<tr>
	<td>Name:</td>
	<td><input type="text" name="Name" value="" class="full_width" /></td>
</tr>
<tr>
	<td>Image:</td>
	<td><input type="text" name="Image" id="Image" value="" class="full_width" />
		<p class="changeRow">
		<a href="#" onclick="mcImageManager.browse({fields : 'Image', no_host: true, rootpath : '{0}/trade-ads'});">[Browse]</a>
		</p>
	</td>
</tr>
<tr>
	<td>Target URL:</td>
	<td><input type="text" name="URL" value="" class="full_width" /><br />
	<em>The whole URL including "http://" as copied from your browser window.</em></td>
</tr>
<tr>
	<td>Blurb:</td>
	<td><textarea name="Blurb" class="full_width blurb"></textarea></td>
</tr>


<?php 
	$formatString = "d/m/Y H:i"; 
	$now = time();
	$StartDate = '';
	$StartDate = date($formatString, $now);
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
	$duration = 31557600; // One Year
	$EndDate = date($formatString, ($now + $duration));
?>
<tr>
	<td>End Date:</td>
	<td>
		<div class="timePad">
			<input type="text" name="EndDate" id="EndDate" value="<?= $EndDate ?>" class="timePicker full_width" /><br />
		</div>		
	</td>
</tr>


<tr>
	<td>IsActive:</td>
	<td>
	<input type="checkbox" value="1" name="IsActive" checked="checked" /> Active
	</td>
</tr>



