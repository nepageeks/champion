<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('su', '/', true);

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    case 'new':
      $auth_code = new AuthCode;
      $auth_code->create($_POST['auth_code']);
      $URL = './index.php';
      break;
      
    case 'edit':
      parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY));
      $auth_code = new AuthCode;
      $auth_code = $auth_code->find($id);
      $auth_code->update($_POST['auth_code']);
      $URL = './index.php';
      break;
      
    case 'delete':
      parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
      $auth_code = new AuthCode;
      $auth_code = $auth_code->find($id);
      $auth_code->delete();
      $URL = './index.php';
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>