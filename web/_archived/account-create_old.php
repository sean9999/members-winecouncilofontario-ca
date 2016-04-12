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

<h1>Ut urna purus, accumsan ut bibendum</h1>
<p>Nunc posuere lacus mollis diam ornare eget luctus eros elementum. Proin sit amet pretium sem. Nam porttitor vestibulum lacus at rhoncus. Suspendisse potenti. Phasellus fringilla eros ac lectus sollicitudin pretium. Phasellus sapien eros, dictum vitae condimentum ac, consequat sed enim. Nam et felis mi, at lacinia mi. Vivamus molestie congue est et pellentesque. Maecenas vehicula mauris pretium quam tincidunt suscipit. Ut rhoncus, turpis eu vehicula iaculis, tellus purus pharetra mauris, vitae luctus augue eros a nisi. Cras tempor feugiat metus et porta.</p>

<table class="form">
	<tr>
		<td class="left">
			Name:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>
	<tr>
		<td class="left">
			Title:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			Email:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			Password:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			Re-enter Password:
		</td>
		<td class="right">
			<input type="text" name="#" id="#" value="" width="50" />
		</td>
	</tr>	
	<tr>
		<td class="left">
			Winery:
		</td>
		<td class="right">
			<?php
			connect2database ();
			$wineries = good_query_table("SELECT * FROM Wineries WHERE IsMember > 0 ORDER BY Name" );
			?>
			<select name="#">
				<option value=""> - Select Your Winery - </option>
				<?php
				foreach ($wineries as $w) {
				echo '<option value="';
				echo $w['WineryID'];
				echo '">';
				echo $w['Name'];
				echo '</option>';
				}
				?>
			</select>
		</td>
	</tr>	
	<tr>
		<td class="left">
			Notes:
		</td>
		<td class="right">
			<textarea name="#" id="#" cols="50" rows="5"></textarea>
		</td>
	</tr>
	<tr>
		<td class="left">
			
		</td>
		<td class="right">
			<button class="submit">Submit</button>
		</td>
	</tr>
	

</table>

</div>
	
<div id="rightNav">
<div class="clearer"></div>
</div>
<div class="clearer"></div>
</div>
<?php include 'footer.php'; ?>