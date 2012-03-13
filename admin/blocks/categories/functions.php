<?php
require('../../../inc/admin/config.php');
$session->auth_or_redirect('su', '/admin');

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    case 'new':
      $cms_category = new CmsCategory;
      $cms_category->create($_POST['cms_category']);
      $URL = './index.php';
      break;
      
    case 'edit':
      parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY));
      $cms_category = new CmsCategory;
      $cms_category = $cms_category->find($id);
      $cms_category->update($_POST['cms_category']);
      $URL = './index.php';
      break;
      
    case 'delete':
      parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
      $cms_category = new CmsCategory;
      $cms_category = $cms_category->find($id);
      $cms_category->delete();
      $URL = './index.php';
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>