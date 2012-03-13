<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$admin_title = 'Manage Files';

$pg = (!empty($_GET['pg'])) ? addslashes($_GET['pg']) : '1';

include(ROOT.'/inc/admin/header.php');
$getFiles = mysql_query("SELECT * FROM `cms_files`");
$files = paginate($getFiles);
?>

<p><a href="/admin">Back to Admin Home</a></p>
  
<a href="./new.php"><img src="/images/admin/button_add.jpg" alt="Add New File" id="button_add" /></a>

<div id="files_index">
  <table>
    <tr>
      <th>Name</th>
    </tr>
    <?php foreach ($files[$pg] as $f) {?>
    <tr>
      <td><a href="<?=$f['path']?>" target="_blank"><?=$f['name']?></a></td>
			<td><a href="#"><img src="/images/admin/button_copy.jpg" alt="Copy Path" class="copy_button" /></a></td>
			<td><a href="delete.php?id=<?=$f['id']?>"><img src="/images/admin/button_delete.jpg" alt="Delete" class="delete_button confirm" /></a></td>
    </tr>
    <? } ?>
  </table>
</div>

<div id="prevnext">
  <?=prev_page($files, '<img src="/images/admin/button_previous.jpg" alt="previous" id="button_previous" />')?>
  <?=next_page($files, '<img src="/images/admin/button_next.jpg" alt="next" id="button_next" />')?>
</div>

<script type="text/javascript" src="/inc/zeroclipboard/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
    ZeroClipboard.setMoviePath( '/inc/zeroclipboard/ZeroClipboard.swf' );
    var clip = new ZeroClipboard.Client();
    clip.setHandCursor( true );
    clip.addEventListener( 'onComplete', function ( client, text ) {
      alert('The path for this file has been copied to your clipboard.');
    });
		$('.copy_button').mouseover( function() {
			clip.setText( $(this).closest('td').prev().find('a').attr('href') );
			if (clip.div) {
				clip.receiveEvent('mouseout', null);
				clip.reposition(this);
			}
			else clip.glue(this);
			clip.receiveEvent('mouseover', null);
		});
  });
</script>

<?
include(ROOT.'/inc/admin/footer.php');
?>