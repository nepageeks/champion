<?php
class ProjectHelper
  {
    public static $environment;
    
    public static function env()
      {
        if (!empty(self::$environment)) { return self::$environment; }
        else { return self::check_environment(); }
      }
      
    public static function check_environment() {
      if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
        self::$environment = 'development';
      } else {
        if (strpos($_SERVER['DOCUMENT_ROOT'], '/development/') !== false) {
          self::$environment = 'development';
        } elseif (strpos($_SERVER['DOCUMENT_ROOT'], '/staging/') !== false) {
          self::$environment = 'staging';
        } else {
          self::$environment = 'production';
        }
      }
      return self::$environment;
    }
  }
?>