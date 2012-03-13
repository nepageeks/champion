<?php

class CreateCMSCategories extends Ruckusing_BaseMigration {

	public function up() {
	  $t = $this->create_table("cms_categories");
	  $t->column("parent", "integer");
	  $t->column("name", "string");
	  $t->column("created_at", "datetime");
	  $t->column("updated_at", "datetime");
	  $t->finish();
	}//up()

	public function down() {
	  $this->drop_table("cms_categories");
	}//down()
}
?>