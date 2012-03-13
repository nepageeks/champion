<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Projects';
$admin_subtitle = 'Edit Project';

include(ROOT.'/inc/admin/header.php');

$project = new Project;
$project = $project->find($_GET['id']);
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Projects</a></p>

<div id="projects_edit">
  <?php $form = new FormBuilder(array('model' => $project, 'action' => 'edit', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Save'))?>
  <?=$form->end()?>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>