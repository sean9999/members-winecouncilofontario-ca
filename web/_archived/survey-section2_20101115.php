<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'survey';
$section_title	= $self;

include 'checkLogin.php';

//Check if survey is done.
$alreadySubmitted = good_query_value("SELECT Submitted FROM SurveyAnswers WHERE WineryID = " . $userData['WineryID']);

if($alreadySubmitted == 'True')
{
	header("location:survey-submit2.php");
}

require_once 'function.characterConversions.php';

connect2database();

//Handle possible incoming form data
if(isset($_POST['FormQuestions'])) $action = 'form_save';
if (!empty($action)) include 'actions.php';

//Information on the current survey section
$SurveySectionInfo = good_query_assoc('SELECT SectionID, SectionNumber, Name FROM SurveySections WHERE SectionID = ' . stripslashes($_GET['SectionID']));

//Subsection information for this section
$SubSections = good_query_table('SELECT SubSectionID, SubSectionNumber, Name FROM SurveySubsections WHERE SectionID = ' . $SurveySectionInfo['SectionID'] . ' ORDER BY SubSectionNumber ASC');

instantiate_header ();
$header -> body_id = 'home';
//	added by sean :: sep 9, 2010
$header->addcss('/lib/colorbox/example2/colorbox.css');
$header->addjs('/lib/colorbox/jquery.colorbox-min.js"');
$header->addrawjs("
function hide(id)
{
	document.getElementById(id).style.display='none';
}

function unhide(id)
{
	document.getElementById(id).style.display='block'; 
}
");
//	added by sean sep 30
$header->addjs('/lib/autosave/autosave-survey.js');


include 'header.php';
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
		 
connect2database();

include 'tempinc/widget_survey-location2.php';

echo '<h1>' . $SurveySectionInfo['SectionNumber'] . '. ' . $SurveySectionInfo['Name'] . '</h1>'; 

?>


<p>
<?php 
	if ($SurveySectionInfo['SectionNumber'] == 1 ) {
		echo 'Section 1 blurb to go here.';
	}
	elseif ($SurveySectionInfo['SectionNumber'] == 2 ) {
		echo 'Section 2 blurb to go here.';
	}
	elseif ($SurveySectionInfo['SectionNumber'] == 3 ) {
		echo 'Section 3 blurb to go here.';
	}
	elseif ($SurveySectionInfo['SectionNumber'] == 4 ) {
		echo 'Section 4 blurb to go here.';
	}
	elseif ($SurveySectionInfo['SectionNumber'] == 5 ) {
		echo 'Section 5 blurb to go here.';
	}
	elseif ($SurveySectionInfo['SectionNumber'] == 6 ) {
		echo 'Section 6 blurb to go here.';
	}
	elseif ($SurveySectionInfo['SectionNumber'] == 7 ) {
		echo 'Section 7 blurb to go here.';
	}
	elseif ($SurveySectionInfo['SectionNumber'] == 8 ) {
		echo 'Section 8 blurb to go here.';
	}
?>
</p>

<div class="Survey">
 
<style>
	.sCommentAdd {
		display: none;
	}
</style>

<form name="input" id="input" action="survey-section2.php?SectionID='<?php echo $SurveySectionInfo['SectionID']; ?>'" method="post">
	<input type="hidden" name="FormQuestions" value="true" />
	<input type="hidden" name="UserID" value="<?php echo $userData['UserID'];?>" />

	<?php
	foreach ($SubSections as $ss)
	{
		echo '<h2><span class="secNum">' . $SurveySectionInfo['SectionNumber'] . '.' . $ss['SubSectionNumber'] . '</span><span class="secHead">' . $ss['Name'] . '</span></h2><div class="clearer"></div>';
		
		$Questions = good_query_table('SELECT SurveySections.SectionID as SectionID,  SurveySections.SectionNumber as SectionNumber, SurveySections.Name as SectionName, 
		SurveySubsections.SubSectionID as SubSectionID, SurveySubsections.SubSectionNumber as SubSectionNumber, SurveySubsections.Name as SubSectionName, QuestionNumberA, 
		QuestionNumberB, QuestionID, Question, MoreInfo 
		FROM SurveySections, SurveySubsections, SurveyQuestions
		WHERE SurveyQuestions.SubSectionID = SurveySubsections.SubSectionID 
		AND SurveySubsections.SectionID = SurveySections.SectionID
		AND SurveySections.SectionID = ' . $SurveySectionInfo['SectionID'] . '
		AND SurveySubsections.SubSectionID = ' . $ss['SubSectionID'] . '
		ORDER BY SectionNumber ASC, SubSectionNumber ASC, QuestionNumberA ASC, QuestionNumberB ASC');
		
		$WineryID = good_query_value("SELECT WineryID FROM Users WHERE UserID = " . $userData['UserID']);
		
		foreach ($Questions as $q)
		{
			$Answer  = good_query_assoc("SELECT * FROM SurveyAnswers WHERE QuestionID = " . $q['QuestionID'] . " AND WineryID = " . $WineryID);
		
			include 'tempinc/widget_sQuestion2.php';	
		}
	}

	$prevSection = $SurveySectionInfo['SectionID'] - 1;
	$nextSection = $SurveySectionInfo['SectionID'] + 1;
	
	$linkStarter = "/survey-section2.php?SectionID=";
	$prevLink = $linkStarter . $prevSection;
	$nextLink = $linkStarter . $nextSection;
	?>
</form>
	<div class="sButtons">
		<button class="Survey right" onclick="window.location = '<?php echo $nextLink; ?>'">Next Section &rarr;</button>
		<!--  <button type="submit" class="Survey right" style="display:block">Save Current Page</button>'  -->
		<button class="Survey left"  onclick="window.location = '<?php echo $prevLink; ?>'">&larr; Previous Section</button>
	</div>




<?php 
include 'tempinc/widget_survey-location2.php';
?>
</div>
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