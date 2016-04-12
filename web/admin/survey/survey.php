<?php
connect2database();
$tags = good_query_table("
	SELECT QuestionID, SectionNumber, SubSectionNumber, QuestionNumberA, QuestionNumberB, Question, YesValue, NoValue
	FROM SurveySections, SurveySubsections, SurveyQuestions
	WHERE SurveySections.SectionID = SurveySubsections.SectionID 
	AND SurveySubsections.SubsectionID = SurveyQuestions.SubsectionID
	ORDER BY SectionNumber ASC, SubSectionNumber ASC, QuestionNumberA ASC, QuestionNumberB ASC"); // EDITED BY ALEKS 2011-01-25
?>

<div class="pretty_table_wrapper">
<h1>survey questions</h1>
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Question Number</th>
    <th>Question</th>
    <th>Yes Value</th>
    <th>No Value</th>
    <th><!-- edit --></th>
    <th><!-- delete --></th>
</tr>
<?php
foreach ($tags as $t) 
{
	$QNUM = $t['SectionNumber'].'.'.$t['SubSectionNumber'].'.'.$t['QuestionNumberA'].'.'.$t['QuestionNumberB'];
	echo '<tr>';
	echo '	<td>'.$t['QuestionID'].'</td>';
	echo '	<td><a href="?view=question&QuestionID=' . $t['QuestionID'] . '">' . $QNUM . '</a></td>';
	echo '	<td>'.$t['Question'].'</td>';
	echo '	<td>'.$t['YesValue'].'</td>';
	echo '	<td>'.$t['NoValue'].'</td>';
	echo '	<td><a href="?view=question&QuestionID=' . $t['QuestionID'] . '">edit</a></td>';
	echo '	<td><a href="javascript:deleteQuestion(\'' . $t['QuestionID'] . '\')">delete</a></td>';	
	echo '</tr>';
}
?>
</table>
</div>