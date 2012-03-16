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
      foreach ($project->photos as $photo) {
        unlink(ROOT.'/photos/'.$id.'/'.$photo->name);
        $photo->delete();
      }
      unlink(ROOT.'/photos/'.$id.'/');
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
        $photo['position'] = count($p->find_by_project_id($photo['project_id'])) + 1;
        $photo['created_at'] = $todayDate;
        $photo['updated_at'] = $todayDate;
        $p->create($photo);
      }
      $URL = './photos.php?id='.$_POST['project_id'];
      break;
      
    case 'photo_delete':
      parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
      $photo = new Photo;
      $photo = $photo->find($id);
      $project_id = $photo->project_id;
      unlink(ROOT.'/photos/'.$project_id.'/'.$photo->name);
      $photo->delete();
      
      $photos = new Photo;
      $photos = $photos->order_by('position')->find_by_project_id($project_id);
      foreach ($photos as $i => $photo) {
        $photo->position = $i + 1;
        $photo->save();
      }
      
      $URL = './photos.php?id='.$project_id;
      break;
      
    case 'photo_sort':
      foreach ($_POST['photo'] as $index => $id) {
        $photo = new Photo;
        $photo = $photo->find($id);
        $photo->position = $index + 1;
        $photo->save();
      }
      exit;
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>