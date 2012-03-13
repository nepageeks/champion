<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Roles';
$admin_subtitle = 'Edit Role';

include(ROOT.'/inc/admin/header.php');

$role = new Role;
$role = $role->find($_GET['id']);
$auth_codes = new AuthCode;
$auth_codes = $auth_codes->find();
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Roles</a></p>

<div id="roles_edit">
  <?php $form = new FormBuilder(array('model' => $role, 'action' => 'edit', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Save'))?>
  <?=$form->end()?>
</div>

<?
include(ROOT.'/inc/admin/footer.php');
?>