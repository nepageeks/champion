<?php

class AddProgressToProjects extends Ruckusing_BaseMigration {

	public function up() {
	  $this->add_column('projects', 'progress', 'string');
	}//up()

	public function down() {
	  $this->remove_column('projects', 'progress');
	}//down()
}
?>