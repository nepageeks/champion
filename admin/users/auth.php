<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/', true);

$admin_title = 'Manage Users';
$admin_subtitle = 'Manage Auth';

include(ROOT.'/inc/admin/header.php');

$user = new User;
$user = $user->find($_GET['id']);

$auth_codes = new AuthCode;
$auth_codes = $auth_codes->find();

$roles = new Role;
$roles = $roles->find();
?>

<p><a href="/admin">Back to Admin Home</a></p>
<p><a href="./">Back to Users</a></p>

<form action="./functions.php?f=auth" method="post">
  <select name="role" id="role">
    <option value="">Custom</option>
    <?php foreach ($roles as $role) { ?>
    <?php $selected = ($role->id == $user->role) ? 'selected="selected"' : ''; ?>
    <option value="<?=$role->id?>" data-auth="<?=implode(';', $role->auth)?>" <?=$selected?>><?=$role->name?></option>
    <?php } ?>
  </select>
  
  <input type="hidden" name="auth" value="" id="auth">
<?php foreach ($auth_codes as $auth) { ?>
  <?php $checked = (in_array($auth->code, $user->auth)) ? 'checked="checked"' : ''; ?>
  <p>
    <input type="checkbox" name="auth[]" value="<?=$auth->code?>" id="auth_<?=$auth->code?>" <?=$checked?>>
    <label for="auth_<?=$auth->code?>" class="inline"><?=$auth->name?></label>
  </p>
<?php } ?>
  <p>
    <input type="submit" name="submit" value="Save" id="submit">
  </p>
</form>

<script type="text/javascript" charset="utf-8">
  $(function() {
    $('#role').change(function() {
      if ($(this).val() == '') {
        $('input[type=checkbox]').removeAttr('disabled');
      } else {
        $('input[type=checkbox]').removeAttr('checked');
        $('input[type=checkbox]').attr('disabled', true);
        var auth = $('#role option:selected').attr('data-auth').split(';');
        for (i in auth)
        {
          $('#auth_' + auth[i]).attr('checked', true);
        }
      }
    }).change();
  });
</script>

<?
include(ROOT.'/inc/admin/footer.php');
?>