<?php
connect2database();

$questions =  good_query_table("
	SELECT		QuestionID, SectionNumber, SubSectionNumber, QuestionNumberA, QuestionNumberB, Question, YesValue, NoValue
	FROM		SurveyQuestions, SurveySections, SurveySubsections
	WHERE		SurveySubsections.SubsectionID	= SurveyQuestions.SubsectionID OR SurveySubsections.SubsectionID IS NULL
	AND			SurveySections.SectionID		= SurveySubsections.SectionID
	GROUP BY QuestionID
	ORDER BY 	SectionNumber ASC, SubSectionNumber ASC
	");

?>

<div class="pretty_table_wrapper">
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
foreach ($questions as $t) 
{

	$QNUM = array();
	
	if (is_null($t['SectionNumber']))		$QNUM[0] = 'X';	else $QNUM[0] = $t['SectionNumber'];
	if (is_null($t['SubSectionNumber']))	$QNUM[1] = 'X';	else $QNUM[1] = $t['SubSectionNumber'];
	if (is_null($t['QuestionNumberA']))		$QNUM[2] = 'X';	else $QNUM[2] = $t['QuestionNumberA'];
	if (is_null($t['QuestionNumberB']))		$QNUM[3] = 'X';	else $QNUM[3] = $t['QuestionNumberB'];
	
	//	steve's old code
	//$QNUM = $t['SectionNumber'].'.'. $t['SubSectionNumber'] .'.'.$t['QuestionNumberA'].'.'.$t['QuestionNumberB'];
	echo '<tr>';
	echo '	<td>'.$t['QuestionID'].'</td>';
	echo '	<td><a href="?view=question&QuestionID=' . $t['QuestionID'] . '">' . implode('.',$QNUM) . '</a></td>';
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