<?

/* Make sure this require() points to config.php. */

require('./inc/config.php');



$title="Contact Us";



include(ROOT.'/inc/header.php');

?>



<div class="sub-content">

<div class="sub-sidebar" style="height: 550px;">



<h2><?=BasicCms::title('contact')?></h2>



<?=BasicCms::block('contact')?>



</div>



<div class="banners">

<div class="contact">



<?php $form = new FormBuilder(array('model' => 'contact',  'action' => './inc/functions.php?f=contact',  'method' => 'post')); ?>

  <?=$form->input(array('name' => 'name', 'label' => '* Name', 'classes' => array('required'), 'options' => 'style="width: 200px"'))?>

  <?=$form->input(array('name' => 'email', 'label' => '* Email Address', 'classes' => array('required'), 'options' => 'style="width: 250px"'))?>

  <?=$form->input(array('name' => 'company', 'label' => 'Company/Website', 'options' => 'style="width: 250px"'))?>

  <?=$form->input(array('name' => 'phone'))?>

  <?=$form->input(array('name' => 'subject', 'options' => 'style="width: 350px"'))?>

  <?=$form->textarea(array('name' => 'message', 'label' => '* Message', 'classes' => array('required'), 'options' => 'cols="50" rows="5" style="width: 520px;"'))?>

  

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