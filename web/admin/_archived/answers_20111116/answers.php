<?php
require_once '../../vars.php';
$action = localize('action');
if (isset($action) && strlen($action)) require_once 'actions.php';
connect2database();


$extra_header_content = <<<BLOCK

<style type="text/css">

h1 {
	font-size: 16pt;
	color: purple
}

h2 {
	font-size: 15pt;
	color: orange;
}

h3 {
	font-size: 14pt;
	color: blue;
}

h4 {
	font-size: 13pt;
	color: 
}

p.totalscore {
	font-size: bigger;
	color: gray;
	text-decoration: underline;
}

.Yes {
	color: green
}

.No {
	color: red;
}

</style>

BLOCK;



include '../header.php';

?>

<div class="pretty_table_wrapper">

<?php


//$wineries = good_query_table("SELECT WineryID,Name FROM Wineries WHERE WineryID = " . $_GET['WineryID']);

$wineries = good_query_table("SELECT WineryID,Name FROM Wineries");

foreach ($wineries as $winery) {
	
	$blah = "
		SurveyAnswers AS SA9, SurveySections AS SS9, SurveySubsections AS SSS9, SurveyQuestions AS SQ9
		WHERE	SA9.WineryID		= $winery[WineryID]
		AND		SA9.QuestionID		= SQ9.QuestionID
		AND		SQ9.SubsectionID	= SSS9.SubsectionID
		AND		SSS9.SectionID		= SS9.SectionID 
		AND		SA9.Submitted		= 'True'
	";
	$order = "SSS9.SubsectionNumber, SS9.SectionNumber, SQ9.QuestionNumberA, SQ9.QuestionNumberB ASC";
	$all_nos = good_query_value("SELECT SUM(SQ9.NoValue)	FROM $blah AND SA9.Answer = 'No'");
	$all_yes = good_query_value("SELECT SUM(SQ9.YesValue)	FROM $blah AND SA9.Answer = 'Yes'");
	$answers = good_query_table("
		SELECT	SA9.Answer, SQ9.Question, SQ9.YesValue, SQ9.NoValue, SS9.Name AS SectionName,
		SSS9.Name AS SubsectionName, SSS9.SubsectionNumber, SS9.SectionNumber, SQ9.QuestionNumberA, SQ9.QuestionNumberB
		FROM	$blah
		ORDER BY $order");
	if (sizeof($answers)) {
		echo '<h1>' . $winery['Name'] . '</h1>';
		echo '<p class="totalscore">Total Score: ';
		echo (int) $all_nos + (int) $all_yes;
		echo '</p>';

		foreach ($answers as $answer) {	
		
			$question_number = $answer['SectionNumber'] . '.' . $answer['SubsectionNumber'] . '.' . $answer['QuestionNumberA'] . '.' . $answer['QuestionNumberB'];
		
			if ($last_section_name != $answer['SectionName']) {
				$last_section_name = $answer['SectionName'];
				echo '<h2>' . $last_section_name . '</h2>';
			}
			if ($last_subsection_name != $answer['SubsectionName']) {
				$last_subsection_name = $answer['SubsectionName'];
				echo '<h3>' . $last_subsection_name . '</h3>';
			}
			echo '<p>Q #' . $question_number .': ' . trim(strip_tags($answer['Question'])) . ': <strong class="'.$answer['Answer'].'">' . $answer['Answer'] . '</strong></p>';
		}
	}
}
?>

<?php	/*
<table class="pretty">
<tr>
	<th><!-- Tag --></th>
	<th><!-- Delete Button --></th>
</tr>
<?php foreach ($tags as $tag) { ?>
<tr>
	<td><?= $tag['Tag'] ?></td>
	<td><button type="button" onclick="deleteTag(<?= $tag['TagID'] ?>)">delete</button></td>
</tr>
<?php } ?>
</table>

<h1><br /><br /><br />Add a tag</h1>

<form name="addtag" action="?action=add_tag" method="post">
<table class="pretty">
<tr>
<td><input type="text" name="Tag" size="44" /></td>
<td><button type="submit">create it</button></td>
</tr>
</table>
</form>

</div>

*/	?>

<?php
include '../footer.php';
?>