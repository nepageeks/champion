<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'View Contact';
$admin_subtitle = 'Edit Notes';

include(ROOT.'/inc/admin/header.php');

$contact = new Contact;
$contact = $contact->find($_GET['id']);
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Contact</a></p>

<div id="contact_show">
  <p>
    <strong>Notes</strong>: <br />
    <form action="./functions.php?f=notes" method="post">
      <input type="hidden" name="id" value="<?=$contact->id?>" id="id">
      <textarea name="notes"><?=nl2br($contact->notes)?></textarea>
      <br />
      <input type="submit" name="submit" value="Save" id="submit" />
    </form>
  </p>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>