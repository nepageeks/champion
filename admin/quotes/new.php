<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Quotes';
$admin_subtitle = 'Add New Quote';

include(ROOT.'/inc/admin/header.php');
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Quotes</a></p>

<div id="quotes_new">
  <?php $form = new FormBuilder(array('model' => 'quote', 'action' => 'new', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Add'))?>
  <?=$form->end()?>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>