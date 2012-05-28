<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
      
    case 'change':
    	$referer = strtok($_SERVER['HTTP_REFERER'], '?');
    	$user = new User;
    	$return = $user->change_password($_POST);
    	$URL = $referer.'?s='.$return; break;
    	break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>