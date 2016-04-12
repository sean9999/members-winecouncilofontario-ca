<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'survey';
$section_title	= $self;

include '../inc/checkLogin.php';

connect2database();

//Handle incoming post data
$result = null;
if(isset($_POST['FormSubmit']))
{
	$result = good_query("UPDATE SurveyAnswers SET Submitted='True' WHERE WineryID = " . $_POST['WineryID']);
/*
	include('Mail.php');
	include('Mail/mime.php');
	require_once 'function.characterConversions.php';
	$sujet	= 'A new survey has been filled.';
	$mailbody = 'A new survey has been filled out';
	$crlf	= "\n";
	$hdrs	= array('From' => EMAIL_SENDER,'Subject' 	=> $sujet);
	$mime = new Mail_mime($crlf);
	$mime->setTXTBody($mailbody);
	$mime->setHTMLBody($mailbody);
	$body	= $mime->get();
	$hdrs	= $mime->headers($hdrs);
	$mail 	=& Mail::factory('mail');
	$mail->send(EMAIL_RECEIVER.", ".EMAIL_DEV, $hdrs, $body); */

}

instantiate_header ();
$header -> body_id = 'survey';

include 'header.php';

connect2database();

$wineryID = good_query_value("SELECT WineryID FROM Users WHERE UserID = " . $userData['UserID']);

$wineryName = good_query_value("SELECT Name FROM Wineries WHERE WineryID = " . $wineryID);

$submitted = good_query_value("SELECT Submitted FROM SurveyAnswers WHERE WineryID = " . $wineryID);

?>


<div class="clearer"></div>


<div id="mainNav">
<?php
include 'side_links/mainNav.php';
?>
</div>

<div id="mainContent">

	<div id="Content">

<?php
//if($submitted == 'False')
	include 'tempinc/widget_survey-location2.php';

connect2database();
	
////Check for SurveyAnswers records with a blank Answer field
//$numEmptyAnswers = good_query_value("SELECT COUNT(AnswerID) FROM SurveyAnswers WHERE WineryID = " . $wineryID . " AND Answer = ''");
//
////Check for missing answer records
//$countResult = good_query_assoc("	SELECT	COUNT(Answer) as Answers, 
//											COUNT(*) as Records 
//									FROM SurveyQuestions 
//									LEFT JOIN SurveyAnswers 
//									ON SurveyQuestions.QuestionID = SurveyAnswers.QuestionID 
//									WHERE SurveyQuestions.SubSectionID <> 0
//									AND (WineryID IS NULL 
//									OR WineryID = $wineryID)");
//	
//if($numEmptyAnswers != "0" || ($countResult['Answers'] != $countResult['Records'])) 
//	$surveyIncomplete = true;
//else
//	$surveyIncomplete = false; 

$numQuestions = good_query_value("
	SELECT COUNT(*)
	FROM SurveyQuestions
	WHERE SubSectionID <> 0
");

$numAnswers = good_query_value("
	SELECT COUNT(*)
	FROM SurveyAnswers
	WHERE WineryID = $wineryID
	AND Answer IN ('Yes','No','N/A')
	AND YEAR(ztamp) = 2014
");

$surveyIncomplete = ($numQuestions >= $numAnswers);

?>

<?php
//include 'tempinc/widget_survey-location2.php';
?>


<h1>Submit Your Results</h1>
<?php if($submitted == 'True') echo '<p class="message">The survey for ' . $wineryName .  ' has been submitted for this year. </p>'; ?>
	<?php
		enable_chunks();
		$chunk = getChunkByName('survey_submit');
		echo $chunk['Content'];
	?>
<?php if($submitted == 'False' && $surveyIncomplete){?>
<p class="message">The survey can not be submitted until it is complete.</p>
<!--
<ul>
	<li>$numQuestions = <?= $numQuestions ?></li>
	<li>$numAnswers = <?= $numAnswers ?></li>
</ul>
-->
<?php }?>

<div style="display:<?php if($submitted == 'True') echo 'none'; else echo 'block';?>">
	<form name="submit" action="survey-submit2.php" method="post">
		<input type="hidden" name="FormSubmit" value="true" />
		<input type="hidden" name="WineryID" value="<?php echo $wineryID;?>" />
		<?php 
			$js = "confirm('This will submit your Winery Sustainability Survey.  Once submitted, you will not be able to edit it further.  Are you sure you want to submit?');";
		?>
			<button type="submit" class="Survey right"<?= $surveyIncomplete ? ' disabled="disabled"' : 'onClick="return ' . $js . '"' ?>>Submit Your Results</button>
	</form>
</div>
<div class="clearer"></div>

<?php
//if($submitted == 'False')
	include 'tempinc/widget_survey-location2.php';
?>

</div>
<div id="rightNav">
	<?php 
		include 'right_links/main.php'; 
	?>
<div class="clearer"></div>
</div>
<div class="clearer"></div>
</div>
<?php include 'footer.php'; ?>
