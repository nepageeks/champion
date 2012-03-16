<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Testimonials';

include(ROOT.'/inc/admin/header.php');

$testimonials = new Testimonial;
$paginator = new Paginator($testimonials->find());
?>

<p><a href="/admin">Back to Admin Home</a></p>
  
<a href="./new.php"><img src="/images/admin/button_add.jpg" alt="Add New Testimonial" id="button_add" /></a>

<div id="testimonials_index">
  <table>
    <tr>
      <th>Name</th>
			<th>Company</th>
			<th>Text</th>
    </tr>
    <?php foreach ($paginator->this_page() as $testimonial) { ?>
    <tr>
      <td><?=$testimonial->name?></td>
			<td><?=$testimonial->company?></td>
			<td><?=$testimonial->text?></td>
			<td><a href="edit.php?id=<?=$testimonial->id?>"><img src="/images/admin/button_edit.jpg" alt="Edit" id="edit_button" /></a></td>
			<td><a href="delete.php?id=<?=$testimonial->id?>" class="confirm"><img src="/images/admin/button_delete.jpg" alt="Delete" id="delete_button" /></a></td>
    </tr>
    <?php } ?>
  </table>
</div>

<div id="prevnext">
  <?=$paginator->previous('<img src="/images/admin/button_previous.jpg" alt="previous" id="button_previous" />')?>
  <?=$paginator->next('<img src="/images/admin/button_next.jpg" alt="next" id="button_next" />')?>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>