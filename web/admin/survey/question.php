<?php
connect2database();
require_once 'function.characterConversions.php';
require_once 'function.readChunks.php';

$QuestionID = localize('QuestionID');

$t = good_query_assoc("SELECT QuestionID, SectionNumber, SubSectionNumber, QuestionNumberA, QuestionNumberB, Question, YesValue, NoValue, MoreInfo
FROM SurveySections, SurveySubsections, SurveyQuestions
WHERE SurveySections.SectionID = SurveySubsections.SectionID AND SurveySubsections.SubsectionID = SurveyQuestions.SubsectionID AND QuestionID = $QuestionID");
extract($t);
?>

<div class="breadcrumb"><a href="index.php"><? $section ?></a> &raquo; <?= $Name ?></div>

<form method="post" action="?action=update_question">
<input type="hidden" name="QuestionID" value="<?= $QuestionID ?>" />

<div class="pretty_table_wrapper">
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
	<td>QuestionID:</td>
	<td><input type="text" name="QuestionID" value="<?= $QuestionID ?>" class="full_width" readonly="readonly" disabled="disabled"/></td>
</tr>
<tr>
	<td>Section Number:</td>
	<td><input type="text" name="SectionNumber" value="<?= $SectionNumber ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Sub Section Number:</td>
	<td><input type="text" name="SubSectionNumber" value="<?= $SubSectionNumber ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Major Question Number:</td>
	<td><input type="text" name="QuestionNumberA" value="<?= $QuestionNumberA ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Minor Question Number:</td>
	<td><input type="text" name="QuestionNumberB" value="<?= $QuestionNumberB ?>" class="full_width" /></td>
</tr>
<tr>
	<td>Question:</td>
	<td><textarea name="Question" id="Question" class="richText" cols="50" rows="10"><?= $Question ?></textarea></td>
</tr>
<tr>
	<td>Yes Value:</td>
	<td><input type="text" name="YesValue" value="<?= $YesValue ?>" class="full_width" /></td>
</tr>
<tr>
	<td>No Value:</td>
	<td><input type="text" name="NoValue" value="<?= $NoValue ?>" class="full_width" /></td>
</tr>
<tr>
	<td>More Info:</td>
	<td><textarea name="MoreInfo" id="MoreInfo" class="richText" cols="50" rows="10"><?= $MoreInfo ?></textarea></td>
</tr>
<tr>
	<td colspan="2" align="right">
	<button type="reset" name="reset" class="clear">Reset</button>
	<button type="submit" name="save">Submit</button>
	<a href="javascript:toggleEditor('Question');javascript:toggleEditor('MoreInfo');">[ RTF / HTML ]</a>
	</td>
</tr>
</table>
</div>
</form>
</div>


