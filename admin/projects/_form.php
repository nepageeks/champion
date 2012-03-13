<?=$form->input(array('for' => 'title'))?>
<?=$form->input(array('for' => 'location'))?>
<?=$form->input(array('for' => 'start_date', 'classes' => array('date')))?>
<?=$form->input(array('for' => 'completion_date', 'classes' => array('date')))?>
<?=$form->textarea(array('for' => 'description'))?>

<script>
  $('.date').datepicker();
</script>