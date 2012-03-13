<?php
class CmsBlock extends NORM
  {
    public function __construct()
    {
      parent::__construct();
      $this->belongs_to('category', array('class' => 'CmsCategory'));
    }
  }
?>