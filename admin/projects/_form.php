<?=$form->input(array('for' => 'title'))?>
<?=$form->input(array('for' => 'location'))?>
<?=$form->input(array('for' => 'size'))?>
<?=$form->select(array('for' => 'type', 'text' => array('Commercial', 'Industrial', 'Healthcare'), 'blank' => true))?>
<?=$form->select(array('for' => 'progress', 'text' => array('In-Progress', 'Completed'), 'blank' => true))?>
<?=$form->select(array('for' => 'construction', 'text' => array('New Construction', 'Pre-Engineered', 'Special Construction'), 'blank' => true))?>
<?=$form->input(array('for' => 'start_date', 'classes' => array('date')))?>
<?=$form->input(array('for' => 'completion_date', 'classes' => array('date')))?>
<?=$form->input(array('for' => 'status'))?>
<?=$form->textarea(array('for' => 'description'))?>

<script>
  $('.date').datepicker();
</script>