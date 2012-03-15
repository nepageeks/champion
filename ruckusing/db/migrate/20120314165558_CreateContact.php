<?php
class CreateContact extends Ruckusing_BaseMigration {
  
  public function up() {
    $t = $this->create_table("contact");
    $t->column("name", "string");
    $t->column("email", "string");
    $t->column("company", "string");
    $t->column("phone", "string");
    $t->column("subject", "string");
    $t->column("message", "text");
    $t->column("created_at", "datetime");
    $t->column("updated_at", "datetime");
    $t->finish();
  }//up()

  public function down() {
    $this->drop_table("contact"); 
  }//down()
}
?>