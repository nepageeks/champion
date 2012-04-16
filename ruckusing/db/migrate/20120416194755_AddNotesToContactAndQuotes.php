<?php

class AddNotesToContactAndQuotes extends Ruckusing_BaseMigration {

	public function up() {
	  $this->add_column('contact', 'notes', 'text');
	  $this->add_column('quotes', 'notes', 'text');
	}//up()

	public function down() {
	  $this->remove_column('contact', 'notes');
	  $this->remove_column('quotes', 'notes');
	}//down()
}
?>