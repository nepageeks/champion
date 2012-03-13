<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="About Us";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">
<div class="sub-sidebar">

<?=BasicCms::block('about')?>
	
</div>

<div class="banners">

<img src="images/building.jpg" alt="" title="239 Pringle Street - Kingston PA 18704" />

<br /><br />

<div class="small-test">
<div class="testimonial">
<div class="testimonial-bg" style="padding-bottom: 50px;">

<big>&#8220;</big>In all aspects, Champion Builders, Inc. performed as the sole responsible General Contractor in a most professional manner. All conditions of the contract were met or exceeded without exception. The projects were constructed per plan and specifications, at the contract price and within the schedule established.<big>&#8221;</big>

<span>Gary R. Burcher, Senior Designer, Swendsen Engineering Inc.</span>

</div>
</div>
</div>
</div>
</div>

<?
include(ROOT.'/inc/footer.php');
?>