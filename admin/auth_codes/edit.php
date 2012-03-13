<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('su', '/', true);

$admin_title = 'Manage Auth Codes';
$admin_subtitle = 'Edit Auth Code';

include(ROOT.'/inc/admin/header.php');

$auth_code = new AuthCode;
$auth_code = $auth_code->find($_GET['id']);
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Auth Codes</a></p>

<div id="auth_codes_edit">
  <?php $form = new FormBuilder(array('model' => $auth_code, 'action' => 'edit', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Save'))?>
  <?=$form->end()?>
</div>

<?
include(ROOT.'/inc/admin/footer.php');
?>