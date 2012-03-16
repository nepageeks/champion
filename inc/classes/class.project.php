<?php
class Project extends NORM
{
  public function __construct()
  {
    parent::__construct();
    $this->has_many('photos', array('order_by' => 'position'));
  }
  
  function _start_date($date) {
    return date('Y-m-d', strtotime($date));
  }
  function _completion_date($date) {
    return date('Y-m-d', strtotime($date));
  }
  function photo() {
    $p = new Photo;
    return $p->order_by('position')->first_by_project_id($this->id);
  }
}
?>