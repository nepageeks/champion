<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

include(ROOT.'/inc/header.php');
?>

<?=BasicCms::block($_GET['page']);?>

<?
include(ROOT.'/inc/footer.php');
?>