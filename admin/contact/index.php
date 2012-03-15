<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'View Contact';

$pg = (!empty($_GET['pg'])) ? addslashes($_GET['pg']) : '1';

include(ROOT.'/inc/admin/header.php');

$contact = new Contact;
$paginator = new Paginator($contact->find());
?>

<p><a href="/admin">Back to Admin Home</a></p>

<div id="contact_index">
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Subject</th>
      <th>Date Submitted</th>
    </tr>
    <?php foreach ($paginator->this_page() as $contact) { ?>
    <tr>
      <td><?=$contact->name?></td>
      <td><?=$contact->email?></td>
      <td><?=String::truncate($contact->subject, 30)?></td>
      <td><?=$contact->created_at?></td>
			<td><a href="show.php?id=<?=$contact->id?>">Show</a></td>
    </tr>
    <?php } ?>
  </table>
</div>

<div id="prevnext">
  <?=$paginator->previous('<img src="/images/admin/button_previous.jpg" alt="previous" id="button_previous" />')?>
  <?=$paginator->next('<img src="/images/admin/button_next.jpg" alt="next" id="button_next" />')?>
</div>

<?
include(ROOT.'/inc/admin/footer.php');
?>