<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'winery';
$section_title	= $self;

include '../inc/checkLogin.php';

connect2database();
require_once 'function.characterConversions.php';

//var_dump($userData);

//Handle update
$message = '';

if($_GET['action'] == 'update_winery')
{
	good_query("
		UPDATE Wineries SET
			GenMgrName = '" . $_POST['GenMgrName'] . "',
			GenMgrEmail = '" . $_POST['GenMgrEmail'] . "',
			GenMgrPhone = '" . $_POST['GenMgrPhone'] . "',
			MktMgrName = '" . $_POST['MktMgrName'] . "',
			MktMgrEmail = '" . $_POST['MktMgrEmail'] . "',
			MktMgrPhone = '" . $_POST['MktMgrPhone'] . "',
			RetMgrName = '" . $_POST['RetMgrName'] . "',
			RetMgrEmail = '" . $_POST['RetMgrEmail'] . "',
			RetMgrPhone = '" . $_POST['RetMgrPhone'] . "',
			PRName = '" . $_POST['PRName'] . "',
			PREmail = '" . $_POST['PREmail'] . "',
			PRPhone = '" . $_POST['PRPhone'] . "',
			OtherTitle = '" . $_POST['OtherTitle'] . "',
			OtherName = '" . $_POST['OtherName']. "',
			OtherEmail = '" . $_POST['OtherEmail']. "',
			OtherPhone = '" . $_POST['OtherPhone'] . "',
			LicenseeTitle = '" . $_POST['LicenseeTitle'] . "',
			LicenseeName = '" . $_POST['LicenseeName']. "',
			LicenseeEmail = '" . $_POST['LicenseeEmail']. "',
			LicenseePhone = '" . $_POST['LicenseePhone'] . "',
			WineMakers = '" . $_POST['WineMakers'] . "',
			WineMakersEmail = '" . $_POST['WineMakersEmail']. "',
			WineMakersPhone = '" . $_POST['WineMakersPhone'] . "',
			Address = '" . $_POST['Address']. "',
			Town = '" . $_POST['Town'] . "',
			Province = '" . $_POST['Province'] . "',
			Phone = '" . $_POST['Phone']. "',
			Website = '" . $_POST['Website'] . "'
		WHERE WineryID = " . $userData['WineryID']
	);
	$message = 'You just updated your winery';
}

$w = good_query_assoc('SELECT * FROM Wineries WHERE WineryID = ' . $userData['WineryID']); 
extract($w);

instantiate_header ();
$header -> body_id = 'winery';


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
	$UserLevels = array('Owner', 'Employee');
	if (in_array($UserLevel, $UserLevels)) {
?>

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
			<td colspan="2">
				<h2>Winery Information</h2>
			</td>
		</tr>
		<tr>
			<td>Street Address:</td>
			<td><input type="text" name="Address" value="<?= $Address ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td>Town:</td>
			<td><input type="text" name="Town" value="<?= $Town ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td>Postal Code:</td>
			<td><input type="text" name="Province" value="<?= $Province ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td><input type="text" name="Phone" value="<?= $Phone ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td>Website:</td>
			<td><input type="text" name="Website" value="<?= $Website ?>" class="full_width" /></td>
		</tr>
		<tr class="divider">
			<td colspan=2><hr class="divider" /></td>
		</tr>
		
		
		
		

		<tr>
			<td colspan="2">
				<h2>Wine Maker</h2>
			</td>
		</tr>
		<tr>
			<td><strong>Name</strong></td>
			<td><input type="text" name="WineMakers" value="<?= $WineMakers ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td><input type="text" name="WineMakersEmail" value="<?= $WineMakersEmail ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Phone</strong></td>
			<td><input type="text" name="WineMakersPhone" value="<?= $WineMakersPhone ?>" class="full_width" /></td>
		</tr>
		<tr class="divider">
			<td colspan=2><hr class="divider" /></td>
		</tr>

		<tr>
			<td colspan="2">
				<h2>General Manager</h2>
			</td>
		</tr>
		<tr>
			<td><strong>Name</strong></td>
			<td><input type="text" name="GenMgrName" value="<?= $GenMgrName ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td><input type="text" name="GenMgrEmail" value="<?= $GenMgrEmail ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Phone</strong></td>
			<td><input type="text" name="GenMgrPhone" value="<?= $GenMgrPhone ?>" class="full_width" /></td>
		</tr>
		<tr class="divider">
			<td colspan=2><hr class="divider" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<h2>Marketing Manager</h2>
			</td>
		</tr>
		<tr>
			<td><strong>Name</strong></td>
			<td><input type="text" name="MktMgrName" value="<?= $MktMgrName ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td><input type="text" name="MktMgrEmail" value="<?= $MktMgrEmail ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Phone</strong></td>
			<td><input type="text" name="MktMgrPhone" value="<?= $MktMgrPhone ?>" class="full_width" /></td>
		</tr>
		<tr class="divider">
			<td colspan=2><hr class="divider" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<h2>Retail Manager</h2>
			</td>
		</tr>
		<tr>
			<td><strong>Name</strong></td>
			<td><input type="text" name="RetMgrName" value="<?= $RetMgrName ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td><input type="text" name="RetMgrEmail" value="<?= $RetMgrEmail ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Phone</strong></td>
			<td><input type="text" name="RetMgrPhone" value="<?= $RetMgrPhone ?>" class="full_width" /></td>
		</tr>

		<tr class="divider">
			<td colspan=2><hr class="divider" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<h2>PR Manager</h2>
			</td>
		</tr>
		<tr>
			<td><strong>Name</strong></td>
			<td><input type="text" name="PRName" value="<?= $PRName ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td><input type="text" name="PREmail" value="<?= $PREmail ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Phone</strong></td>
			<td><input type="text" name="PRPhone" value="<?= $PRPhone ?>" class="full_width" /></td>
		</tr>
		<tr class="divider">
			<td colspan=2><hr class="divider" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<h2>Other, <em>Additional Contact</em></h2>
			</td>
		</tr>
		<tr>
			<td><strong>Title</strong></td>
			<td><input type="text" name="OtherTitle" value="<?= $OtherTitle ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Name</strong></td>
			<td><input type="text" name="OtherName" value="<?= $OtherName ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td><input type="text" name="OtherEmail" value="<?= $OtherEmail ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Phone</strong></td>
			<td><input type="text" name="OtherPhone" value="<?= $OtherPhone ?>" class="full_width" /></td>
		</tr>

		<tr>
			<td colspan="2">
				<h2>Licensee, <em>Additional Contact</em></h2>
			</td>
		</tr>
		<tr>
			<td><strong>Title</strong></td>
			<td><input type="text" name="LicenseeTitle" value="<?= $LicenseeTitle ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Name</strong></td>
			<td><input type="text" name="LicenseeName" value="<?= $LicenseeName ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Email</strong></td>
			<td><input type="text" name="LicenseeEmail" value="<?= $LicenseeEmail ?>" class="full_width" /></td>
		</tr>
		<tr>
			<td><strong>Phone</strong></td>
			<td><input type="text" name="LicenseePhone" value="<?= $LicenseePhone ?>" class="full_width" /></td>
		</tr>

		<tr>
			<td class="left">
				
			</td>
			<td class="right">
				<button type="submit" class="submit">Update Your Winery</button>
			</td>
		</tr>
	</table>
</form>

<?php if ( $WineryID !== '300')

{ ?>

<p class="right"><a href="/pop_member.php?WineryID=<?= $WineryID ?>" class="bold colorbox" target="_blank">View Your Winery on the Wines of Ontario Website &rarr;</a></p>

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