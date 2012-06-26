<?=$form->input(array('for' => 'name'))?>

<?=$form->input(array('for' => 'business_name'))?>

<?=$form->input(array('for' => 'address_1'))?>

<?=$form->input(array('for' => 'address_2'))?>

<?=$form->input(array('for' => 'city'))?>

<?=$form->input(array('for' => 'state'))?>

<?=$form->input(array('for' => 'zip'))?>

<?=$form->input(array('for' => 'phone'))?>

<?=$form->input(array('for' => 'cell_phone'))?>

<?=$form->input(array('for' => 'email'))?>

<?=$form->input(array('for' => 'project_location'))?>

<?=$form->select(array('for' => 'type_of_occupancy', 'text' => array('Commercial','Industrial','Manufactural','Institutional','Offices','Fit-Out Stores','Long Term Care'), 'blank' => true))?>

<?=$form->select(array('for' => 'work_involved', 'text' => array('Renovation','Addition','New Construction','Combination'), 'blank' => true))?>

<?=$form->select(array('for' => 'permit_status', 'text' => array('Issued','Submitted for Review','Permit Process not Started'), 'blank' => true))?>

<?=$form->input(array('for' => 'square_footage_of_project'))?>

<?=$form->textarea(array('for' => 'building_dimensions_if_known'))?>

<?=$form->select(array('for' => 'type_of_exterior_construction', 'text' => array('Pre-fabricated metal building','Block','Stone','Wood','Siding'), 'blank' => true))?>

<?=$form->select(array('for' => 'type_of_roofing', 'text' => array('Metal','Wood','Shingles','Standing Seam'), 'blank' => true))?>

<?=$form->select(array('for' => 'type_of_doors', 'text' => array('Interior','Exterior','Steel','Wood','Glass Storefronts','Overhead Doors','Dock Equipment'), 'blank' => true))?>

<?=$form->select(array('for' => 'mechanical_work_involved', 'text' => array('Plumbing','HVAC','Electrical','Fire Protection'), 'blank' => true))?>

<?=$form->textarea(array('for' => 'notes'))?>