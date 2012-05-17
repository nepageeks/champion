<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
      
    case 'edit':
      $id = addslashes($_POST['id']);
      $p['body'] = addslashes($_POST['body']);
      $p['title'] = addslashes($_POST['title']);
      $p['updated_at'] = $todayDate;
      $putPage  = 'UPDATE `cms_blocks` SET ';
      foreach ($p as $key => $value) {
        $updates[] = "`$key` = '$value'";
      }
      $putPage .= implode(', ', $updates);
      $putPage .= ' WHERE `id` = \''.$id.'\';';
      $success = mysql_query($putPage);
      if ($success) { $URL = './index.php'; }
      else { $URL = './edit.php'; }
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>