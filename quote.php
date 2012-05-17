<?

/* Make sure this require() points to config.php. */

require('./inc/config.php');



$title="Get a Quote";



include(ROOT.'/inc/header.php');

?>



<div class="sub-content">



<div class="sub-sidebar">



<h2><?=BasicCms::title('quote')?></h2>



<?=BasicCms::block('quote')?>



</div>



<div class="banners">

  <div id="quote" style="margin-bottom: 100px">

    <?php $form = new FormBuilder(array('model' => 'quote',  'action' => './inc/functions.php?f=quote',  'method' => 'post')); ?>
  <?=$form->input(array('name' => 'name'))?>
  <?=$form->input(array('name' => 'business_name'))?>
  <?=$form->input(array('name' => 'address_1'))?>
  <?=$form->input(array('name' => 'address_2'))?>
  <?=$form->input(array('name' => 'city'))?>
  <?=$form->input(array('name' => 'state'))?>
  <?=$form->input(array('name' => 'zip'))?>
  <?=$form->input(array('name' => 'phone'))?>
  <?=$form->input(array('name' => 'cell_phone'))?>
  <?=$form->input(array('name' => 'email'))?>
  <?=$form->input(array('name' => 'project_location'))?>
  <?=$form->select(array('name' => 'type_of_occupancy', 'text' => array (  0 => 'Commercial','Industrial','Manufactural','Institutional','Offices','Fit-Out Stores','Long Term Care'), 'values' => array (  0 => 'Commercial','Industrial','Manufactural','Institutional','Offices','Fit-Out Stores','Long Term Care')))?>
  <?=$form->select(array('name' => 'work_involved', 'text' => array (  0 => 'Renovation','Addition','New Construction','Combination'), 'values' => array (  0 => 'Renovation','Addition','New Construction','Combination')))?>
  <?=$form->select(array('name' => 'permit_status', 'text' => array (  0 => 'Issued','Submitted for Review','Permit Process not Started'), 'values' => array (  0 => 'Issued','Submitted for Review','Permit Process not Started')))?>
  <?=$form->input(array('name' => 'square_footage_of_project'))?>
  <?=$form->textarea(array('name' => 'building_dimensions_if_known'))?>
  <?=$form->select(array('name' => 'type_of_exterior_construction', 'text' => array (  0 => 'Pre-fabricated metal building','Block','Stone','Wood','Siding'), 'values' => array (  0 => 'Pre-fabricated metal building','Block','Stone','Wood','Siding')))?>
  <?=$form->select(array('name' => 'type_of_roofing', 'text' => array (  0 => 'Metal','Wood','Shingles','Standing Seam'), 'values' => array (  0 => 'Metal','Wood','Shingles','Standing Seam')))?>
  <?=$form->select(array('name' => 'type_of_doors', 'text' => array (  0 => 'Interior','Exterior','Steel','Wood','Glass Storefronts','Overhead Doors','Dock Equipment'), 'values' => array (  0 => 'Interior','Exterior','Steel','Wood','Glass Storefronts','Overhead Doors','Dock Equipment')))?>
  <?=$form->select(array('name' => 'mechanical_work_involved', 'text' => array (  0 => 'Plumbing','HVAC','Electrical','Fire Protection'), 'values' => array (  0 => 'Plumbing','HVAC','Electrical','Fire Protection')))?>



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
