<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('su', '/', true);

$admin_title = 'Manage Auth Codes';
$admin_subtitle = 'Add New Auth Code';

include(ROOT.'/inc/admin/header.php');
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Auth Codes</a></p>

<div id="auth_codes_new">
  <?php $form = new FormBuilder(array('model' => 'auth_code', 'action' => 'new', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Add'))?>
  <?=$form->end()?>
</div>

<?
include(ROOT.'/inc/admin/footer.php');
?>