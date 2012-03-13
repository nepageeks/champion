<?=$form->select(array('for' => 'category_id', 'label' => 'Category', 'blank' => true, 'build' => array('CmsCategory', 'name', 'id')))?>
<?=$form->input(array('for' => 'name', 'label' => 'ID/Name'))?>
<?=$form->input(array('for' => 'title', 'label' => 'Block Title'))?>
<?=$form->input(array('for' => 'location', 'label' => 'Block Location'))?>
<?=$form->input(array('for' => 'description', 'label' => 'Page Description'))?>
<?=$form->submit(array('value' => 'Save'))?>