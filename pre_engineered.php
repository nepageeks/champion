<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Pre-Engineered";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">

<div class="sub-sidebar">

<h2><?=BasicCms::title('pre_engineered')?></h2>

<?=BasicCms::block('pre_engineered')?>

</div>

<div class="banners">
</div>

</div>

<?
include(ROOT.'/inc/footer.php');
?>