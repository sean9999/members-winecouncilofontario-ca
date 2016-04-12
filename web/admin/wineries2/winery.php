<?php
connect2database();
require_once 'function.characterConversions.php';
$w = good_query_assoc('SELECT * FROM Wineries WHERE WineryID = ' . $_GET['WineryID']); 
extract($w);
?>

<div class="pretty_table_wrapper">

	<div class="breadcrumb"><h1><a href="index.php"><?= $section ?></a> &raquo; <?= $Name ?> <em>(ID number: <?= $WineryID ?>)</em></h1></div>
	
	<form method="post" action="?action=update_winery">
		<input type="hidden" name="WineryID" value="<?= $WineryID ?>" />
		
		<table class="pretty" cellpadding="0" cellspacing="0">
			<tr>
				<td class="leftCol">Number:</td>
				<td><input type="text" name="WineryNumber" value="<?= $WineryNumber ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>NAME:</td>
				<td><input type="text" name="Name" value="<?= $Name ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>SEONAME:</td>
				<td><input type="text" name="SEOName" value="<?= $SEOName ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>Region:</td>
				<td>
				<select name="RegionID">
				<option value="0"> -- No Region Selected --</option>
				<?php
				$regions = good_query_table("SELECT RegionID,Name FROM Regions ORDER BY Name ASC");
				foreach ($regions as $r) {
				if ($w['RegionID'] == $r['RegionID'])	$extra_HTML = ' selected="selected"';
				else									$extra_HTML = '';
				echo '<option value="'.$r['RegionID'].'"'.$extra_HTML.'>'.$r['Name'].'</option>';
				}
				?>
				</select>
				</td>
			</tr>
			<tr class="hidden">
				<td>DESCRIPTION:</td>
				<td><textarea name="Description" class="full_width richText tinyMCE tinymce" rows="10"><?= stripslashes($Description) ?></textarea>
				<p class="toggler"><a href="javascript:toggleEditor('Description');">[ RTF / HTML ]</a></p></td>
			</tr>
			
			<?php
			require_once 'function.filesAndDirectories.php';
			require_once 'function.characterConversions.php';
			$legalImgFolder	= LegalizeText(good_query_value("SELECT Name FROM Regions WHERE RegionID = $RegionID"));
			$path2Images	= HomePathLocal.WineryImagesPath.$legalImgFolder;
			$imgz			= listFilesIn($path2Images);
			
			?>
			<tr class="hidden">
				<td>Small Image</td>
				<td>
				<!--
				/<?= WineryImagesPath . '/' . $legalImgFolder .'/' ?>
				-->
				<select name="SmallImage1">
				<option value=""> -- no image -- </option>
				<?php
				foreach ($imgz as $i) {
					$extra_HTML = '';
					if ($i == $SmallImage1) $extra_HTML = ' selected="selected"';
					echo '<option value="'.$i.'"'.$extra_HTML.'>'.$i.'</option>';
				}
				?>
				</select>
				</td>
			</tr>
			<!--
			<tr>
				<td>Small Image 2:</td>
				<td>
				<select name="SmallImage2">
				<option value=""> -- no image -- </option>
				<?php
				foreach ($imgz as $i) {
					$extra_HTML = '';
					if ($i == $SmallImage2) $extra_HTML = ' selected="selected"';
					echo '<option value="'.$i.'"'.$extra_HTML.'>'.$i.'</option>';
				}
				?>
				</select>
				</td>
			</tr>
			-->
			<tr class="hidden">
				<td>Wine Maker's Choice:</td>
				<td><input type="text" name="WineMakersChoice" value="<?= $WineMakersChoice ?>" class="full_width" /></td>
			</tr>
			<tr>
			<tr class="hidden">
				<td>Best LCBO Brand:</td>
				<td><input type="text" name="BestLCBOBrand" value="<?= $BestLCBOBrand ?>" class="full_width" /></td>
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
				<td>Google Map Link:</td>
				<td><input type="text" name="GeoLocation" value="<?= $GeoLocation ?>" class="full_width" /></td>
			</tr>

			<tr class="hidden">
				<td>Latitude:</td>
				<td><input type="text" name="Latitude" value="<?= $Latitude ?>" class="full_width" /></td>
			</tr>
			<tr class="hidden">
				<td>Longitude:</td>
				<td><input type="text" name="Longitude" value="<?= $Longitude ?>" class="full_width" /></td>
			</tr>
			<tr class="hidden">
				<td colspan="2"><em>You can determine lat/long coordinates by entering the full address in this site: <a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">http://universimmedia.pagesperso-orange.fr/geo/loc.htm</a></em></td>
			</tr>
			
			<tr>
				<td>Phone:</td>
				<td><input type="text" name="Phone" value="<?= $Phone ?>" class="full_width" /></td>
			</tr>
			<tr class="hidden">
				<td>Email:</td>
				<td><input type="text" name="Email" value="<?= $Email ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>Website:</td>
				<td><input type="text" name="Website" value="<?= $Website ?>" class="full_width" /></td>
			</tr>
			<tr class="hidden">
				<td>Hours:</td>
				<td><textarea name="Hours" id="Hours" rows="3" class="full_width"><?= $Hours ?></textarea></td>
			</tr>
			<tr class="hidden">
				<td>Tour Hours:</td>
				<td><textarea name="TourHours" id="TourHours" rows="3" class="full_width"><?= $TourHours ?></textarea></td>
			</tr>
			<tr>
				<td>WCO Winery URL:</td>
				<td><input type="text" name="WCOURL" value="<?= $WCOURL ?>" class="full_width" /><br /><em>On the main winecountryontario.ca site (include 'http://')</em></td>
			</tr>
			
			<tr>
				<td>Is Member:</td>
				<?php
				$extra_HTML = '';
				if($IsMember) $extra_HTML = ' checked="checked"';
				?>
				<td><input type="checkbox" name="IsMember" value="1" id="IsMember"<?= $extra_HTML ?> /></td>
			</tr>


			<tr>
				<td colspan=2><h2>Contact Names</h2></td>
			</tr>
			<tr>
				<td><strong>Name</strong>, <br />Wine Maker(s):</td>
				<td><input type="text" name="WineMakers" value="<?= $WineMakers ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Email</strong>, <br />Wine Maker</td>
				<td><input type="text" name="WineMakersEmail" value="<?= $WineMakersEmail ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Phone</strong>, <br />Wine Maker</td>
				<td><input type="text" name="WineMakersPhone" value="<?= $WineMakersPhone ?>" class="full_width" /></td>
			</tr>
			<tr class="noHover">
				<td colspan=2><hr /></td>
			</tr>
			
			
			<tr>
				<td><strong>Name</strong>, <br />General Manager</td>
				<td><input type="text" name="GenMgrName" value="<?= $GenMgrName ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Email</strong>, <br />General Manager</td>
				<td><input type="text" name="GenMgrEmail" value="<?= $GenMgrEmail ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Phone</strong>, <br />General Manager</td>
				<td><input type="text" name="GenMgrPhone" value="<?= $GenMgrPhone ?>" class="full_width" /></td>
			</tr>
			<tr class="noHover">
				<td colspan=2><hr /></td>
			</tr>
			<tr>
				<td><strong>Name</strong>, <br />Marketing Manager</td>
				<td><input type="text" name="MktMgrName" value="<?= $MktMgrName ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Email</strong>, <br />Marketing Manager</td>
				<td><input type="text" name="MktMgrEmail" value="<?= $MktMgrEmail ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Phone</strong>, <br />Marketing Manager</td>
				<td><input type="text" name="MktMgrPhone" value="<?= $MktMgrPhone ?>" class="full_width" /></td>
			</tr>
			<tr class="noHover">
				<td colspan=2><hr /></td>
			</tr>
			<tr>
				<td><strong>Name</strong>, <br />Retail Manager</td>
				<td><input type="text" name="RetMgrName" value="<?= $RetMgrName ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Email</strong>, <br />Retail Manager</td>
				<td><input type="text" name="RetMgrEmail" value="<?= $RetMgrEmail ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Phone</strong>, <br />Retail Manager</td>
				<td><input type="text" name="RetMgrPhone" value="<?= $RetMgrPhone ?>" class="full_width" /></td>
			</tr>

			<tr class="noHover">
				<td colspan=2><hr /></td>
			</tr>
			<tr>
				<td><strong>Name</strong>, <br />PR Manager</td>
				<td><input type="text" name="PRName" value="<?= $PRName ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Email</strong>, <br />PR Manager</td>
				<td><input type="text" name="PREmail" value="<?= $PREmail ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Phone</strong>, <br />PR Manager</td>
				<td><input type="text" name="PRPhone" value="<?= $PRPhone ?>" class="full_width" /></td>
			</tr>
			<tr class="noHover">
				<td colspan=2><hr /></td>
			</tr>
			<tr>
				<td><strong>Title</strong>, <br />For an Additional Contact</td>
				<td><input type="text" name="OtherTitle" value="<?= $OtherTitle ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Name</strong>, <br />For an Additional Contact</td>
				<td><input type="text" name="OtherName" value="<?= $OtherName ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Email</strong>, <br />For an Additional Contact</td>
				<td><input type="text" name="OtherEmail" value="<?= $OtherEmail ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td><strong>Phone</strong>, <br />For an Additional Contact</td>
				<td><input type="text" name="OtherPhone" value="<?= $OtherPhone ?>" class="full_width" /></td>
			</tr>
			
			<tr class="noHover">
				<td colspan=2><hr /></td>
			</tr>
			
			
			<tr>
				<td colspan="2" align="right">
					<button type="reset" class="clear">reset</button>
					<button type="submit">save</button>
				</td>
			</tr>
		</table>
		<input type="hidden" name="FeaturedWineID" value="0" />
	</form>
</div>


