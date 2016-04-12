<?php
connect2database();
/*
$users = good_query_table("
	SELECT u.*, w.Name AS WineryName
	FROM Users AS u, Wineries AS w
	WHERE u.WineryID = w.WineryID
	AND u.Approved='True'
	ORDER BY WineryName ASC");
*/

$usersNew = good_query_table("SELECT * FROM Users WHERE Approved='False' ORDER BY WineryID");

$users = good_query_table("SELECT * FROM Users WHERE Approved='True' ORDER BY WineryID");

//USERS WITH TEMP PASSWORD
//$usersNew = good_query_table("SELECT * FROM Users WHERE Approved='False' AND Password='wines43592UTF8'");
?>

<div class="pretty_table_wrapper">
	<h2>New Applicants</h2>
	<p>&nbsp;&nbsp;Note that <strong>bolded</strong> applicants' wineries are members of the WCO whereas non-bolded wineries are not members of the WCO and will only have access to the Sustainability Survey.</p>
	<p>&nbsp;</p>
	<table border="1" class="pretty">
	<tr>
		<th class="name">Name</th>
		<th>Winery / Supplier</th>
		<th>User Level</th>
		<th class="email">Email</th>
		<th class="edit">EDIT</th>
		<th class="delete">DELETE</th>
	</tr>
	<?php 
	if (sizeof ($usersNew) == '0') echo '<tr><td colspan="7">There are no New Applicants</td></tr>';
	
	foreach ($usersNew as $uN) { 
		$wineryName = good_query_value("SELECT Name FROM Wineries WHERE WineryID = " . $uN['WineryID']);	
		$wineryMembership = good_query_value("SELECT IsMember FROM Wineries WHERE WineryID = " . $uN['WineryID']);	
	?>
	<tr>
		<td class="name"><strong><?php echo $uN['Name']; ?></strong><br />
		<em><?php echo $uN['Title']; ?></em></td>
		<td class="winery">
		<?php 
		if (!empty($wineryName)) {
			if ($wineryMembership == 1) {
				echo '<strong>';
				echo $wineryName;
				echo '</strong><br />'; 
			} else {
				echo $wineryName;
				echo '<br />'; 			
			}
		}
		
		if (!empty($uN['Company'])) {
			echo $uN['Company'];
			echo '<br /><br />';
		}		
		
		if ((!empty($wineryName)) && ($wineryMembership != 1)) { 
			echo '<strong>This is NOT a Member Winery</strong>'; 
		} elseif ($uN['WineryID'] == 99999) {
			echo '<em>Trade / Supplier / Non-Winery Applicant</em>';
		} elseif ($uN['WineryID'] == 88888) {
			echo '<strong>Winery Not Listed</strong>';
		}			
		
		?>
		</td>
		<td class="userlevel"><?php echo $uN['UserLevel']; ?></td>
		<td class="email"><?php echo $uN['Email']; ?></td>
		<td class="dedit"><a href="?view=user&UserID=<?= $uN['UserID'] ?>">EDIT</a></td>
		<td class="dedit"><a href="javascript:deleteUser(<?= $uN['UserID'] ?>)" class="delete">DELETE</a></td>
	</tr>
	<?php } ?>
	</table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h2>Registered Members (Winery Owners and Employees)</h2>
	<table border="1" class="pretty">
	<tr>
		<th class="name">Name</th>
		<th>Winery</th>
		<th>User Level</th>
		<th class="email">Email</th>
		<th class="edit">EDIT</th>
		<th class="delete">DELETE</th>
	</tr>
	<?php foreach ($users as $u) {
		$UserLevels = array('Owner', 'Employee');
		$UserLevel = $u['UserLevel'];
		if (in_array($UserLevel, $UserLevels)) {
		$wineryName = good_query_value("SELECT Name FROM Wineries WHERE WineryID = " . $u['WineryID']); 
		$wineryMembership = good_query_value("SELECT IsMember FROM Wineries WHERE WineryID = " . $u['WineryID']);	
	?>
	<tr>
		<td class="name"><strong><?php echo $u['Name']; ?></strong><br />
			<em><?php echo $u['Title']; ?></em></td>
		<td class="winery"><?php echo $wineryName ?></td>
		<td class="userlevel"><?php echo $u['UserLevel']; ?></td>
		<td class="email"><?php echo $u['Email']; ?></td>
		<td class="dedit"><a href="?view=user&UserID=<?= $u['UserID'] ?>">EDIT</a></td>
		<td class="dedit"><a href="javascript:deleteUser(<?= $u['UserID'] ?>)" class="delete">DELETE</a></td>
	</tr>
	<?php 
	}
	} ?>
	</table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h2>Non-Member Wineries (Non-Member)</h2>
	<table border="1" class="pretty">
	<tr>
		<th class="name">Name</th>
		<th>Winery</th>
		<th>User Level</th>
		<th class="email">Email</th>
		<th class="edit">EDIT</th>
		<th class="delete">DELETE</th>
	</tr>
	<?php foreach ($users as $u) {
		$UserLevels = array('Non-Member');
		$UserLevel = $u['UserLevel'];
		if (in_array($UserLevel, $UserLevels)) {
			if ($u['WineryID'] == 88888) {
				$wineryName = 'Non-Member / Winery Not Listed in Database'; 
			} else {
				$wineryName = good_query_value("SELECT Name FROM Wineries WHERE WineryID = " . $u['WineryID']); 
				$wineryMembership = good_query_value("SELECT IsMember FROM Wineries WHERE WineryID = " . $u['WineryID']);	
			}		
			?>
			<tr>
				<td class="name"><strong><?php echo $u['Name']; ?></strong><br />
					<em><?php echo $u['Title']; ?></em></td>
				<td class="winery"><?php echo $wineryName; ?></td>
				<td class="userlevel"><?php echo $u['UserLevel']; ?></td>
				<td class="email"><?php echo $u['Email']; ?></td>
				<td class="dedit"><a href="?view=user&UserID=<?= $u['UserID'] ?>">EDIT</a></td>
				<td class="dedit"><a href="javascript:deleteUser(<?= $u['UserID'] ?>)" class="delete">DELETE</a></td>
			</tr>
			<?php 
		}
	} ?>
	</table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h2>Trade Members (Trade)</h2>
	<table border="1" class="pretty">
	<tr>
		<th class="name">Name</th>
		<th>Notes</th>
		<th>User Level</th>
		<th class="email">Email</th>
		<th class="edit">EDIT</th>
		<th class="delete">DELETE</th>
	</tr>
	<?php 
	foreach ($users as $u) {
		$UserLevels = array('Trade');
		$UserLevel = $u['UserLevel'];
		if (in_array($UserLevel, $UserLevels)) {
			if ($u['WineryID'] == 99999) {
				$wineryName = 'Trade Member, Non-Winery'; 
			} else {
				$wineryName = good_query_value("SELECT Name FROM Wineries WHERE WineryID = " . $u['WineryID']); 
				$wineryMembership = good_query_value("SELECT IsMember FROM Wineries WHERE WineryID = " . $u['WineryID']);	
			}		
			?>
			<tr>
				<td class="name"><strong><?php echo $u['Name']; ?></strong><br />
					<em><?php echo $u['Title']; ?></em></td>
				<td class="winery"><?= $wineryName ?></td>
				<td class="userlevel"><?php echo $u['UserLevel']; ?></td>
				<td class="email"><?php echo $u['Email']; ?></td>
				<td class="dedit"><a href="?view=user&UserID=<?= $u['UserID'] ?>">EDIT</a></td>
				<td class="dedit"><a href="javascript:deleteUser(<?= $u['UserID'] ?>)" class="delete">DELETE</a></td>
			</tr>
<?php		}
		} ?>
	</table>
<style>
	td.name,
	td.title,
	td.email {
		width: 25%;
	}
	
	td.name {
		line-height: 25px;
	}
	
	td.userlevel {
		width: 150px;
	}
</style>	
	
	
</div>