<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'survey';
$section_title	= 'Sustainability Survey';

include 'checkLogin.php';

//Check if survey is done.

//	WTF? This is so hacky it hurts

//	WTF? enum is a fucking enum?

$alreadySubmitted = good_query_value("
	SELECT	Submitted
	FROM	SurveyAnswers
	WHERE	YEAR(ztamp)	= " . date('Y') . "
	AND		WineryID	= " . $userData['WineryID']
);

if($alreadySubmitted == 'True') {
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
$header -> body_id = 'survey';
//	added by sean :: sep 9, 2010
//$header->addcss('/lib/colorbox/example2/colorbox.css');
//$header->addjs('/lib/colorbox/jquery.colorbox-min.js"');
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
	$UserLevels = array('Owner','Employee','Non-Member');
	if (in_array($UserLevel, $UserLevels)) {
		connect2database();
		include 'tempinc/widget_survey-location2.php';
		echo '<h1>' . $SurveySectionInfo['SectionNumber'] . '. ' . $SurveySectionInfo['Name'] . '</h1>'; 
		
		echo '<p>';		
		enable_chunks();
		if ($SurveySectionInfo['SectionNumber'] == 1 ) {
			$chunk1 = getChunkByName('Section 1');
			echo $chunk1['Content'];
		}
		elseif ($SurveySectionInfo['SectionNumber'] == 2 ) {
			$chunk2 = getChunkByName('Section 2');
			echo $chunk2['Content'];
		}
		elseif ($SurveySectionInfo['SectionNumber'] == 3 ) {
			$chunk3 = getChunkByName('Section 3');
			echo $chunk3['Content'];
		}
		elseif ($SurveySectionInfo['SectionNumber'] == 4 ) {
			$chunk4 = getChunkByName('Section 4');
			echo $chunk4['Content'];
		}
		elseif ($SurveySectionInfo['SectionNumber'] == 5 ) {
			$chunk5 = getChunkByName('Section 5');
			echo $chunk5['Content'];
		}
		elseif ($SurveySectionInfo['SectionNumber'] == 6 ) {
			$chunk6 = getChunkByName('Section 6');
			echo $chunk6['Content'];
		}
		elseif ($SurveySectionInfo['SectionNumber'] == 7 ) {
			$chunk7 = getChunkByName('Section 7');
			echo $chunk7['Content'];
		}
		elseif ($SurveySectionInfo['SectionNumber'] == 8 ) {
			$chunk8 = getChunkByName('Section 8');
			echo $chunk8['Content'];
		}
		echo '</p>';
?>

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
			connect2database();
			
			//Get the backup table for last year's survey
			/*
			$tableName = good_query_value("	SELECT TABLE_NAME
											FROM INFORMATION_SCHEMA.TABLES
											WHERE TABLE_SCHEMA = '" . DB_DB . "'
											AND TABLE_NAME LIKE 'SurveyAnswers_%'
											ORDER BY TABLE_NAME DESC
											LIMIT 1"); 
			*/
			//$tableName = 'SurveyAnswers_20111116';
			$tableName = 'SurveyAnswers';

			if($tableName)
			{
				$tableNamePieces = explode('_', $tableName); 
				$lastYear = $tableNamePieces[1];
			}
			
			foreach ($SubSections as $ss)
			{
				echo '<h2><span class="secNum">' . $SurveySectionInfo['SectionNumber'] . '.' . $ss['SubSectionNumber'] . '</span><span class="secHead">' . $ss['Name'] . '</span></h2><div class="clearer"></div>';
				
				$Questions = good_query_table('
					SELECT SurveySections.SectionID as SectionID,  SurveySections.SectionNumber as SectionNumber, SurveySections.Name as SectionName, 
					SurveySubsections.SubSectionID as SubSectionID, SurveySubsections.SubSectionNumber as SubSectionNumber, SurveySubsections.Name as SubSectionName, QuestionNumberA, 
					QuestionNumberB, QuestionID, Question, MoreInfo 
					FROM SurveySections, SurveySubsections, SurveyQuestions
					WHERE SurveyQuestions.SubSectionID = SurveySubsections.SubSectionID 
					AND SurveySubsections.SectionID = SurveySections.SectionID
					AND SurveySections.SectionID = ' . $SurveySectionInfo['SectionID'] . '
					AND SurveySubsections.SubSectionID = ' . $ss['SubSectionID'] . '
					ORDER BY SectionNumber ASC, SubSectionNumber ASC, QuestionNumberA ASC, QuestionNumberB ASC
				');
				
				$WineryID = good_query_value("SELECT WineryID FROM Users WHERE UserID = " . $userData['UserID']);
				
				foreach ($Questions as $q) {
					$Answer  = good_query_assoc("
						SELECT *
						FROM SurveyAnswers
						WHERE QuestionID = " . $q['QuestionID'] . "
						AND WineryID = " . $WineryID . "
						AND YEAR(ztamp) = " . date('Y') . "
					");
					include 'tempinc/widget_sQuestion2.php';	
				}
			}
		
			$prevSection = $SurveySectionInfo['SectionID'] - 1;
			$nextSection = $SurveySectionInfo['SectionID'] + 1;
			
			$linkStarter = "/survey-section2.php?SectionID=";
			
			$lastSectionNumber = good_query_value("SELECT SectionNumber FROM SurveySections ORDER BY SectionNumber DESC LIMIT 1");
		
			$prevLink = $linkStarter . $prevSection;
			
			if($SurveySectionInfo['SectionNumber'] == $lastSectionNumber)
			{
				$nextLink = '/survey-submit2.php';
				$nextButtonName = 'Submit Survey';
			}
			else
			{
				$nextLink = $linkStarter . $nextSection;
				$nextButtonName = 'Next Section &rarr;';
			}
			
			?>
		</form>
		
		<div class="sButtons">
			<button class="Survey right" onclick="window.location = '<?php echo $nextLink; ?>'"><?= $nextButtonName ?></button>
			<!--  <button type="submit" class="Survey right" style="display:block">Save Current Page</button>'  -->
			<button class="Survey left"  onclick="window.location = '<?php echo $prevLink; ?>'" <?= $SurveySectionInfo['SectionNumber'] == 1 ? 'style="display:none"' : '' ?>>&larr; Previous Section</button>
		</div>
		
		
	</div>

<?php 
include 'tempinc/widget_survey-location2.php';


	} else {
		echo '<h1>You must be a member to view this page.</h1>';
		echo '<p>If you are a member of the Wine Council of Ontario and believe you should see this page, please <a href="/Contact">contact us</a>.</p>';
	}

?>

</div>
	
	<div id="rightNav">
		<?php include 'right_links/main.php'; ?>
		<div class="clearer"></div>
	</div>
	
<div class="clearer"></div>
</div>
<?php include 'footer.php'; ?>