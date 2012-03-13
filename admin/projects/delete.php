<?php
require('../../inc/config.php');
$session->auth_or_redirect('admin', '/', true);

$id = (int)$_GET['id'];
header("Location: ./functions.php?f=delete&id=".$id);
?>