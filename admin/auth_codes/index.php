<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('su', '/', true);

$admin_title = 'Manage Auth Codes';

$pg = (!empty($_GET['pg'])) ? addslashes($_GET['pg']) : '1';

include(ROOT.'/inc/admin/header.php');

$auth_codes = new AuthCode;
$auth_codes = paginate($auth_codes->find());
?>

<p><a href="/admin">Back to Admin Home</a></p>
  
<a href="./new.php"><img src="/images/admin/button_add.jpg" alt="Add New Auth Code" id="button_add" /></a>

<div id="auth_codes_index">
  <table>
    <tr>
      <th>Code</th>
			<th>Name</th>
    </tr>
    <?php foreach ($auth_codes[$pg] as $auth_code) { ?>
    <tr>
      <td><?=$auth_code->code?></td>
			<td><?=$auth_code->name?></td>
			<td><a href="edit.php?id=<?=$auth_code->id?>"><img src="/images/admin/button_edit.jpg" alt="Edit" id="edit_button" /></a></td>
			<td><a href="delete.php?id=<?=$auth_code->id?>" class="confirm"><img src="/images/admin/button_delete.jpg" alt="Delete" id="delete_button" /></a></td>
    </tr>
    <?php } ?>
  </table>
</div>

<div id="prevnext">
  <?=prev_page($auth_codes, '<img src="/images/admin/button_previous.jpg" alt="previous" id="button_previous" />')?>
  <?=next_page($auth_codes, '<img src="/images/admin/button_next.jpg" alt="next" id="button_next" />')?>
</div>

<?
include(ROOT.'/inc/admin/footer.php');
?>