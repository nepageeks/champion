<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="(570) 283-2529 | Kingston, PA";
$bg="green";

include(ROOT.'/inc/header.php');
?>

<div class="more-projects"><a href="projects.php"><img src="images/more-projects.png" alt="" title="View Our Projects" /></a></div>

<div class="content">
<div class="banner">

	<div style="position: relative;" class="slideshow">
    <a href="projects.php" title="View our Projects"><img src="images/banners/banner1.jpg" alt="" /></a>
    <a href="projects.php" title="View our Projects"><img src="images/banners/banner2.jpg" alt="" /></a>
    <a href="projects.php" title="View our Projects"><img src="images/banners/banner4.jpg" alt="" /></a>
	</div>


</div>
<div class="sidebar">
<div class="overlap">

<div class="readmoreimg"><a href="about.php"><img src="images/readmore.png" alt="Read More..." title="Read More &rarr;" /></a></div>

<?=String::truncate(BasicCms::block('about'), 500, '')?>

<!--<div class="readmore"><a href="">Read More</a> &rarr;</div>-->

</div>
</div>
<div class="banners" style="border-right: 1px solid #b5b5b5;">

<a href="about.php"><img src="images/banners/aboutus.jpg" title="About Champion Builders, Inc." alt="" /></a>
<a href="services.php"><img src="images/banners/services.jpg" title="View our List of Services" alt="" /></a>
<a href="projects.php"><img src="images/banners/projects.jpg" title="View our Projects" alt="" /></a>
<a href="quote.php"><img src="images/banners/quote.jpg" title="Get a Quote" alt="" /></a>
<a href="kirby.php"><img src="images/banners/kirby.jpg" title="Kirby Building Systems Authorized Supplier" alt="" /></a>
<a href="employment.php"><img src="images/banners/employment.jpg" title="Want to work with Champion?" alt="" /></a>

</div>
</div>

<div class="bottom-spacer">
<div class="testimonial">
<div class="testimonial-bg">

<?php $testimonial = new Testimonial; $testimonial = $testimonial->random; if (!empty($testimonial)) { ?>
<big>&#8220;</big><?=$testimonial->text?><big>&#8221;</big>

<span><?=$testimonial->name?>, <?=$testimonial->company?></span>

<?php } ?>

</div>
</div>
</div>

<?
include(ROOT.'/inc/footer.php');
?>