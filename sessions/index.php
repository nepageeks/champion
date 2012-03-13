<?php
include('../inc/config.php');

$action = $_GET['f'];

switch ($action)
  {
    case 'login':
      $session->create($_POST['username'], $_POST['password']);
      if (isset($_SESSION['referrer'])) {
        $URL = $_SESSION['referrer'];
        unset($_SESSION['referrer']);
      } else {
        $URL = '/index.php';
      }
      break;
    case 'logout':
      $session->destroy();
      $URL = '/login.php';
      break;
      
    default:
      $URL = '../';
      break;
  }

header("Location: $URL");
?>