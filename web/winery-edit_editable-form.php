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


<table class="form">
	<tr>
		<td class="left">
			Winery Name:
		</td>
		<td class="right">
			<input type="text" type="text" name="Name" value="<?= $Name ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Winery Description:
		</td>
		<td class="right">
			<textarea name="Description" id="#" value="" width="50" rows="5"><?= strip_tags(stripslashes($Description)) ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="left">
			Wine Maker(s):
		</td>
		<td class="right">
			<input type="text" name="WineMakers" value="<?= $WineMakers ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Wine Maker's Choice:
		</td>
		<td class="right">
			<input type="text" name="WineMakersChoice" value="<?= $WineMakersChoice ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Best LCBO Brand:
		</td>
		<td class="right">
			<input type="text" name="BestLCBOBrand" value="<?= $BestLCBOBrand ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Street Address:
		</td>
		<td class="right">
			<input type="text" name="Address" value="<?= $Address ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Town:
		</td>
		<td class="right">
			<input type="text" name="Town" value="<?= $Town ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Postal Code:
		</td>
		<td class="right">
			<input type="text" name="Province" value="<?= $Province ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Google Map Link:
		</td>
		<td class="right">
			<input type="text" name="GeoLocation" value="<?= $GeoLocation ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Phone:
		</td>
		<td class="right">
			<input type="text" name="Phone" value="<?= $Phone ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Email:
		</td>
		<td class="right">
			<input type="text" name="Email" value="<?= $Email ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Website:
		</td>
		<td class="right">
			<input type="text" name="Website" value="<?= $Website ?>" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Hours:
		</td>
		<td class="right">
			<textarea class="notAsTall" name="Hours" id="Hours" width="50" rows="3"><?= $Hours ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="left">
			Tour Hours:
		</td>
		<td class="right">
			<textarea class="notAsTall" name="TourHours" id="TourHours" width="50" rows="3"><?= $TourHours ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			<button type="submit" name="save" class="submit right">Update Your Winery</button>
		</td>
	</tr>
	

</table>

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