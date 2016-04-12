<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'account';
$section_title	= $self;
instantiate_header ();
$header -> body_id = 'home';
include 'header.php';
?>

<div class="clearer"></div>


<div id="mainNav">
</div>

<div id="mainContent">

	<div id="Content">

	<h1>Thanks!</h1>
	<p>The Wines of Ontario will review your application shortly and be in touch if there are any questions. In the meantime, why not check out our main website?</p>
	<p><a href="http://www.winesofontario.org" target="_blank">www.winesofontario.org</a></p>

	</div>
	
<div id="rightNav">
<div class="clearer"></div>
</div>
<div class="clearer"></div>
</div>
<?php include 'footer.php'; ?>