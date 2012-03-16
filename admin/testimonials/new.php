<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Testimonials';
$admin_subtitle = 'Add New Testimonial';

include(ROOT.'/inc/admin/header.php');
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Testimonials</a></p>

<div id="testimonials_new">
  <?php $form = new FormBuilder(array('model' => 'testimonial', 'action' => 'new', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Add'))?>
  <?=$form->end()?>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>