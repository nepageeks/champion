<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Project";

$project = new Project;
$project = $project->find($_GET['id']);

include(ROOT.'/inc/header.php');
?>

<div class="project-details">

<div class="project-photo"><img src="/photos/<?=$project->id?>/<?=$project->photo->name?>" alt="" title="<?=$project->title?>"></div>

<div class="project-info">
<h2><?=$project->title?></h2>

<table>
<tr><td colspan="2" class="blurb">
<?=$project->description?>
</td></tr>
<tr><td colspan="2" class="divider"><div></div></td></tr>

<tr><td class="label odd">Location:</td><td class="odd"><?=$project->location?></td></tr>
<tr><td class="label even">Status:</td><td class="status even"><?=$project->status?></td></tr>
<tr><td class="label odd">Size:</td><td class="odd"><?=$project->size?> sq. ft.</td></tr>
<tr><td class="label even">Project Type:</td><td class="even"><?=$project->type?></td></tr>
<tr><td class="label odd">Construction Type:</td><td class="odd"><?=$project->construction?></td></tr>
<tr><td class="label even">Start Date:</td><td class="even"><?=date('M d, Y', strtotime($project->start_date))?></td></tr>
<tr><td class="label odd">End Date:</td><td class="odd"><?=date('M d, Y', strtotime($project->completion_date))?></td></tr>
<tr><td class="label even">Completion Status:</td><td class="even"><?=$project->status?></td></tr>

</table>
</div>

</div>

<?
include(ROOT.'/inc/footer.php');
?>