<?php
class CreateAuthCodes extends Ruckusing_BaseMigration {
  
  public function up() {
    $t = $this->create_table("auth_codes");
    $t->column("code", "string");
    $t->column("name", "string");
    $t->column("created_at", "datetime");
    $t->column("updated_at", "datetime");
    $t->finish();
  }//up()

	public function down() {
    $this->drop_table("auth_codes");
	}//down()
}
?>