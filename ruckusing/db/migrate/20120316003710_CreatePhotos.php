<?php

class CreatePhotos extends Ruckusing_BaseMigration {

	public function up() {
    $t = $this->create_table("photos");
    $t->column("project_id", "integer");
    $t->column("name", "string");
    $t->column("position", "integer");
    $t->column("created_at", "datetime");
    $t->column("updated_at", "datetime");
    $t->finish();
	}//up()

	public function down() {
	  $this->drop_table('photos');
	}//down()
}
?>