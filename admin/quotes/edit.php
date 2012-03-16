<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Quotes';
$admin_subtitle = 'Edit Quote';

include(ROOT.'/inc/admin/header.php');

$quote = new Quote;
$quote = $quote->find($_GET['id']);
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Quotes</a></p>

<div id="quotes_edit">
  <?php $form = new FormBuilder(array('model' => $quote, 'action' => 'edit', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Save'))?>
  <?=$form->end()?>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>