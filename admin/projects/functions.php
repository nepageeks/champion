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
      
    case 'photo_add':
      $upload = new Upload();
      $upload->SetFileName($_FILES['photo']['name']);
      $upload->SetTempName($_FILES['photo']['tmp_name']);
      $upload->SetUploadDirectory(ROOT.'/photos/'.$_POST['project_id'].'/');
      $upload->SetValidExtensions(array('gif', 'jpg', 'jpeg', 'png'));
      if ($upload->UploadFile()) {
        $p = new Photo;
        $photo['project_id'] = addslashes($_POST['project_id']);
        $photo['name'] = $upload->GetFileName();
        $photo['position'] = $p->count + 1;
        $photo['created_at'] = $todayDate;
        $photo['updated_at'] = $todayDate;
        $p->create($photo);
      }
      $URL = './photos.php?id='.$_POST['project_id'];
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>