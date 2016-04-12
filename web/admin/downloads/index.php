<?php
require_once '../../vars.php';
connect2database();
if (isset($action) && strlen($action)) require_once 'actions.php';
include '../header.php';
$section = 'downloads';
require_once 'function.filesAndDirectories.php';
$download_directory = HomePathLocal . DownloadsPath;
$filez		= listFilesIn($download_directory);
$dloads		= good_query_table("SELECT * FROM Downloads");
//new dBug($filez);

?>
<div class="pretty_table_wrapper">


<h2>Downloads with a title</h2>
<table class="pretty">
<tr>
	<th>ID</th>
	<th>File</th>
	<th>Title</th>
	<th><!-- edit --></th>
	<th><!-- delete --></th>
</tr>
<?php
$existing_downloads = array();
foreach ($dloads as $d) {
$existing_downloads[] = $d['FileName'];
?>
<form name="change_download" action="?action=change_download" method="post">
<input type="hidden" name="DownloadID" value="<?= $d['DownloadID'] ?>" />
<tr>
	<td><?= $d['DownloadID'] ?></td>
	<td><input type="text" name="FileName" size="30" value="<?= $d['FileName'] ?>" /></td>
	<td><input type="text" name="Title" size="30" value="<?= $d['Title'] ?>" /></td>
	<td><button type="submit">edit</button></td>
	<td><button type="button" onclick="return deleteDownload(<?= $d['DownloadID'] ?>)">delete</button></td>
</tr>
</form>
<?php
}
?>
</table>
</div>
<hr />
<div class="pretty_table_wrapper">

<h2>Associate this title with this file</h2>
<form name="create_download" action="?action=create_download" method="post">
<table class="pretty">
<tr>
	<td>Title:</td>
	<td><input type="text" name="Title" size="30" /></td>
</tr>
<tr>
	<td>Choose file</td>
	<td>
	<select name="FileName">
	<?php
	foreach ($filez as $le_file) {
	if (!in_array($le_file, $existing_downloads)) {
		echo '<option value="'.$le_file.'">'.$le_file.'</option>';
		}
	}
	?>
	</select>
	</td>
</tr>
<tr>
	<td colspan="2" align="right"><button name="associate" type="submit">create association</button></td>
</tr>
</table>
</form>

<hr />

<h2>Upload a new file</h2>
<form name="upload_file" action="?action=upload_file" method="post" enctype="multipart/form-data">
<input type="file" name="phyle" />
<button name="upload" type="submit">upload</button>
</form>

</div>

<?php include '../footer.php'; ?>