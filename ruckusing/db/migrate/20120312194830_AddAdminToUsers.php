<?php

class AddAdminToUsers extends Ruckusing_BaseMigration {

	public function up() {
	  $this->execute("INSERT INTO `users` (
	    `username`,
	    `password`,
	    `first_name`,
	    `last_name`,
	    `auth`,
	    `created_at`,
	    `updated_at`
	    ) VALUES (
	    'admin',
      MD5('psswd123'),
      'Admin',
      'User',
      'admin',
      NOW(),
      NOW()
	  )");
	}//up()

	public function down() {
	  $this->execute("DELETE FROM `users` WHERE `username` = 'admin' LIMIT 1");
	}//down()
}
?>