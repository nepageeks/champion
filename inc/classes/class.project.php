<?php
class Project extends NORM
{
  public function __construct()
  {
    parent::__construct();
    $this->has_many('photos');
  }
  
  function _start_date($date) {
    return date('Y-m-d', strtotime($date));
  }
  function _completion_date($date) {
    return date('Y-m-d', strtotime($date));
  }
}
?>