<?php
class CmsCategory extends NORM
  {
    public function __construct()
    {
      parent::__construct();
      $this->has_many('blocks', array('class' => 'CmsBlock'));
    }
  }
?>