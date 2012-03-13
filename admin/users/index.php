<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Users';

include(ROOT.'/inc/admin/header.php');

$user = new User;
$users = $user->order_by('username')->find(array("`username` NOT IN ('admin', 'su')"));
?>

<p><a href="/admin">Back to Admin Home</a></p>

<p><a href="new.php"><img src="/images/admin/button_add.jpg" alt="Add User" id="button_add" /></a></p>

  <table>
    <tr>
      <th>Username</th>
    </tr>
	<?php foreach ($users as $user) { ?>
    <tr>
      <td>
        <a href="edit.php?id=<?=$user->id?>">
          <?=$user->username?>
        </a>
      </td>
      <td>
        <a href="delete.php?id=<?=$user->id?>" class="confirm">
          <img src="/images/admin/button_delete.jpg" alt="Delete" id="delete_button" />
        </a>
      </td>
      <td>
        <a href="auth.php?id=<?=$user->id?>">
          <img src="/images/admin/button_auth.jpg" alt="Manage Auth" id="auth_button" />
        </a>
      </td>
    </tr>
	<?php } ?>
  </table>


<?
include(ROOT.'/inc/admin/footer.php');
?>