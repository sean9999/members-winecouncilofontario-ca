<form name="new_user" action="?action=create_question" method="post">

<div class="pretty_table_wrapper">
<h1>add a question</h1>
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td width="100">Section:</td>
	<td><input type="text" name="SectionNumber" class="full_width" /></td>
</tr>
<tr>
	<td width="100">SubSection:</td>
	<td><input type="text" name="SubSectionNumber" class="full_width" /></td>
</tr>
<tr>
	<td width="100">Major Question Number:</td>
	<td><input type="text" name="QuestionNumberA" class="full_width" /></td>
</tr>
<tr>
	<td width="100">Minor Question Number:</td>
	<td><input type="text" name="QuestionNumberB" class="full_width" /></td>
</tr>
<tr>
	<td width="100">Question:</td>	
	<td><input type="text" name="Question" id="Question" class="full_width" /></td>
</tr>
<tr>
	<td width="100">Yes Value:</td>
	<td><input type="text" name="YesValue" class="full_width" /></td>
</tr>
<tr>
	<td width="100">NoValue:</td>
	<td><input type="text" name="NoValue" class="full_width" /></td>
</tr>
<tr>
	<td>More Info:</td>
	<td><input type="text" name="moreInfo" id="moreInfo" class="full_width" /></td>
</tr>
<tr>
	<td colspan="2" align="right">
	<button type="reset" class="clear">Clear</button>
	<button type="submit" >Add the Question</button>
	</td>
</tr>
</table>
</div>

</form>