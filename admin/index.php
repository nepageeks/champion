<?
require('../inc/admin/config.php');
$session->auth_or_redirect('admin', '/login.php');

include(ROOT.'/inc/admin/header.php');
?>

  <p>Please choose a navigation item on the left to get started.</p>
  <?=AdminHelper::admin_nav(null, false);?>

<?
include(ROOT.'/inc/admin/footer.php');
?>