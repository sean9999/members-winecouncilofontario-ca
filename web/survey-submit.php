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

<h1>Submit Your Results</h1>
<p>Etiam lorem neque, vulputate vitae cursus vitae, pellentesque non nulla. Integer nec purus et justo lobortis varius at vitae neque. Pellentesque eu nisi sit amet dolor dictum pellentesque. Sed eu urna nisl. Curabitur at feugiat ligula. Sed convallis rhoncus elit, interdum faucibus diam fringilla in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec urna felis, porta sed iaculis in, scelerisque non nulla. Cras venenatis fermentum ullamcorper. Mauris faucibus ipsum eu erat fermentum quis rhoncus nulla semper. In vehicula tellus eu diam pretium quis faucibus massa semper. Phasellus at est leo, eget sodales risus.</p>
<p>Vivamus blandit massa dui. Donec pellentesque, arcu in ultricies rhoncus, ligula justo pulvinar diam, nec vehicula enim urna id magna. Integer in tempor turpis. Maecenas at est justo, non posuere felis. Aenean tempus rutrum pretium. Aliquam at nisl quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam lectus lacus, mollis eget fermentum at, venenatis eget nisi. Donec pharetra dolor eget metus rhoncus lacinia. Nam dapibus, leo ut auctor volutpat, nisi odio tempus nulla, vitae hendrerit urna eros sed neque. In hac habitasse platea dictumst. Vestibulum suscipit, orci a mollis iaculis, turpis orci tristique risus, ut tristique ligula turpis at augue. Aliquam leo urna, hendrerit consectetur mollis sit amet, vehicula eu neque. Mauris condimentum odio in felis dictum consectetur. Ut imperdiet ornare tincidunt. Nullam ac justo justo, nec semper elit. Morbi consequat lectus sapien, in vulputate sapien.</p>


<button class="Survey right">Submit Your Results</button>

<div class="clearer"></div>


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