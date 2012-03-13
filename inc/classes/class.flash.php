<?php
// 
//  Flash
//	version 0.2
//  
//  Created by Christopher David Yudichak on 2010-10-28.
//  Copyright 2010 Christopher David Yudichak. All rights reserved.
// 

class Flash
  {
    public static $flash = array();
    
    public function add($type, $message)
    {
      $_SESSION['flash'][$type] = $message;
    }
    
    public function display()
    {
      self::$flash = self::load();
      foreach (self::$flash as $type => $message) {
        ?>
<div class="flash_<?=$type?>">
	<?=$message?>
</div>
        <?php
      }
    }
    
    public function keep()
    {
      $_SESSION['flash'] = self::$flash;
    }
    
    private function load()
    {
      $flash = array();
      @session_start();
      if (isset($_SESSION['flash'])) {
      	$flash = $_SESSION['flash'];
      	unset($_SESSION['flash']);
      }
      return $flash;
    }
  }
?>