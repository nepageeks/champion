<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('su', '/admin');

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    case 'new':
      $block = new CmsBlock;
      $block->create($_POST['block']);
      $URL = './index.php';
      break;
      
    case 'edit':
      parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY));
      $block = new CmsBlock;
      $block = $block->find($id);
      $block->update($_POST['cms_block']);
      $URL = './index.php';
      break;
      
    case 'delete':
      parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
      $block = new CmsBlock;
      $block = $block->find($id);
      $block->delete();
      $URL = './index.php';
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>