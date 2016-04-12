<?php
session_start();
$_SESSION['isLoggedIn'] = true;
$_SESSION['user'] = 'admin';
header("location: /admin/tinymce/jscripts/tiny_mce/plugins/imagemanager/index.php?type=im&page=index.html");
?>