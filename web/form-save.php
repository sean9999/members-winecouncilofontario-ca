<?php

connect2database();

if(isset($_POST['FormQuestions']))
{
	$PostingUser = null;
	$QuestionID = null;
	$Answer = null;
	$WineryID = null;
	$Comment = null;
	$AnswerID = null;
	
	
	foreach($_POST as $key => $value)
	{
		if ($key == "FormQuestions") {}
		elseif ($key == "UserID") $PostingUser = $value;
		elseif (strlen($key) >= 7 && substr_compare($key,"comment", 0, 7) == 0)
		{	
			$QuestionID = substr($key, 7, 10);
		
			$Comment = $value;

			$WineryID = good_query_value("SELECT WineryID FROM Users WHERE UserID=" . $PostingUser);
			
			$AnswerID = good_query_value("SELECT AnswerID FROM SurveyAnswers WHERE QuestionID = " . $QuestionID . " AND WineryID = " . $WineryID);	
			
			if($AnswerID)
			{
				good_query("UPDATE SurveyAnswers SET Comments='" . $Comment . "', ztamp=NOW() WHERE AnswerID=" . $AnswerID);
			}
			else 
			{
				good_query("INSERT INTO SurveyAnswers (QuestionID, WineryID, UserID, Comments, ztamp) VALUES (" . $QuestionID . ", " . $WineryID . ", " . $PostingUser . ", '" . $Comment . "', NOW())");
			}	
		}
		else
		{
			$QuestionID = $key;
			$Answer = $value;
			
			$WineryID = good_query_value("SELECT WineryID FROM Users WHERE UserID=" . $PostingUser);

			$AnswerID = good_query_value("SELECT AnswerID FROM SurveyAnswers WHERE QuestionID = " . $QuestionID . " AND WineryID = " . $WineryID);
			
			if($AnswerID)
			{
				good_query("UPDATE SurveyAnswers SET Answer='" . $Answer . "', ztamp=NOW() WHERE AnswerID=" . $AnswerID);
			}
			else 
			{
				good_query("INSERT INTO SurveyAnswers (QuestionID, WineryID, UserID, Answer, ztamp) VALUES (" . $QuestionID . ", " . $WineryID . ", " . $PostingUser . ", '" . $Answer . "', NOW())");
			}			
		}
	}
}

?>