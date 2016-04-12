<?php
connect2database();
$le_sql = <<<BLOCK
	SELECT w.Name,w.WineryID,w.WineryNumber,w.Name,w.isMember,w.GeoLocation,SUBSTRING(w.Description,1,50) AS ShortenedDescription,r.Name AS RegionName
	FROM Wineries AS w
	INNER JOIN Regions AS r
	ON w.RegionID = r.RegionID
	ORDER BY r.Name, w.Name ASC
BLOCK;
$wineries = good_query_table($le_sql);
require_once 'function.shortenText.php';
include 'function.trueFalseOrMixed.php';
?>

<div class="pretty_table_wrapper">
<h1>2010 Survey Results</h1>
<table class="pretty" cellpadding="0" cellspacing="0">
<tr>
    <th>Number</th>
    <th>Name</th>
    <th>Region</th>
    <th>Survey is complete?</th>
</tr>
<?php
foreach ($wineries as $w) {
$answer = good_query_table ("SELECT AnswerID,Submitted FROM SurveyAnswers_2010 WHERE WineryID = " . $w['WineryID']);
?>
<tr>
	<td<?php if (empty($answer)) {echo ' class="noAnswer"'; } ?>>
	<?= $w['WineryNumber'] ?></td>
	<td<?php if (empty($answer)) {echo ' class="noAnswer"'; } ?>>
	<?php if ($w['isMember'] == 1) echo '<strong>'; ?>
	<a href="?view=answers&WineryID=<?= $w['WineryID'] ?>"><?= $w['Name'] ?></a>
	<?php if ($w['isMember'] == 1) echo '</strong>'; ?>
	</td>
	<td>
		<?php if (!empty($answer)) { ?>
			<a href="?view=answers&WineryID=<?= $w['WineryID'] ?>">View Survey Results</a></td>
		<?php 
		} 
			else
		{
			echo '<em class="small">This winery has not filled out the survey</em>';		
		}
		?>
	<td>
		<?php
		
		$submittedNess = trueFalseOrMixed($answer);
		
		switch ($submittedNess) {
			
			case 'Empty':
			echo 'n/a';
			break;
			
			case 'False':
			echo 'The survey has not been submitted';
			break;
			
			case 'True':
			echo 'The survey is complete';
			break;
			
			case 'Mixed':
			echo 'The survey is partially complete';
			break;
			
			default:
			echo $submittedNess;
		
		}
		?>
	</td>
</tr>
<?php
}
?>
</table>
</div>




<?php /*

	echo '<tr>';
	echo '	<td>'.$w['WineryNumber'].'</td>';
	echo '	<td><a href="?view=winery&WineryID=' . $w['WineryID'] . '">'.$w['Name'].'</a></td>';
	echo '	<td>'.$w['RegionName'].'</td>';
	echo '	<td class="smallText">'.$w['ShortenedDescription'].'</td>';
	echo '	<td class="smallText"><a target="googlemaps" href="'.$w['GeoLocation'].'">view map</a></td>';
	echo '	<td><a href="?view=winery&WineryID=' . $w['WineryID'] . '">edit</a></td>';
	echo '	<td><a href="javascript:deleteWinery(\'' . $w['WineryID'] . '\')">delete</a></td>';	
	echo '</tr>';


*/
?>