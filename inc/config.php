<?php
// === Built with Project Starter 0.7 ===

// =============
// = Constants =
// =============

/*** Define constants that you can use throughout your site. ***/

/*
define('ROOT', 'http://www.example.com');
*/
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PROJECT_NAME', 'Champion Builders, Inc.');
// define('GA_ACCTNUM', 'UA-*******-*');

// ========================
// = Database Information =
// ========================

define('DB_HOST', 'localhost');
define('DB_USER', 'champion');
define('DB_PASS', 'psswd123');
define('DB_NAME', 'champion');
if (@$db_load !== false) { include(ROOT.'/inc/opendb.php'); }

// ===========
// = Helpers =
// ===========

/*
	AssetManager
*/
$javascripts = array('jquery-1.7.1.min', 'jquery-ui-1.8.18.custom.min', 'defaults');
$stylesheets = array('smoothness/jquery-ui-1.8.18.custom', 'master', 'flash', 'form_builder');
AssetManager::javascripts($javascripts);
AssetManager::stylesheets($stylesheets);

// ====================
// = Autoload Classes =
// ====================
function __autoload($className)
{
  // Ignore NORM
  if ($className == 'NORM')
    {
      require_once ROOT.'/inc/classes/class.norm.php';
      return;
    }
  $className[0] = strtolower($className[0]);
  $func = create_function('$c', 'return "_" . strtolower($c[1]);');
  $class_name = preg_replace_callback('/([A-Z])/', $func, $className);
  $class_file = ROOT.'/inc/classes/class.'.$class_name.'.php';
  if (file_exists($class_file)) { require_once($class_file); }
}

// ===============
// = UserSession =
// ===============
$session = new UserSession;  
?>