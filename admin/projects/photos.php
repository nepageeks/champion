<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Projects';
$admin_subtitle = 'Manage Photos';

include(ROOT.'/inc/admin/header.php');

$project = new Project;
$project = $project->find($_GET['id']);
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Projects</a></p>

<div id="project_photos">
  <table>
    <tr>
      <th></th>
      <th>Name</th>
    </tr>
    <?php foreach ($project->photos as $photo) { ?>
      <tr class="sortable" id="photo_<?=$photo->id?>">
        <td><img src="./image.php?image=<?=urlencode('/photos/'.$project->id.'/'.$photo->name)?>" /></td>
        <td><?=$photo->name?></td>
        <td><span class="handle"><img src="/images/drag.png" /></span></td>
        <td><a href="./functions.php?f=photo_delete&amp;id=<?=$photo->id?>" class="confirm">Delete</a></td>
      </tr>
    <?php } ?>
    <tr>
      <td colspan="10">
        <form action="./functions.php?f=photo_add" method="post" enctype="multipart/form-data">
          <input type="hidden" name="project_id" value="<?=$project->id?>" />
          <input type="file" name="photo" />
          <input type="submit" />
        </form>
      </td>
    </tr>
  </table>
</div>

<script>
  $('table').sortable({
    items: '.sortable',
    handle: '.handle',
    update: function() {
      $.post(
        './functions.php?f=photo_sort',
        $(this).sortable('serialize')
      );
    }
  });
</script>

<?php
include(ROOT.'/inc/admin/footer.php');
?>