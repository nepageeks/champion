<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Users';
$admin_subtitle = 'Add New User';

include(ROOT.'/inc/admin/header.php');
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Users</a></p>

  <?php $form = new FormBuilder(array('model' => 'user', 'action' => 'new', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Add'))?>
  <?=$form->end()?>

<?
include(ROOT.'/inc/admin/footer.php');
?>