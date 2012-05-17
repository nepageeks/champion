<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Services";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">

<div class="sub-sidebar">

<h2><?=BasicCms::title('services')?></h2>

<?=BasicCms::block('services')?>

</div>

<div class="banners">
</div>

</div>

<?
include(ROOT.'/inc/footer.php');
?>