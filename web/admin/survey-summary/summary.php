<?php

$SubSections = good_query_table("	SELECT sss.Name as SubSectionName, ss.Name as SectionName, sss.*, ss.*
									FROM SurveySubsections_$thisYear as sss
									LEFT JOIN SurveySections_$thisYear as ss
									ON sss.SectionID = ss.SectionID
									ORDER BY SubSectionID ASC");

$wineries = good_query_table("	SELECT DISTINCT w.* 
								FROM SurveyAnswersSummary as s
								INNER JOIN Wineries as w
								ON s.WineryID = w.WineryID
								WHERE s.Year = $thisYear 
								AND s.WineryID <> 302
								ORDER BY s.WineryID ASC");

$colspan = sizeof($wineries) + 1;

?>

<div class="pretty_table_wrapper">
<h1>survey questions</h1>
<table class="pretty survey" cellpadding="0" cellspacing="0">
	<tr>
	    <th>Question Number</th>
	    <?php foreach ($wineries as $w) {?>
	    <th><?= $w['Name'] ?></th>
	    <?php } ?>
	</tr>
	<?php foreach ($SubSections as $ss) 
	{?>
		<tr>
			<td class="sectionTitle" colspan="<?= $colspan ?>"><?= $ss['SectionNumber'] . '.' . $ss['SubSectionNumber'] . ' - ' . $ss['SubSectionName'] ?></td>
		</tr>
		<tr>
		<?php
	
		$report = good_query_table("SELECT * 
									FROM SurveyAnswersSummary
									WHERE Year = $thisYear 
									AND WineryID <> 302
									AND SubSectionID = $ss[SubSectionID]
									ORDER BY FullQuestionNumber ASC, WineryID ASC");
		
		
		$lastQuestion = '';
		$isOdd = true;
		
		foreach ($report as $r)
		{
			$class = '';
			if($isOdd)
				$class = 'class="odd"';
			$isOdd = !$isOdd;
				
			if($lastQuestion != $r['FullQuestionNumber'])
			{
				$lastQuestion = $r['FullQuestionNumber'];
				?>
				</tr>
			 	<tr <?= $class?>>
					<td class="question"><?= $r['FullQuestionNumber'] ?></td>	
			<?php }
			$eh = '';
			if ($r['AnswerValue'] > 0) {
				$eh = ' class="positive"';
			} elseif ($r['AnswerValue'] < 0) {
				$eh = ' class="negative"';
			}
			?>
			<td<?= $eh ?>><?= $r['AnswerValue'] ?></td>
		
		<?php } ?>
		</tr>
		<tr class="subTotal">
			<td class="question">Sub-Total</td>
			<?php 
			foreach ($wineries as $winery) {
				$sectionTotal = (int) good_query_value("
					SELECT SUM(AnswerValue)
					FROM SurveyAnswersSummary
					WHERE Year = $thisYear 
					AND WineryID = $winery[WineryID]
					AND SubSectionID = $ss[SubSectionID]
				");
				$eh = '';
				if ($sectionTotal > 0) {
					$eh = ' class="positive"';
				} elseif ($sectionTotal < 0) {
					$eh = ' class="negative"';
				}
				?>
				<td<?= $eh ?>><?= $sectionTotal ?></td>
			<?php
			}
			?>
		</tr>	
	<?php } ?>
	<tr>
	    <td class="wName">&nbsp;</td>
	    <?php foreach ($wineries as $w) {?>
	    <td class="wName"><?= $w['Name'] ?></td>
	    <?php } ?>
	</tr>
	<tr class="total">
		<td class="question">Total</td>
		<?php 
		foreach ($wineries as $w) {
			$grandTotal = (int) good_query_value("
				SELECT SUM(AnswerValue)
				FROM SurveyAnswersSummary
				WHERE Year = $thisYear 
				AND WineryID = $w[WineryID]
			");
			$eh = '';
			if ($grandTotal > 0) {
				$eh = ' class="positive"';
			} elseif ($grandTotal < 0) {
				$eh = ' class="negative"';
			}		
			?>
			<td<?= $eh ?>><?= $grandTotal ?></td>
		<?php }?>
	</tr> 
</table>
</div>