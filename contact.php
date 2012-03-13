<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Contact Us";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">
<div class="sub-sidebar" style="height: 550px;">

<?=BasicCms::block('contact')?>

</div>

<div class="banners">
<div class="contact">

<?php //include("contact_form.php"); ?>

</div>

</div>
</div>

<?
include(ROOT.'/inc/footer.php');
?>