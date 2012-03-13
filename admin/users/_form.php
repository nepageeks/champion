<?=$form->input(array('for' => 'username'))?>
<?//=$form->input(array('for' => 'password'))?>
<p>
  <label for="user_password">Password</label>
  <input type="password" name="user[password]" id="user_password" />
</p>

<?//=$form->input(array('for' => 'confirm'))?>
<p>
  <label for="user_confirm">Confirm</label>
  <input type="password" name="user[confirm]" id="user_confirm" />
</p>
<?=$form->input(array('for' => 'first_name'))?>
<?=$form->input(array('for' => 'last_name'))?>
<?=$form->input(array('for' => 'email'))?>