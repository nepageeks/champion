<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'View Contact';
$admin_subtitle = 'Show';

include(ROOT.'/inc/admin/header.php');

$contact = new Contact;
$contact = $contact->find($_GET['id']);
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Contact</a></p>

<div id="contact_show">
  <p>
    <strong>Name</strong>: <?=$contact->name?>
  </p>
  <p>
    <strong>Email</strong>: <?=$contact->email?>
  </p>
  <p>
    <strong>Company</strong>: <?=$contact->company?>
  </p>
  <p>
    <strong>Phone</strong>: <?=$contact->phone?>
  </p>
  <p>
    <strong>Subject</strong>: <?=$contact->subject?>
  </p>
  <p>
    <strong>Message</strong>: <br />
    <?=nl2br($contact->message)?>
  </p>
  <p>
    <strong>Notes</strong>: (<a href="./notes.php?id=<?=$contact->id?>">edit</a>) <br />
    <?=nl2br($contact->notes)?>
  </p>
</div>

<?php
include(ROOT.'/inc/admin/footer.php');
?>