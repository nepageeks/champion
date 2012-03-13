<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('su', '/admin');

$admin_title = 'Manage Blocks';
$admin_subtitle = 'Edit Block';

include(ROOT.'/inc/admin/header.php');

$block = new CmsBlock;
$block = $block->find($_GET['id']);
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Blocks</a></p>

<?php $form = new FormBuilder(array('model' => $block, 'action' => 'edit', 'method' => 'post')); ?>
  <?php include './_form.php'; ?>
<?=$form->end();?>

<?
include(ROOT.'/inc/admin/footer.php');
?>