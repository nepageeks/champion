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
  <?php $form = new FormBuilder(array('model' => 'project', 'action' => 'new', 'method' => 'post', 'options' => 'enctype="multipart/form-data"')); ?>
    <?php include './_form.php'; ?>
    <p>
      <label for="photo">Photo</label>
      <input type="file" name="photo" id="photo" />
    </p>
    <?=$form->submit(array('value' => 'Add'))?>
  <?=$form->end()?>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>