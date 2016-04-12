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

	<h1>Ut urna purus, accumsan ut bibendum</h1>
	<h2>Quis euismod eu mi</h2>
	<p>Etiam lorem neque, vulputate vitae cursus vitae, pellentesque non nulla. Integer nec purus et justo lobortis varius at vitae neque. Pellentesque eu nisi sit amet dolor dictum pellentesque. Sed eu urna nisl. Curabitur at feugiat ligula. Sed convallis rhoncus elit, interdum faucibus diam fringilla in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec urna felis, porta sed iaculis in, scelerisque non nulla. Cras venenatis fermentum ullamcorper. Mauris faucibus ipsum eu erat fermentum quis rhoncus nulla semper. In vehicula tellus eu diam pretium quis faucibus massa semper. Phasellus at est leo, eget sodales risus.</p>
	<h3>Maecenas ac odio at massa interdum vulputate ut sed nisl</h3>
	<p>Vivamus blandit massa dui. Donec pellentesque, arcu in ultricies rhoncus, ligula justo pulvinar diam, nec vehicula enim urna id magna. Integer in tempor turpis. Maecenas at est justo, non posuere felis. Aenean tempus rutrum pretium. Aliquam at nisl quam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam lectus lacus, mollis eget fermentum at, venenatis eget nisi. Donec pharetra dolor eget metus rhoncus lacinia. Nam dapibus, leo ut auctor volutpat, nisi odio tempus nulla, vitae hendrerit urna eros sed neque. In hac habitasse platea dictumst. Vestibulum suscipit, orci a mollis iaculis, turpis orci tristique risus, ut tristique ligula turpis at augue. Aliquam leo urna, hendrerit consectetur mollis sit amet, vehicula eu neque. Mauris condimentum odio in felis dictum consectetur. Ut imperdiet ornare tincidunt. Nullam ac justo justo, nec semper elit. Morbi consequat lectus sapien, in vulputate sapien.</p>
	<p>Ut nunc lectus, pharetra at semper vehicula, sollicitudin sit amet ipsum. Proin gravida volutpat tellus vel blandit. Morbi faucibus congue malesuada. Nulla facilisi. Pellentesque a scelerisque lacus. Curabitur condimentum, tortor vitae tincidunt scelerisque, mauris risus lobortis leo, tristique ullamcorper ipsum massa ac urna. Cras porttitor lacinia metus nec venenatis. Nullam sed nunc vel magna dictum tincidunt et eu orci. Praesent eros nulla, commodo eget luctus a, laoreet vel sapien. Integer quis ligula odio, vitae ultrices ipsum. Maecenas est risus, scelerisque eu rutrum ut, pellentesque in lectus. Suspendisse sed nisl in lacus bibendum aliquam. Sed eget lectus neque. Nunc auctor, lectus id tincidunt bibendum, felis tellus semper tellus, sit amet scelerisque ante magna at sapien. Mauris aliquet risus et orci dictum porta. Nunc vitae quam eros. Pellentesque aliquet, metus vel euismod dictum, eros arcu lacinia eros, vel consequat nibh odio vitae arcu.</p>
	<h3>Cras lorem massa, volutpat ac pretium molestie, semper sed leo</h3>
	<p>Nunc posuere lacus mollis diam ornare eget luctus eros elementum. Proin sit amet pretium sem. Nam porttitor vestibulum lacus at rhoncus. Suspendisse potenti. Phasellus fringilla eros ac lectus sollicitudin pretium. Phasellus sapien eros, dictum vitae condimentum ac, consequat sed enim. Nam et felis mi, at lacinia mi. Vivamus molestie congue est et pellentesque. Maecenas vehicula mauris pretium quam tincidunt suscipit. Ut rhoncus, turpis eu vehicula iaculis, tellus purus pharetra mauris, vitae luctus augue eros a nisi. Cras tempor feugiat metus et porta.</p>
	<p>Curabitur vehicula commodo dui, vel volutpat nunc ultricies eu. Pellentesque eu pulvinar est. Nulla facilisi. Praesent eu metus a lacus condimentum vulputate eu quis nisl. Sed ipsum sapien, tristique non posuere ut, suscipit eu ligula. In elementum tristique enim sit amet interdum. Fusce eget augue arcu. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer faucibus tortor ac nunc porttitor vel elementum diam rutrum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum mauris at nunc vulputate ut mollis nibh malesuada. Cras tincidunt volutpat venenatis.</p>

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