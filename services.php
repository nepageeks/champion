<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Services";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">

<div class="sub-sidebar">

<?=BasicCms::block('services')?>

</div>

<div class="banners">
</div>

</div>

<?
include(ROOT.'/inc/footer.php');
?>