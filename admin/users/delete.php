<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);
$id = addslashes($_GET['id']);
header("Location: ./functions.php?f=delete&id=$id");
?>