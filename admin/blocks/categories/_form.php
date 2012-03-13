<?=$form->input(array('for' => 'name'))?>
<?=$form->select(array('for' => 'parent', 'blank' => true, 'build' => array('CmsCategory', 'name', 'id')))?>
<?=$form->submit(array('value' => 'Save'))?>
