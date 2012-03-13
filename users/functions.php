<?php
include('../inc/config.php');

$action = $_GET['f'];

switch ($action)
  {      
    case 'signup':
    	$referer = strtok($_SERVER['HTTP_REFERER'], '?');
    	$user = new User;
    	$return = $user->signup($_POST);
    	$URL = $referer.'?s='.$return; break;
    	break;
    case 'forgot':
    	$referer = strtok($_SERVER['HTTP_REFERER'], '?');
    	$user = new User;
    	$return = $user->forgot_password($_POST['email']);
    	$URL = $referer.'?s='.$return; break;
    	break;
    case 'change':
    	$referer = strtok($_SERVER['HTTP_REFERER'], '?');
    	$user = new User;
    	$return = $user->change_password($_POST);
    	$URL = $referer.'?s='.$return; break;
    	break;
      
    default:
      exit;
      break;
  }

header("Location: $URL");
?>