<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Projects';

include(ROOT.'/inc/admin/header.php');

$projects = new Project;
$paginator = new Paginator($projects->find());
?>

<p><a href="/admin">Back to Admin Home</a></p>
  
<a href="./new.php"><img src="/images/admin/button_add.jpg" alt="Add New Project" id="button_add" /></a>

<div id="projects_index">
  <table>
    <tr>
      <th>Title</th>
			<th>Location</th>
    </tr>
    <?php foreach ($paginator->this_page() as $project) { ?>
    <tr>
      <td><?=$project->title?></td>
			<td><?=$project->location?></td>
			<td><a href="edit.php?id=<?=$project->id?>"><img src="/images/admin/button_edit.jpg" alt="Edit" id="edit_button" /></a></td>
			<td><a href="delete.php?id=<?=$project->id?>" class="confirm"><img src="/images/admin/button_delete.jpg" alt="Delete" id="delete_button" /></a></td>
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