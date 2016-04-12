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

	<h1>Survey Landing Page</h1>
	<h2>Here's some content about the survey</h2>
	<p>Etiam lorem neque, vulputate vitae cursus vitae, pellentesque non nulla. Integer nec purus et justo lobortis varius at vitae neque. Pellentesque eu nisi sit amet dolor dictum pellentesque. Sed eu urna nisl. Curabitur at feugiat ligula. Sed convallis rhoncus elit, interdum faucibus diam fringilla in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec urna felis, porta sed iaculis in, scelerisque non nulla. Cras venenatis fermentum ullamcorper. Mauris faucibus ipsum eu erat fermentum quis rhoncus nulla semper. In vehicula tellus eu diam pretium quis faucibus massa semper. Phasellus at est leo, eget sodales risus.<br /></p>
	<p>&nbsp;</p>
	<h2>Sections in the Survey</h2>
	<ol id="surveyList">
	<li><p><a href="/survey-typical.php">Survey Section</a></p></li>
	<li><p><a href="/survey-typical.php">Survey Section</a></p></li>
	<li><p><a href="/survey-typical.php">Survey Section</a></p></li>
	<li><p><a href="/survey-typical.php">Survey Section</a></p></li>
	<li><p><a href="/survey-typical.php">Survey Section</a></p></li>
	<li><p><a href="/survey-typical.php">Survey Section</a></p></li>
	<li><p><a href="/survey-typical.php">Survey Section</a></p></li>
	<li><p><a href="/survey-typical.php">Survey Section</a></p></li>
	</ol>
	<button class="Survey right">Start the Survey!</button>
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