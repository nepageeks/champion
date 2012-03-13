<?
require('../../../inc/admin/config.php');
$session->auth_or_redirect('su', '/admin');

$admin_title = 'Manage Categories';
$admin_subtitle = 'Add New Category';

include(ROOT.'/inc/admin/header.php');
?>

<?php $form = new FormBuilder(array('model' => 'cms_category', 'action' => 'new', 'method' => 'post')); ?>
  <?php include './_form.php'; ?>
<?=$form->end();?>

<?
include(ROOT.'/inc/admin/footer.php');
?>