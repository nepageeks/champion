<?php
class CreateRoles extends Ruckusing_BaseMigration {
  
  public function up() {
    $t = $this->create_table("roles");
    $t->column("name", "string");
    $t->column("auth", "string");
    $t->column("created_at", "datetime");
    $t->column("updated_at", "datetime");
    $t->finish();
  }//up()

	public function down() {
    $this->drop_table("roles");
	}//down()
}
?>