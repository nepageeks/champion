<?
require('../../../inc/admin/config.php');
$session->auth_or_redirect('su', '/admin');

$admin_title = 'Manage Categories';

include(ROOT.'/inc/admin/header.php');

$categories = new CmsCategory;
$categories = $categories->find();
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="../">Back to Blocks Home</a></p>

<p><a href="new.php"><img src="/images/admin/button_add.jpg" alt="add new category" id="button_add" /></a></p>

<?php if (empty($categories)) { echo 'No categories yet!'; } else { ?>
  <table>
    <tr>
      <th></th>
      <th>Name</th>
    </tr>
		<?php foreach ($categories as $category) { ?>
    <tr>
      <td>
        <a href="edit.php?id=<?=$category->id?>">
          <?=$category->name?>
        </a>
      </td>
      <td>
        <a href="delete.php?id=<?=$category->id?>">
          <img src="/images/admin/button_delete.jpg" alt="delete" id="delete_button" />
        </a>
      </td>
    </tr>
    <?php } ?>
  </table>
<?php } ?>


<?
include(ROOT.'/inc/admin/footer.php');
?>