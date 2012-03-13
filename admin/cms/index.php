<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$admin_title = 'Edit Blocks';

include(ROOT.'/inc/admin/header.php');
?>

	<p><a href="/admin">Back to Admin Home</a></p>

  <table>
  <?php BasicCms::display_category_pages(0, 'No Category'); ?>
	<?php include('./_categories.php'); ?>
  </table>


<?
include(ROOT.'/inc/admin/footer.php');
?>