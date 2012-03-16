<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$title="Get a Quote";

include(ROOT.'/inc/header.php');
?>

<div class="sub-content">

<div class="sub-sidebar">

<?=BasicCms::block('quote')?>

</div>

<div class="banners">
  <div id="quote" style="margin-bottom: 100px">
    <?php $form = new FormBuilder(array('model' => 'quote',  'action' => './inc/functions.php?f=quote',  'method' => 'post')); ?>
      <?=$form->input(array('name' => 'name', 'label' => '* Name', 'classes' => array('required')))?>
      <?=$form->input(array('name' => 'company', 'label' => '* Company', 'classes' => array('required')))?>
      <?=$form->input(array('name' => 'field1', 'label' => 'Field 1'))?>
      <?=$form->input(array('name' => 'field2', 'label' => 'Field 2'))?>
      <?=$form->input(array('name' => 'field3', 'label' => 'Field 3'))?>
      <?=$form->input(array('name' => 'field4', 'label' => 'Field 4'))?>

      <p style="float: left; width: 200px; margin-top: 7px;"><span>*</span> Required Field</p>
      <p style="float: right; margin: 0;">
        <input type="reset" value="Reset" name="reset" />
        <input type="submit" value="Submit" name="submit" />
      </p>
    <?=$form->end()?>
  </div>
</div>

</div>

<script>
  $(function(){
    $('form').submit(function(){
      var valid = true;
      $('.required').each(function(){
        if ($(this).val() == '') { valid = false; }
      });
      if (!valid) { alert('Please fill in all required fields.'); }
      return valid;
    });
  })
</script>

<?
include(ROOT.'/inc/footer.php');
?>