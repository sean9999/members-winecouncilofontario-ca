<div class="surveyLocation">
 
<p>

<?php 
connect2database();

$SurveySections = good_query_table('SELECT SectionID, SectionNumber FROM SurveySections ORDER BY SectionNumber ASC'); 

foreach($SurveySections as $SectionRow)
{
	if($SurveySectionInfo['SectionNumber'] == $SectionRow['SectionNumber'])
		$active = 'class="active" ';
	else 
		$active = '';

	echo '<a ' . $active . 'href="survey-section2.php?SectionID='. $SectionRow['SectionID'] .'" title="Go to Survey Section ' . $SectionRow['SectionNumber'] . '">'. $SectionRow['SectionNumber']  .'</a>&rarr;';
}

?>
<a href="/survey-submit2.php" title="Go to the Submission Page">Submit</a>

</p>

</div>