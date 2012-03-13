<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Industrial";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">

<div class="sub-sidebar">

<?=BasicCms::block('industrial')?>

</div>

<div class="banners">
</div>

</div>

<?
include(ROOT.'/inc/footer.php');
?>