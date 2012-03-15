<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Projects";

include(ROOT.'/inc/header.php');

$projects = new Project;
$projects = $projects->find();
?>

<div class="projects">

<h2>Projects</h2>

<?php foreach ($projects as $project) { ?>
<div><a href=""><img src="images/projects/us-foods.jpg" alt="" /></a>
  <big><?=$project->title?></big>
  <?=$project->location?> / 65,000 sq. ft.
  <small>Pre-engineered, New Addition</small>
  <span>Project Completion: <b>4 Months Early</b></span> 
</div>
<?php } ?>

</div>

<?
include(ROOT.'/inc/footer.php');
?>