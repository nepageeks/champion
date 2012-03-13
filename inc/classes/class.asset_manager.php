<?php
class AssetManager
  {
    public static $caching = array('production');
    public static $minifying = true;
    
    public static $javascripts;
    public static $stylesheets;
    
    public static function javascripts()
      {
        $args = func_get_args();
        foreach ($args as $arg) {
          if (is_string($arg)) { self::$javascripts[] = self::path($arg, 'js'); }
          else if (is_array($arg)) {
            foreach ($arg as $value) {
              self::$javascripts[] = self::path($value, 'js');
            }
          }
        }
      }
      
    public static function stylesheets()
      {
        $args = func_get_args();
        foreach ($args as $arg) {
          if (is_string($arg)) { self::$stylesheets['all'][] = self::path($arg, 'css'); }
          else if (is_array($arg)) {
            foreach ($arg as $key => $value) {
              if (is_int($key)) { self::$stylesheets['all'][] = self::path($value, 'css'); }
              else { self::$stylesheets[$value][] = self::path($key, 'css'); }
            }
          }
        }
      }
      
      public static function display_javascripts()
        {
          $links = array();
          if (self::$caching === true || (is_array(self::$caching) && in_array(ProjectHelper::env(), self::$caching))) {
            $files = self::$javascripts;
            $js_file = '/js/cache/'.substr(md5(serialize($files)), 0, 10).'.js';
            self::check_cache($files, 'js');
            $links[] = '<script src="/js/cache/'.self::cache_name($files).'.js" type="text/javascript" charset="utf-8"></script>';
          } else {
            $links = self::javascript_links();
          }
          return implode("\n", $links);
        }
      
      public static function display_stylesheets()
        {
          $links = array();
          if (self::$caching === true || (is_array(self::$caching) && in_array(ProjectHelper::env(), self::$caching))) {
            foreach (self::$stylesheets as $media => $files) {
              $css_file = '/css/cache/'.substr(md5(serialize($files)), 0, 10).'.css';
              self::check_cache($files, 'css');
              $links[] = '<link rel="stylesheet" href="/css/cache/'.self::cache_name($files).'.css" type="text/css" media="'.$media.'" charset="utf-8" />';
            }
          } else {
            $links = self::stylesheet_links();
          }
          return implode("\n", $links);
        }
      
      private static function check_cache($file_array, $type)
        {
          $filename = $_SERVER['DOCUMENT_ROOT'].'/'.$type.'/cache/'.self::cache_name($file_array).'.'.$type;
          if (!file_exists($filename)) { self::create_cache($file_array, $type); return; }
          $cached_file = file($filename);
          if (strpos($cached_file[0], self::cache_timestamp($file_array)) === false) {
            unlink($filename);
            self::create_cache($file_array, $type);
            return;
          }
        }
        
      private static function create_cache($file_array, $type)
        {
          $cache_dir = $_SERVER['DOCUMENT_ROOT'].'/'.$type.'/cache/';
          if (!file_exists($cache_dir)) { mkdir($cache_dir); }
          $file = '';
          $file .= '/* '.self::cache_timestamp($file_array).' */'."\r\n";
          foreach ($file_array as $filename) {
            if (!preg_match('/https?:\/\//', $filename)) { $filename = $_SERVER['DOCUMENT_ROOT'].$filename; }
            $file_contents = self::$minifying ? Minify::$type(file_get_contents($filename)) : file_get_contents($filename);
            $file .= $file_contents;
          }
          $handle = fopen($cache_dir.self::cache_name($file_array).'.'.$type, 'w');
          fwrite($handle, $file);
          fclose($handle);
        }
        
      private static function cache_name($file_array)
        {
          return substr(md5(serialize($file_array)), 0, 10);
        }
        
      private static function cache_timestamp($file_array)
        {
          $times = array();
          foreach ($file_array as $filename) {
            $file = $_SERVER['DOCUMENT_ROOT'].$filename;
            if (file_exists($file)) {
              $times[] = filemtime($file);
            }            
          }
          return (string)max($times);
        }
        
      private static function path($path, $type)
        {
          if (strpos($path, '.'.$type) === false) { $path .= '.'.$type; }
          if (preg_match('/https?:\/\//', $path)) { return $path; }
          if ($path[0] != '/') { return '/'.$type.'/'.$path; }
          return $path;
        }
        
      private static function javascript_links()
        {
          $links = array();
          foreach (self::$javascripts as $file) {
            $links[] = '<script src="'.$file.'" type="text/javascript" charset="utf-8"></script>';
          }
          return $links;
        }
        
      private static function stylesheet_links()
        {
          $links = array();
          foreach (self::$stylesheets as $media => $files) {
            foreach ($files as $file) {
              $links[] = '<link rel="stylesheet" href="'.$file.'" type="text/css" media="'.$media.'" charset="utf-8" />';
            }
          }
          return $links;
        }
  }
  
function stylesheets()
  {
    AssetManager::stylesheets(func_get_args());
  }
function javascripts()
  {
    AssetManager::javascripts(func_get_args());
  }
?>