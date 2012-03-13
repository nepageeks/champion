<?php
include('../../inc/config.php');
$session->auth_or_redirect('admin', '/', true);

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    case 'new':
      $project = new Project;
      $project->create($_POST['project']);
      $URL = './index.php';
      break;
      
    case 'edit':
      parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY));
      $project = new Project;
      $project = $project->find($id);
      $project->update($_POST['project']);
      $URL = './index.php';
      break;
      
    case 'delete':
      parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
      $project = new Project;
      $project = $project->find($id);
      $project->delete();
      $URL = './index.php';
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>