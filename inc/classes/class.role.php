<?php
class Role extends NORM
  {
    public function auth()
    {
      return explode(';', $this->auth);
    }
    public function _auth()
    {
      return implode(';', $this->auth);
    }
  }
?>