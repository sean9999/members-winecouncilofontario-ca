<?php
require_once 'vars.php';
$self = (basename($_SERVER['PHP_SELF']));
$section_id		= 'wines';
$section_title	= $self;

include '../inc/checkLogin.php';

include '../inc/actions.php';

instantiate_header ();

$header -> body_id = 'wines';
$header->addjs('/js/wine-delete.js');
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
	<h1>
	<?php
		enable_chunks();
		$chunk = getChunkByName('Your Wines');
		echo $chunk['Title'];
	?>
	</h1>

	<?php 	
			echo $chunk['Content'];
	?>
	
	<div class="clearer"></div>
	
	<p class="message"><?= $message ?></p>
	
	<table class="wines">
		<tr>
			<th class="brand"><a href="wines.php?Sort=Brand">Brand</a></th>
			<th class="name"><a href="wines.php?Sort=Name">Name</a></th>
			<th class="style"><a href="wines.php?Sort=Style">Style</a></th>
			<th class="edit"></th>
			<th class="delete"></th>			
		</tr>

		<?php 
		connect2database();

		//Sort 
		if(empty($_GET['Sort'])) $_GET['Sort'] = 'Brand'; 
		
		if($_GET['Sort'] == 'Brand') $sort = 'Brand ASC, Name ASC';
		if($_GET['Sort'] == 'Name') $sort = 'Name ASC';
		if($_GET['Sort'] == 'Style') $sort = 'Colour ASC, SpecialType ASC';		
				
		$wines = good_query_table("SELECT * FROM Wines WHERE WineryID = " . $userData['WineryID'] . " ORDER BY " . $sort);
		
		foreach($wines as $w)
		{
			$style = $w['Colour'];
			
			if ($w['SpecialType'] != '')
				$style .= ' ' . $w['SpecialType']
		?>
		<tr>
			<td class="brand"><a href="/wine.php?WineID=<?= $w['WineID']?>"><?= $w['Brand']?></a></td>		
			<td class="name"><a href="/wine.php?WineID=<?= $w['WineID']?>"><?= $w['Name']?></a></td>
			<td class="style"><a href="/wine.php?WineID=<?= $w['WineID']?>"><?= $style ?></a></td>
			<td class="edit"><a href="/wine.php?WineID=<?= $w['WineID']?>" title="Edit your bottle">Edit</a></td>
			<td class="delete"><a href="javascript:deleteWine(<?= $w['WineID'] ?>)" title="Delete this bottle">Delete</a></td>			
		</tr>
		<?php } ?>
	</table>


	<div class="clearer"></div>
	
	
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