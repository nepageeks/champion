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

<?php 

$projects = new Project;

$projects = $projects->limit(2)->find_by_type('Commercial'); ?>

<?php foreach ($projects as $project) { ?>

<div><a href="./project.php?id=<?=$project->id?>"><img src="/photos/<?=$project->id?>/<?=$project->photo->name?>" style="width: 300px; height: 150px;" alt="" /></a>

  <big><?=$project->title?></big>

  <?=$project->location?> / <?=$project->size?> sq. ft.

  <small><?=$project->type?>, <?=$project->construction?></small>

  <span>Project Completion: <b><?=$project->progress?></b></span> 

</div>

<?php } ?>
</div>



</div>



<?

include(ROOT.'/inc/footer.php');

?>