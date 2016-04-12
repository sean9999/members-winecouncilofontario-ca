<?php
connect2database();
$users = good_query_table("
	SELECT u.*, w.Name AS WineryName
	FROM Users AS u, Wineries AS w
	WHERE u.WineryID = w.WineryID
	AND u.Approved='True'
	ORDER BY WineryName ASC");


$usersNew = good_query_table("SELECT * FROM Users WHERE Approved='False' ORDER BY WineryID");

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
		<th>Title</th>
		<th>Winery</th>
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
		<td><?php echo $uN['Name']; ?></td>
		<td><?php echo $uN['Title']; ?></td>
		<td <?php if ($wineryMembership == 1) echo 'class="member"'; ?>><?php echo $wineryName ?></td>
		<td><?php echo $uN['UserLevel']; ?></td>
		<td><?php echo $uN['Email']; ?></td>
		<td class="dedit"><a href="?view=user&UserID=<?= $uN['UserID'] ?>">EDIT</a></td>
		<td class="dedit"><a href="javascript:deleteUser(<?= $uN['UserID'] ?>)" class="delete">DELETE</a></td>
	</tr>
	<?php } ?>
	</table>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h2>Registered Users</h2>
	<table border="1" class="pretty">
	<tr>
		<th class="name">Name</th>
		<th>Title</th>
		<th>Winery</th>
		<th>User Level</th>
		<th class="email">Email</th>
		<th class="edit">EDIT</th>
		<th class="delete">DELETE</th>
	</tr>
	<?php foreach ($users as $u) {
		$wineryName = good_query_value("SELECT Name FROM Wineries WHERE WineryID = " . $u['WineryID']); 
		$wineryMembership = good_query_value("SELECT IsMember FROM Wineries WHERE WineryID = " . $u['WineryID']);	
	?>
	<tr>
		<td><?php echo $u['Name']; ?></td>
		<td><?php echo $u['Title']; ?></td>
		<td <?php if ($wineryMembership == 1) echo 'class="member"'; ?>><?php echo $wineryName ?></td>
		<td><?php echo $u['UserLevel']; ?></td>
		<td><?php echo $u['Email']; ?></td>
		<td class="dedit"><a href="?view=user&UserID=<?= $u['UserID'] ?>">EDIT</a></td>
		<td class="dedit"><a href="javascript:deleteUser(<?= $u['UserID'] ?>)" class="delete">DELETE</a></td>
	</tr>
	<?php } ?>
	</table>
</div>