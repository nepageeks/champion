<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Projects";

include(ROOT.'/inc/header.php');

$projects = new Project;

$projects = $projects->limit(12)->find();

?>

<div class="projects">

<h2>Projects</h2>

<?php foreach ($projects as $project) { ?>
<div><a href="./project.php?id=<?=$project->id?>"><img src="/photos/<?=$project->id?>/<?=$project->photo->name?>" style="width: 300px; height: 150px;" alt="" /></a>
  <big><?=$project->title?></big>
  <?=$project->location?> / <?=$project->size?> sq. ft.
  <small><?=$project->type?>, <?=$project->construction?></small>
  <span>Project Completion: <b><?=$project->status?></b></span> 
</div>
<?php } ?>

</div>

<?
include(ROOT.'/inc/footer.php');
?>