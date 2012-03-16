<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Testimonials';
$admin_subtitle = 'Edit Testimonial';

include(ROOT.'/inc/admin/header.php');

$testimonial = new Testimonial;
$testimonial = $testimonial->find($_GET['id']);
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Testimonials</a></p>

<div id="testimonials_edit">
  <?php $form = new FormBuilder(array('model' => $testimonial, 'action' => 'edit', 'method' => 'post')); ?>
    <?php include './_form.php'; ?>
    <?=$form->submit(array('value' => 'Save'))?>
  <?=$form->end()?>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>