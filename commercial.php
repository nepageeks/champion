<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Commercial";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">

<div class="sub-sidebar">

<h2><?=BasicCms::title('commercial')?></h2>

<?=BasicCms::block('commercial')?>

</div>

<div class="banners">
</div>

</div>

<?
include(ROOT.'/inc/footer.php');
?>