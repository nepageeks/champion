<?php

class CreateCMSBlocks extends Ruckusing_BaseMigration {

	public function up() {
	  $t = $this->create_table("cms_blocks");
	  $t->column("category_id", "integer");
	  $t->column("name", "string");
	  $t->column("title", "string");
	  $t->column("location", "string");
	  $t->column("description", "string");
	  $t->column("body", "text");
	  $t->column("created_at", "datetime");
	  $t->column("updated_at", "datetime");
	  $t->finish();
	}//up()

	public function down() {
	  $this->drop_table("cms_blocks");
	}//down()
}
?>