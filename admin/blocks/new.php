<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('su', '/admin');

$admin_title = 'Manage Blocks';
$admin_subtitle = 'Add New Block';

include(ROOT.'/inc/admin/header.php');

$getCategories = mysql_query("SELECT * FROM `cms_categories`");
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Blocks</a></p>

<?php $form = new FormBuilder(array('model' => 'block', 'action' => 'new', 'method' => 'post')); ?>
  <?php include './_form.php'; ?>
<?=$form->end();?>

<?
include(ROOT.'/inc/admin/footer.php');
?>