<?php

class AddSuToUsers extends Ruckusing_BaseMigration {

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
	    'su',
      MD5('psswd123'),
      'Super',
      'User',
      'su',
      NOW(),
      NOW()
	  )");
	}//up()

	public function down() {
	  $this->execute("DELETE FROM `users` WHERE `username` = 'su' LIMIT 1");
	}//down()
}
?>