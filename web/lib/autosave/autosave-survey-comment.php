<?php
require_once '../../vars.php';

try {

	connect2database();
	$G = cleanForDB($_GET);
	extract($G);
	
	$WineryID = good_query_value("SELECT WineryID FROM Users WHERE UserID = $UserID");
	
	$existant_answer = good_query_value("SELECT AnswerID FROM SurveyAnswers WHERE QuestionID = $QuestionID AND UserID = $UserID");
	
	if ($existant_answer) {
	
		$upd = good_query("
		UPDATE SurveyAnswers SET Comments = '$Comments', ztamp = NOW() WHERE AnswerID = $existant_answer
		");
	
	} else {
	
		$ins = good_query("
		INSERT INTO SurveyAnswers (QuestionID, WineryID, UserID, Comments, ztamp)
		VALUES ($QuestionID,$WineryID,$UserID,'$Comments',NOW())
		");
	
	}
	
	if ($upd) {
		$r['status']= 'success';
		$r['msg']	= 'The record was updated.';
	} elseif ($ins) {
		$r['status']= 'success';
		$r['msg']	= 'The record was inserted.';
	} else {
		$r['status']= 'error';
		$r['msg']	= 'There was an error';	
	}
	
} catch (Exception $e) {

	$r = $e;
	$r['status'] = 'error';

}

echo json_encode($r);

?>