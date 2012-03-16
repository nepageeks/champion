<?php
class CreateQuotes extends Ruckusing_BaseMigration {
  
  public function up() {
    $t = $this->create_table("quotes");
    $t->column("name", "string");
    $t->column("company", "string");
    $t->column("field1", "string");
    $t->column("field2", "string");
    $t->column("field3", "string");
    $t->column("field4", "string");
    $t->column("created_at", "datetime");
    $t->column("updated_at", "datetime");
    $t->finish();
  }//up()

	public function down() {
    $this->drop_table("quotes");
	}//down()
}
?>