<form name="new_winery" action="?action=create_winery" method="post">
	<div class="pretty_table_wrapper">
		<h1>Add a Winery or Trade / Supplier</h1>
		
		<table class="pretty fixedWidth" cellpadding="0" cellspacing="0">
			<tr>
				<td>Name:</td>
				<td><input type="text" name="Name" value="<?= $Name ?>" class="full_width" /></td>
			</tr>
			<tr class="hide">
				<td>SEONAME:</td>
				<td><input type="text" name="SEOName" value="<?= $SEOName ?>" class="full_width" /></td>
			</tr>
			<tr class="hidden">
				<td>Number:</td>
				<td><input type="text" name="WineryNumber" value="<?= $WineryNumber ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><textarea name="Description" class="full_width richText tinyMCE tinymce" rows="10"><?= stripslashes($Description) ?></textarea>
				<p class="toggler"><a href="javascript:toggleEditor('Description');">[ RTF / HTML ]</a></p></td>
			</tr>
			<?php /*
			<tr>
				<td>Description:</td>
				<td><textarea name="Description" class="full_width tinymce" rows="10"><?= stripslashes($Description) ?></textarea></td>
			</tr>
			*/ ?>
			<tr>
				<td>Region:</td>
				<td>
				<select name="RegionID" class="full_width">
					<option value="0"> -- No Region Selected (leave empty for Trade or Inactive Wineries) --</option>
					<?php
					$regions = good_query_table("SELECT RegionID,Name FROM Regions ORDER BY Name ASC");
					foreach ($regions as $r) {
					echo '<option value="'.$r['RegionID'].'">'.$r['Name'].'</option>';
					}
					?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Wine Maker(s):</td>
				<td><input type="text" name="WineMakers" value="<?= $WineMakers ?>" class="full_width" /></td>
			</tr>
			<input type="hidden" name="FeaturedWineID" value="0" />
			<?php /*
			<tr>
				<td>Winemakers' choice:</td>
				<td>
				<select name="FeaturedWineID">
				<?php
				$wines = good_query_table("SELECT WineID,Name FROM Wines ORDER BY Name ASC");
				foreach ($wines as $wine) {
				echo '<option value="'.$wine['WineID'].'">'.$wine['Name'].'</option>';
				}
				?>
				</select>
				</td>
			</tr>
			*/ ?>
			<tr class="hidden">
				<td>Wine Maker's Choice:</td>
				<td><input type="text" name="WineMakersChoice" value="<?= $WineMakersChoice ?>" class="full_width" /></td>
			</tr>
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
			<tr class="hidden">
				<td>Google Map Link:</td>
				<td><input type="text" name="GeoLocation" value="<?= $GeoLocation ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td><input type="text" name="Phone" value="<?= $Phone ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="Email" value="<?= $Email ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>Website:</td>
				<td><input type="text" name="Website" value="<?= $Website ?>" class="full_width" /></td>
			</tr>
			<tr>
				<td>Hours:</td>
				<td><textarea name="Hours" id="Hours" rows="3" class="full_width"><?= $Hours ?></textarea></td>
			</tr>
			<tr class="hidden">
				<td>Tour Hours:</td>
				<td><textarea name="TourHours" id="TourHours" rows="3" class="full_width"><?= $TourHours ?></textarea></td>
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
				<td>Is Winery:</td>
				<?php
				$extra_HTML = '';
				if($IsWinery) $extra_HTML = ' checked="checked"';
				?>
				<td><input type="checkbox" name="IsWinery" value="1" id="IsWinery"<?= $extra_HTML ?> /><br />
					<em>Check this box if this is a Winery rather than a Trade / Vendor / Supplier.</em></td>
			</tr>
			
			<tr>
				<td colspan="2" align="right">
				<button type="reset" class="clear">reset</button>
				<button type="submit">save</button>
				</td>
			</tr>
		</table>
	</div>
</form>