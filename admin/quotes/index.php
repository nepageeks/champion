<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Quotes';

include(ROOT.'/inc/admin/header.php');

$quotes = new Quote;
$paginator = new Paginator($quotes->find());
?>

<p><a href="/admin">Back to Admin Home</a></p>
  
<a href="./new.php"><img src="/images/admin/button_add.jpg" alt="Add New Quote" id="button_add" /></a>

<div id="quotes_index">
  <table>
    <tr>
      <th>Name</th>
			<th>Company</th>
    </tr>
    <?php foreach ($paginator->this_page() as $quote) { ?>
    <tr>
      <td><?=$quote->name?></td>
			<td><?=$quote->business_name?></td>
			<td><a href="edit.php?id=<?=$quote->id?>"><img src="/images/admin/button_edit.jpg" alt="Edit" id="edit_button" /></a></td>
			<td><a href="delete.php?id=<?=$quote->id?>" class="confirm"><img src="/images/admin/button_delete.jpg" alt="Delete" id="delete_button" /></a></td>
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