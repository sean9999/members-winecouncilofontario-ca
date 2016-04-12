<?php 

//Run this script after backing up SurveyAnswers to SurveyAnswers_YYYY, SurveyQuestions to SurveyQuestions_YYYY, etc. (YYYY being a four digit year)

include '../../vars.php';

connect2database();

$tableName = good_query_value("	SELECT TABLE_NAME
								FROM INFORMATION_SCHEMA.TABLES
								WHERE TABLE_SCHEMA = '" . DB_DB . "'
								AND TABLE_NAME LIKE 'SurveyAnswers_%'
								ORDER BY TABLE_NAME DESC
								LIMIT 1"); 

if($tableName)
{
	$tableNamePieces = explode('_', $tableName); 
	$lastYear = $tableNamePieces[1];
}

new dBug($thisYear);

$wineries = good_query_table("	SELECT * 
								FROM Wineries
								WHERE WineryID IN 
								(SELECT DISTINCT WineryID 
								FROM SurveyAnswers_$lastYear
								WHERE WineryID <> 302)
								ORDER BY WineryID ASC");

$questions = good_query_table("	SELECT * 
								FROM (SurveyQuestions_$lastYear as q
								LEFT JOIN SurveySubsections_$lastYear as sss
								ON q.SubSectionID = sss.SubSectionID)
								LEFT JOIN SurveySections_$lastYear as ss
								ON sss.SectionID = ss.SectionID
								WHERE q.SubSectionID <> 0");

foreach ($wineries as $w)
	foreach ($questions as $q)
	{
		$answer = good_query_assoc("SELECT * 
									FROM SurveyAnswers_$lastYear 
									WHERE WineryID = $w[WineryID] 
									AND QuestionID = $q[QuestionID]");
		
		$number = $q['SectionNumber'] . '.' . $q['SubSectionNumber'] . '.' . $q['QuestionNumberA'] . '.' . $q['QuestionNumberB'];						

		$sql = "INSERT IGNORE INTO SurveyAnswersSummary (
			Year, 
			WineryID, 
			SectionID, 
			SubSectionID, 
			QuestionID, 
			FullQuestionNumber, 
			Answer, 
			AnswerValue)
		VALUES (	
			$lastYear, 
			$w[WineryID], 
			$q[SectionID], 
			$q[SubSectionID], 
			$q[QuestionID], 
			'$number',
			";
		
		if($answer)
		{
			$sql .= "'$answer[Answer]',";
		
			if($answer[Answer] == 'Yes')
				$sql .= "$q[YesValue])";
			elseif ($answer[Answer] == 'No')
				$sql .= "$q[NoValue])";
			else
				$sql .= "0)";
		}
		else
			$sql .= "'N/A',0)";
			
		new dBug($sql);
		
		$result = good_query($sql);
		
		new dBug($result);		
	}




?>
