<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$admin_title = 'Manage Files';
$admin_subtitle = 'Add New File';

include(ROOT.'/inc/admin/header.php');
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Files</a></p>

<div id="files_new">
  <form action="./functions.php?f=new" method="post" enctype="multipart/form-data">
    <table>
      <tr>
				<td>Name</td>
				<td><input type="text" name="name" /></td>
			</tr>
			<tr>
				<td>File</td>
				<td><input type="file" name="file" /></td>
			</tr>
      <tr>
        <td colspan="2">
          <input type="submit" name="submitBtn" value="Add" id="submitBtn">
        </td>
      </tr>
    </table>
  </form>
</div>

<?
include(ROOT.'/inc/admin/footer.php');
?>