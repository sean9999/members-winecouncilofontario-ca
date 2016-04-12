<script type="text/javascript">
<!--
	$(document).ready(function(){
		$(".linkClass<?php echo $q['QuestionID'];?>").colorbox({
			width:"600", 
			inline:true, 
			href:"#divId<?php echo $q['QuestionID'];?>",
			slideshow: false
		});
	});
//-->
</script>
<div class="sWrapper">
	<div class="sNumber">
		<p><?php echo $q['SectionNumber'] . '.' . $q['SubSectionNumber'] . '.' . $q['QuestionNumberA']; if($q['QuestionNumberB'] != '0')  echo '.' . $q['QuestionNumberB'];?></p>
	</div>
	<div class="sQuestion">
		<div class="sContent">
			<p><?= strip_tags($q['Question']); ?></p>
		</div>
			<ul class="sMore">
				<li <?php if($q['MoreInfo'] == '') echo 'style="border-right:0px" '; ?>class="sComment"><a href="javascript:unhide('comment<?php echo $q['QuestionID'];?>');">Add a Comment</a></li>
				<li <?php if($q['MoreInfo'] == '') echo 'style="visibility:hidden" '; ?>class="sInfo"><a href="#" class="linkClass<?php echo $q['QuestionID'];?>">More Information</a></li>
			</ul>
	</div>	
	<div style='display:none'>
		<div id="divId<?= $q['QuestionID'];?>" style="padding:10px; background:#fff;">
			<div class="surveyMoreInformation">
				<?php 
					echo '<h3>';
					echo strip_tags($q['Question']);
					echo '</h3>';
					echo '<p>';
					echo $q['MoreInfo'];
					echo '</p>';
				?>
			</div>
		</div>
	</div>
	<div class="sValues">
		<p>
			<input type="radio" name="<?php echo $q['QuestionID'];?>" onclick="autosave(this,'<?= $_SESSION['userID'] ?>')" value="Yes" <?php if($Answer['Answer'] == 'Yes') echo 'checked="checked" ';?> <?php if($Answer['Submitted'] == 'True') echo 'disabled="disabled" '; ?>> Yes 
			<input type="radio" name="<?php echo $q['QuestionID'];?>" onclick="autosave(this,'<?= $_SESSION['userID'] ?>')" value="No"  <?php if($Answer['Answer'] == 'No')  echo 'checked="checked "';?> <?php if($Answer['Submitted'] == 'True') echo 'disabled="disabled" '; ?>> No 
			<input type="radio" name="<?php echo $q['QuestionID'];?>" onclick="autosave(this,'<?= $_SESSION['userID'] ?>')" value="N/A" <?php if($Answer['Answer'] == 'N/A') echo 'checked="checked" ';?> <?php if($Answer['Submitted'] == 'True') echo 'disabled="disabled" '; ?>> N/A
		</p>
	</div>
	<div  class="clearer"></div>
	<div id="comment<?php echo $q['QuestionID'];?>" class="sCommentAdd" <?php if($Answer['Comments'] <> '') echo 'style="display:block"';?>>
		<textarea onblur="autosavecomment(this.value,'<?= $q['QuestionID'] ?>','<?= $_SESSION['userID'] ?>')" name="comment<?php echo $q['QuestionID'];?>" class="sComment" width="40" <?php if($Answer['Submitted'] == 'True') echo 'disabled="disabled"'; ?>><?php echo $Answer['Comments'];?></textarea>
		<p class="sComment"><a href="javascript:hide('comment<?php echo $q['QuestionID'];?>');">Hide Comment</a></p>
	</div>
	<div class="clearer"></div>
	<?php 
		if(isset($lastYear)) {	
			$lastAnswer = good_query_value("
				SELECT	Answer
				FROM	SurveyAnswers
				WHERE	QuestionID = $q[QuestionID]
				AND		WineryID = $userData[WineryID]
				AND		YEAR(ztamp) = " . date('Y')-1 . "
			");
	?>
	<div>
		<p class="lastYear"> <?php echo $lastAnswer ? "In last year's survey you answered: <strong>$lastAnswer</strong>" : "<em>You don't have an answer for this question in last year’s survey.</em>" ?></p>
	</div>
	<?php }?>
</div>
