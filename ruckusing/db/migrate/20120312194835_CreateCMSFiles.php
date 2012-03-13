<?php

class CreateCMSFiles extends Ruckusing_BaseMigration {

	public function up() {
	  $t = $this->create_table("cms_files");
	  $t->column("name", "string");
	  $t->column("path", "string");
	  $t->column("created_at", "datetime");
	  $t->column("updated_at", "datetime");
	  $t->finish();
	}//up()

	public function down() {
	  $this->drop_table("cms_files");
	}//down()
}
?>