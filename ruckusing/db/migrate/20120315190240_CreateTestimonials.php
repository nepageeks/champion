<?php
class CreateTestimonials extends Ruckusing_BaseMigration {
  
  public function up() {
    $t = $this->create_table("testimonials");
    $t->column("name", "string");
    $t->column("company", "string");
    $t->column("text", "text");
    $t->column("created_at", "datetime");
    $t->column("updated_at", "datetime");
    $t->finish();
  }//up()

	public function down() {
    $this->drop_table("testimonials");
	}//down()
}
?>