<?php

class CreateUsers extends Ruckusing_BaseMigration {

	public function up() {
	  $t = $this->create_table("users");
	  $t->column("username", "string");
	  $t->column("password", "string");
	  $t->column("first_name", "string");
	  $t->column("last_name", "string");
	  $t->column("email", "string");
	  $t->column("auth", "text");
	  $t->column("created_at", "datetime");
	  $t->column("updated_at", "datetime");
	  $t->finish();
	}//up()

	public function down() {
	  $this->drop_table("users");
	}//down()
}
?>