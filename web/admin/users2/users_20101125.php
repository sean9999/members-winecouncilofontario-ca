<?php
connect2database();
$users = good_query_table("SELECT * FROM Users WHERE Approved='True'");
$usersNew = good_query_table("SELECT * FROM Users WHERE Approved='False'");

?>

<div class="pretty_table_wrapper">
	<h2>New Applicants</h2>
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
	?>
	<tr>
		<td><?php echo $uN['Name']; ?></td>
		<td><?php echo $uN['Title']; ?></td>
		<td><?php echo $wineryName ?></td>
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
	?>
	<tr>
		<td><?php echo $u['Name']; ?></td>
		<td><?php echo $u['Title']; ?></td>
		<td><?php echo $wineryName ?></td>
		<td><?php echo $u['UserLevel']; ?></td>
		<td><?php echo $u['Email']; ?></td>
		<td class="dedit"><a href="?view=user&UserID=<?= $u['UserID'] ?>">EDIT</a></td>
		<td class="dedit"><a href="javascript:deleteUser(<?= $u['UserID'] ?>)" class="delete">DELETE</a></td>
	</tr>
	<?php } ?>
	</table>
</div>