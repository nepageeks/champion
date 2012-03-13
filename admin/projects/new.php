<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Projects';
$admin_subtitle = 'Add New Project';

include(ROOT.'/inc/admin/header.php');
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Projects</a></p>

<div id="projects_new">
  <?php $form = new FormBuilder(array('model' => 'project', 'action' => 'new', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Add'))?>
  <?=$form->end()?>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>