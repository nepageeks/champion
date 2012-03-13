<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('su', '/admin');

$admin_title = 'Manage Blocks';

include(ROOT.'/inc/admin/header.php');
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./categories">Manage Categories</a></p>

<p><a href="new.php"><img src="/images/admin/button_add.jpg" alt="Add New Block" id="button_add" /></a></p>

  <table>
  <?php BasicCms::display_category_pages(0, 'No Category'); ?>
	<?php include('./_categories.php'); ?>
  </table>


<?
include(ROOT.'/inc/admin/footer.php');
?>