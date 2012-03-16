<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/inc/config.php');

// ====================
// = Admin Navigation =
// ====================

$admin_links = array(        
  'Manage Projects' => array(
    'path' => 'projects',
    'auth' => 'admin'
    ),       
  'Manage Users' => array(
    'path' => 'users',
    'auth' => 'su'
    ),       
  'Manage Auth Codes' => array(
    'path' => 'auth_codes',
    'auth' => 'su'
    ),       
  'Manage Roles' => array(
    'path' => 'roles',
    'auth' => 'su'
    ),       
  'Edit Text' => array(
    'path' => 'cms',
    'auth' => 'admin'
    ),       
  'Manage Files' => array(
    'path' => 'cms_files',
    'auth' => 'su'
    ),    
  'View Contact' => array(
    'path' => 'contact',
    'auth' => 'admin'
    ),
  'Testimonials' => array(
    'path' => 'testimonials',
    'auth' => 'admin'
    ),
  'Quotes' => array(
    'path' => 'quotes',
    'auth' => 'admin'
    ),
  'Manage Blocks' => array(
    'path' => 'blocks',
    'auth' => 'su'
    ));

// ================
// = Admin Config =
// ================
$theme = true;  // To disable theme, set to false

?>