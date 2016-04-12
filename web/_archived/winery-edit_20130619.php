<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'winery';
$section_title	= $self;

include '../inc/checkLogin.php';

connect2database();
require_once 'function.characterConversions.php';

//Handle update
$message = '';

if($_GET['action'] == 'update_winery')
{
	good_query("UPDATE Wineries SET Name = '" . $_POST['Name'] . "', Description = '" . $_POST['Description'] . "', WineMakers = '" . $_POST['WineMakers'] . "', WineMakersChoice = '" . $_POST['WineMakersChoice'] . "', BestLCBOBrand = '" . $_POST['BestLCBOBrand'] . "', Address = '" . $_POST['Address'] . "', Town = '" . $_POST['Town'] . "', Province = '" . $_POST['Province'] . "', GeoLocation = '" . $_POST['GeoLocation'] . "', Phone = '" . $_POST['Phone'] . "', Email = '" . $_POST['Email'] . "', Website = '" . $_POST['Website'] . "', Hours = '" . $_POST['Hours'] . "', TourHours = '" . $_POST['TourHours'] . "' WHERE WineryID = " . $userData['WineryID']);
	
	$message = 'You just updated your winery';
}

$w = good_query_assoc('SELECT * FROM Wineries WHERE WineryID = ' . $userData['WineryID']); 
extract($w);

instantiate_header ();
$header -> body_id = 'winery';

$header->addcss('/lib/colorbox/example2/colorbox.css');
$header->addjs('/lib/colorbox/jquery.colorbox-min.js"');
$header->addrawjs('
	$(document).ready(function(){
		$(".preview").colorbox({width:"680", height:"600", iframe:true});
	});
');			

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
<?php if ($S['IsMember'] > 0) { ?>


<h1><?= $Name ?> Information</h1>
	<?php
		enable_chunks();
		$chunk = getChunkByName('Winery Edit');
		echo $chunk['Content'];
	?>


<p class="message"><?= $message ?></p>


<form method="post" action="winery-edit.php?action=update_winery" onsubmit="return submitEvent(this)">
<input type="hidden" name="WineryID" value="<?= $WineryID ?>" />


<h2><em>Winery Name:</em> <?= $Name ?></h2>
<p><em>Winery Description:</em><br />
<strong><?= strip_tags(stripslashes($Description)) ?></strong></p>
<p><em>Wine Maker(s):</em> <strong><?= $WineMakers ?></strong></p>
<p><em>Wine Maker's Choice:</em> <strong><?= $WineMakersChoice ?></strong></p>
<p><em>Best LCBO Brand:</em> <strong><?= $BestLCBOBrand ?></strong></p>
<p><em>Street Address:</em> <strong><?= $Address ?></strong></p>
<p><em>Town:</em> <strong><?= $Town ?></strong></p>
<p><em>Postal Code:</em> <strong><?= $Province ?></strong></p>
<p><em>Google Map Link:</em> <strong><?= $GeoLocation ?></strong></p>
<p><em>Phone:</em> <strong><?= $Phone ?></strong></p>
<p><em>Email:</em> <strong><?= $Email ?></strong></p>
<p><em>Website:</em>  <strong><?= $Website ?></strong></p>
<p><em>Hours:</em> <strong><?= $Hours ?></strong></p>
<p><em>Tour Hours:</em> <strong><?= $TourHours ?></strong></p>
</form>

<?php if ( $WineryID !== '300')

{ ?>

<p class="right"><a class="bold preview" href="http://winesofontario.pimediastaging.com/pop_winery.php?WineryID=<?= $WineryID ?>" target="_blank">View Your Winery on the Wines of Ontario Website &rarr;</a></p>

<?php } ?>

<?php
	}
	else
	{
	echo '<p>You must be a Wines of Ontario member to view this page.</p>';
	}
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