<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'account';
$section_title	= 'Thanks for your Application';
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
	<p><a href="http://www.winecouncilofontario.ca" target="_blank">www.winecouncilofontario.ca</a></p>

	</div>
	
<div id="rightNav">
<div class="clearer"></div>
</div>
<div class="clearer"></div>
</div>
<?php include 'footer.php'; ?>