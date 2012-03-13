<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    case 'new':
      include ROOT.'/inc/classes/class.upload.php';
      $upload = new Upload();
      $upload->SetFileName($_FILES['file']['name']);
      $upload->SetTempName($_FILES['file']['tmp_name']);
      $upload->SetUploadDirectory(ROOT.'/files/');
      // $upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
      if ($upload->UploadFile()) {
        $f['name'] = addslashes($_POST['name']);
        $f['path'] = '/files/'.$upload->GetFileName();
        $f['created_at'] = $todayDate;
        $f['updated_at'] = $todayDate;
        $postQuery  = 'INSERT INTO `cms_files` (`';
        $postQuery .= implode('`, `', array_keys($f));
        $postQuery .= '`) VALUES (\'';
        $postQuery .= implode('\', \'', array_values($f));
        $postQuery .= '\');';
        $success = mysql_query($postQuery);
        if ($success) { $URL = './index.php'; }
        else { $URL = './new.php'; }
      } else {
        $URL = './new.php';
      }
      break;
      
    case 'delete':
      $file_id = addslashes($_GET['id']);
      $file = mysql_fetch_assoc(mysql_query("SELECT * FROM `cms_files` WHERE `id` = '$file_id'"));
      unlink(ROOT.$file['path']);
      mysql_query("DELETE FROM `cms_files` WHERE `id` = '$file_id'");
      $URL = './index.php';
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>