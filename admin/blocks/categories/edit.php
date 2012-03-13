<?
require('../../../inc/admin/config.php');
$session->auth_or_redirect('su', '/admin');

$admin_title = 'Manage Categories';
$admin_subtitle = 'Edit Category';

include(ROOT.'/inc/admin/header.php');

$category = new CmsCategory;
$category = $category->find($_GET['id']);
?>

<?php $form = new FormBuilder(array('model' => $category, 'action' => 'edit', 'method' => 'post')); ?>
  <?php include './_form.php'; ?>
<?=$form->end();?>

<?
include(ROOT.'/inc/admin/footer.php');
?>