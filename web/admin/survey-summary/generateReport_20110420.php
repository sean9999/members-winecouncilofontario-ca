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

$sql = "	INSERT INTO SurveyAnswersSummary (Year, WineryID, SectionID, SubSectionID, QuestionID, FullQuestionNumber, Answer, AnswerValue) 
			SELECT 	$lastYear as Year, 
					a.WineryID as WineryID, 
					ss.SectionID as SectionID, 
					sss.SubSectionID as SubSectionID, 
					a.QuestionID as QuestionID, 
					CONCAT(ss.SectionNumber, '.', sss.SubSectionNumber, '.', q.QuestionNumberA, '.', q.QuestionNumberB) as FullQuestionNumber,
					a.Answer as Answer,
					(CASE a.Answer WHEN 'Yes' THEN q.YesValue WHEN 'No' THEN q.NoValue WHEN 'N/A' THEN 0 END) as AnswerValue
			FROM ((SurveyAnswers_$lastYear as a
			LEFT JOIN SurveyQuestions_$lastYear as q
			ON a.QuestionID = a.QuestionID)
			LEFT JOIN SurveySubsections_$lastYear as sss
			ON q.SubSectionID = sss.SubSectionID)
			LEFT JOIN SurveySections_$lastYear as ss
			ON sss.SectionID = ss.SectionID
			WHERE q.SubSectionID <> 0";

new dBug($sql);

$result = good_query($sql);

new dBug($result);


?>
