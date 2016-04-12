<?php

// THE SURVEY IS CLOSED FOR THE SEASON. REDIRECT TO THE 'CLOSED' MESSAGE PAGE. COMMENT-OUT WHEN SURVEY IS LIVE
//header("Location: http://members.winesofontario.org/survey_closed.php/");
/* Make sure that code below does not get executed when we redirect. */
//exit;

require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'survey';
$section_title	= $self;

include '../inc/checkLogin.php';


//Check if survey is done.
$alreadySubmitted = good_query_value("SELECT Submitted FROM SurveyAnswers WHERE WineryID = " . $userData['WineryID']);

if($alreadySubmitted == 'True')
{
	header("location:survey-submit2.php");
}

instantiate_header ();
$header -> body_id = 'survey';
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

			enable_chunks();
			//$chunk = getChunkByName('Sustainability Survey');
			$chunk = getChunkByName('Sustainability Survey 2014');
			echo $chunk['Content'];
		?>
		<p>&nbsp;</p>
		<h2>Sections in the Survey</h2>
		<ol id="surveyList">
			<?php 		
				connect2database();
				$table = good_query_table('SELECT SectionID, Name FROM SurveySections');			
				foreach ($table as $row) {
					echo '<li><p><a href="/survey-section2.php?SectionID=' . $row['SectionID'] . '">' . $row['Name'] . '</a></p></li>';
				}
			?>
		</ol>
		<button class="Survey right" onClick="window.location='survey-section2.php?SectionID=1'">Start the Survey!</button>
		<?php 
		} else {
			echo '<h1>You must be a member to view this page.</h1>';
			echo '<p>If you are a member of the Wine Council of Ontario and believe you should see this page, please <a href="/Contact">contact us</a>.</p>';
			
		} ?>
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