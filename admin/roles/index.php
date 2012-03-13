<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Roles';

$pg = (!empty($_GET['pg'])) ? addslashes($_GET['pg']) : '1';

include(ROOT.'/inc/admin/header.php');

$roles = new Role;
$roles = paginate($roles->find());
?>

<p><a href="/admin">Back to Admin Home</a></p>
  
<a href="./new.php"><img src="/images/admin/button_add.jpg" alt="Add New Role" id="button_add" /></a>

<div id="roles_index">
  <table>
    <tr>
      <th>Name</th>
    </tr>
    <?php foreach ($roles[$pg] as $role) { ?>
    <tr>
      <td><?=$role->name?></td>
			<td><a href="edit.php?id=<?=$role->id?>"><img src="/images/admin/button_edit.jpg" alt="Edit" id="edit_button" /></a></td>
			<td><a href="delete.php?id=<?=$role->id?>" class="confirm"><img src="/images/admin/button_delete.jpg" alt="Delete" id="delete_button" /></a></td>
    </tr>
    <?php } ?>
  </table>
</div>

<div id="prevnext">
  <?=prev_page($roles, '<img src="/images/admin/button_previous.jpg" alt="previous" id="button_previous" />')?>
  <?=next_page($roles, '<img src="/images/admin/button_next.jpg" alt="next" id="button_next" />')?>
</div>

<?
include(ROOT.'/inc/admin/footer.php');
?>