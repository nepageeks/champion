<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Authorized Supplier of Kirby Building Systems";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">

<div class="sub-sidebar">

<h2><?=BasicCms::title('kirby')?></h2>

<?=BasicCms::block('kirby')?>

</div>

<div class="banners">
</div>

</div>

<?
include(ROOT.'/inc/footer.php');
?>