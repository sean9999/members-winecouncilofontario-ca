<?php
connect2database();
$there_was_an_error = false;


switch ($action) {

    case 'update_question':
    $_POST = cleanForDB($_POST);
    //extract($_POST);

    $SSID = findSSID($_POST[SectionNumber],$_POST[SubSectionNumber]);   
    
    $u = "UPDATE SurveyQuestions SET Question = '$_POST[Question]', YesValue = '$_POST[YesValue]', NoValue = '$_POST[NoValue]', SubSectionID = '$SSID', QuestionNumberA = '$_POST[QuestionNumberA]', QuestionNumberB = '$_POST[QuestionNumberB]', MoreInfo = '$_POST[MoreInfo]' WHERE QuestionID = $_POST[QuestionID]";
    if (good_query($u))	$message = 'The question was updated';
    else {
		$there_was_an_error = true;
		$message = 'There was an error in module ' . $action;    
    }
    break;
    
    case 'create_question':
    $_POST = cleanForDB($_POST);
    extract($_POST);
    require_once 'function.readChunks.php';
    //$SEOName = convertFromTitleToPath($Name);
    
    $SSID = findSSID($SectionNumber,$SubSectionNumber);
    
    $i = "INSERT INTO SurveyQuestions (Question,YesValue,NoValue,SubSectionID,QuestionNumberA,QuestionNumberB,MoreInfo) VALUES ('$Question','$YesValue','$NoValue','$SSID','$QuestionNumberA','$QuestionNumberB','$MoreInfo')";
    $go = good_query($i);
    $message = 'The question was added.';
    $view = 'survey';
    break;
    
    case 'delete_question':
    extract($_GET);
    $d = "DELETE FROM SurveyQuestions WHERE QuestionID = $QuestionID";
    $go = good_query($d);
    $message = 'The question was deleted.';
    $view = 'survey';
    break;
    
    default:
    $there_was_an_error = true;
    $message = 'There was an action for which no code was written in <code>action.php</code>';

}

if ($there_was_an_error) {
	include_once INC . 'dBug.php';
    new dBug($_GET);
    new dBug($_POST);
}

function findSSID($SNUM, $SSNUM)
{
	$SSID = good_query_value("SELECT SubSectionID FROM SurveySections JOIN SurveySubsections ON SurveySections.SectionID = SurveySubsections.SectionID WHERE SectionNumber = ".$SNUM." AND SubSectionNumber = ".$SSNUM);

	return $SSID;
}


?>