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

  <?php $testimonial = new Testimonial; $testimonial = $testimonial->random; ?>
  <big>&#8220;</big><?=$testimonial->text?><big>&#8221;</big>

  <span><?=$testimonial->name?>, <?=$testimonial->company?></span>

</div>
</div>
</div>
</div>
</div>

<?
include(ROOT.'/inc/footer.php');
?>