<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Roles';
$admin_subtitle = 'Add New Role';

$role = new Role;
$auth_codes = new AuthCode;
$auth_codes = $auth_codes->find();

include(ROOT.'/inc/admin/header.php');
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Roles</a></p>

<div id="roles_new">
  <?php $form = new FormBuilder(array('model' => 'role', 'action' => 'new', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Add'))?>
  <?=$form->end()?>
</div>

<?
include(ROOT.'/inc/admin/footer.php');
?>