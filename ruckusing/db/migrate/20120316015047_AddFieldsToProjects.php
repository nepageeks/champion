<?php

class AddFieldsToProjects extends Ruckusing_BaseMigration {

	public function up() {
	  $this->add_column('projects', 'size', 'string');
	  $this->add_column('projects', 'type', 'string');
	  $this->add_column('projects', 'construction', 'string');
	  $this->add_column('projects', 'status', 'string');
	}//up()

	public function down() {
	  $this->remove_column('projects', 'size');
	  $this->remove_column('projects', 'type');
	  $this->remove_column('projects', 'construction');
	  $this->remove_column('projects', 'status');
	}//down()
}
?>