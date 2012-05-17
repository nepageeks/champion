<?php
include('../../inc/config.php');
$session->auth_or_redirect('admin', '/', true);

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    case 'notes':
      $contact = new Contact;
      $contact = $contact->find($_POST['id']);
      $contact->notes = $_POST['notes'];
      $contact->save();
      $URL = './show.php?id='.$contact->id;
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>