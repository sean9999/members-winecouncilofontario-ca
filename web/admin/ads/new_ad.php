<?php 
$ad = array();
?>

<form name="new_user" action="?action=create_thing" method="post">
	<div class="pretty_table_wrapper">
		<h1>add an ad</h1>
		<p class="instructions">Ads appear in the right-column for Member wineries and must be 240x400px in either gif, jpg, or png format. Animated gifs are allowed, but should have a filesize under 100kB.<br />
		Include a Title so it's easier to keep track of your ad.<br />
		The URL is optional, but is used if the ad needs to link to another (like a Vendor website).<br />
		The Description is optional as well. It is output in the &lt;title&gt; tag of the image.<br />
		The Start Date determines when the ad will start running on the site.<br />
		The End Date determines when the ad will cease running on the site.<br />
		In order for an ad to be visible, it must be set to 'Active'.<br /><br /></p>
		
		<table class="chunktable pretty" cellpadding="0" cellspacing="0">
			<?php 
				include 'ad_fields_new.php';
			?>
			<tr>
				<td colspan="2" align="right">
				<button type="reset" class="clear">Clear</button>
				<button type="submit" >Add the Ad</button>
				</td>
			</tr>
		</table>
	</div>
</form>