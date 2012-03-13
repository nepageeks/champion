<?php
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    case 'new':
      $user_info = $_POST['user'];
      $user = new User;
      $user = $user->find(array("`username` = '{$_POST['user']['username']}'"));
      if (!empty($user)) { Flash::add('error', 'A user already exists with that username'); $URL = './new.php'; break; }
      if ($_POST['user']['password'] != $_POST['user']['confirm']) { Flash::add('error', 'The password must match the confirmation'); $URL = './new.php'; break; }
      
      $user_info['password'] = md5($user_info['password']);
      $user = new User;
      $user->create($user_info);
      Flash::add('notice', 'User successfully created');
      $URL = './index.php';
      break;
      
    case 'edit':
      parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY));
      $user_info = $_POST['user'];
      if ($_POST['user']['password'] != $_POST['user']['confirm']) { Flash::add('error', 'The password must match the confirmation'); $URL = './edit.php?id='.$id; break; }
      
      if (empty($user_info['password'])) { unset($user_info['password']); }
      else { $user_info['password'] = md5($user_info['password']); }
      $user = new User;
      $user = $user->find($id);
      unset($user->auth);
      $user->update($user_info);
      Flash::add('notice', 'User successfully updated');
      $URL = './index.php';
      break;
      
    case 'delete':
      parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY));
      $user = new User;
      $user = $user->find($id);
      $user->delete();
      $URL = './index.php';
      break;
      
    case 'auth':
      parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY));
      $user = new User;
      $user = $user->find($id);
      if (empty($_POST['role'])) {
        $user->auth = implode(';', (array)$_POST['auth']);
      } else {
        $user->auth = '{'.addslashes($_POST['role']).'}';
      }
      $user->save();
      $URL = './index.php';
      break;
      
    default:
      break;
  }

header("Location: $URL");

include(ROOT.'/inc/closedb.php');
?>