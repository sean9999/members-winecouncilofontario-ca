<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'survey';
$section_title	= $self;
instantiate_header ();
$header -> body_id = 'home';
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
include 'tempinc/widget_survey-location.php';
?>


<h1>Section Title</h1>
<p>Etiam lorem neque, vulputate vitae cursus vitae, pellentesque non nulla. Integer nec purus et justo lobortis varius at vitae neque. Pellentesque eu nisi sit amet dolor dictum pellentesque. Sed eu urna nisl. Curabitur at feugiat ligula. Sed convallis rhoncus elit, interdum faucibus diam fringilla in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec urna felis, porta sed iaculis in, scelerisque non nulla. Cras venenatis fermentum ullamcorper. Mauris faucibus ipsum eu erat fermentum quis rhoncus nulla semper. In vehicula tellus eu diam pretium quis faucibus massa semper. Phasellus at est leo, eget sodales risus.</p>

<div class="Survey">
<style>
	.sCommentAdd {
		display: none;
	}
</style>
<h2><span class="secNum">1</span><span class="secHead">Section Sub Heading</span></h2>
<?php include 'tempinc/widget_sQuestion.php'; ?>
<?php include 'tempinc/widget_sQuestion.php'; ?>
<?php include 'tempinc/widget_sQuestion.php'; ?>
<?php include 'tempinc/widget_sQuestion.php'; ?>
<h2><span class="secNum">1</span><span class="secHead">Section Sub Heading</span></h2>
<?php include 'tempinc/widget_sQuestion.php'; ?>
<?php include 'tempinc/widget_sQuestion.php'; ?>
<?php include 'tempinc/widget_sQuestion.php'; ?>
<?php include 'tempinc/widget_sQuestion.php'; ?>
<?php include 'tempinc/widget_sQuestion.php'; ?>


<div class="clearer"></div>

<div class="sButtons">
<button class="Survey right">Next Section &rarr;</button>
<button class="Survey centre">Save for Later</button>
<button class="Survey left">&larr; Previous Section</button>
</div>
<div class="clearer"></div>

</div>



<?php
include 'tempinc/widget_survey-location.php';
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