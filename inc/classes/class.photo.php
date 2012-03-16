<?php
class Photo extends NORM
{
  public function __construct()
  {
    parent::__construct();
    $this->belongs_to('project');
  }
}
?>