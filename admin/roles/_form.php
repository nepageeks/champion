<?=$form->input(array('for' => 'name'))?>
<?//=$form->input(array('for' => 'auth'))?>
<?php foreach ($auth_codes as $auth) { ?>
  <?php $checked = (in_array($auth->code, $role->auth)) ? 'checked="checked"' : ''; ?>
  <p>
    <input type="checkbox" name="role[auth][]" value="<?=$auth->code?>" id="role_auth_<?=$auth->code?>" <?=$checked?>>
    <label for="role_auth_<?=$auth->code?>" class="inline"><?=$auth->name?></label>
  </p>
<?php } ?>