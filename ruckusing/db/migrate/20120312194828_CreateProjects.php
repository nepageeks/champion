<?php
class CreateProjects extends Ruckusing_BaseMigration {
  
  public function up() {
    $t = $this->create_table("projects");
    $t->column("title", "string");
    $t->column("location", "string");
    $t->column("start_date", "date");
    $t->column("completion_date", "date");
    $t->column("description", "text");
    $t->column("created_at", "datetime");
    $t->column("updated_at", "datetime");
    $t->finish();
  }//up()

	public function down() {
    $this->drop_table("projects");
	}//down()
}
?>