<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$id = (int)$_GET['id'];
header("Location: ./functions.php?f=delete&id=".$id);
?>