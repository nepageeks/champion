<?php
class Testimonial extends NORM
{
  public function __construct()
  {
    parent::__construct();
  }
  
  function random() {
    return $this->order_by('RAND()', '', false)->limit(1)->first();
  }
}
?>