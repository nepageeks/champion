<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$stylesheets[] = 'basic_cms';

$id = addslashes($_GET['id']);
$p = mysql_fetch_array(mysql_query("SELECT * FROM `cms_blocks` WHERE `id` = '$id'"));

$admin_title = 'Editing Block';
$admin_subtitle = stripslashes($p['title']);	

include(ROOT.'/inc/admin/header.php');

?>

	<p><a href="/admin">Back to Admin Home</a></p>
	<p><a href="./">Back to Edit Blocks</a></p>
	
	<h2><?=stripslashes($p['title'])?></h2>
	<p><?=stripslashes($p['description'])?></p>
	
  <form id="edit_page_form" action="./functions.php?f=edit" method="post">
    <input type="hidden" name="id" value="<?=$id?>" id="id">
    <p>
      <textarea name="body"><?=stripslashes($p['body'])?></textarea>
    </p>
    <p>
      <input type="image" name="submitBtn" value="Save" src="/images/admin/button_save.jpg" id="save_button">
    </p>
  </form>

<?=BasicCms::setup_markitup('markdown', 'simple', false)?>
<script type="text/javascript" charset="utf-8">
  $('textarea').markItUp(mySettings);
</script>

<?
include(ROOT.'/inc/admin/footer.php');
?>