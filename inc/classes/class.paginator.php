<?php
// 
//  Paginator
//	version 0.3
//  Christopher David YUDICHAK
//

class Paginator
  {
    public $chunked, $data, $options, $pages;
    public $standard_options = array(
      'page' => 'pg',
      'per'  => 10
      );
    
    public function __construct($data, $args = array())
    {
      // Set this instance's options
      $this->options = array_replace($this->standard_options, $args);
      
      // Prepare data
      if (is_resource($data)) { $this->data = $this->prepare_resource($data); }
      else if (is_array($data)) { $this->data = $this->prepare_array($data); }
      else { trigger_error('Data passed to Paginator must be a MySQL resource or array', E_USER_ERROR); }
      
      // Set chunked data
      $this->chunked = array_chunk($this->data, $this->options['per'], true);
      $this->pages = count($this->chunked);
      if (empty($this->chunked)) { $this->chunked[] = array(); }
      array_unshift($this->chunked, '');
    }
    
    public function this_page()
    {
      return $this->chunked[$this->current_page()];
    }
    
    public function current_page()
    {
      return (isset($_GET[$this->options['page']])) ? $_GET[$this->options['page']] : 1;
    }
    
    public function previous($link = 'Prev')
    {
      if ($this->current_page() > 1) {
        $query = $this->prepare_query(array($this->options['page'] => ($this->current_page() - 1)));
        return '<a href="?'.$query.'">'.$link.'</a>';
      } else {
        return '';
      }
    }
    public function next($link = 'Next')
    {
      if ($this->current_page() < $this->pages) {
        $query = $this->prepare_query(array($this->options['page'] => ($this->current_page() + 1)));
        return '<a href="?'.$query.'">'.$link.'</a>';
      } else {
        return '';
      }
    }
    
    private function prepare_resource($data)
    {
      $array = array();
      while ($i = mysql_fetch_assoc($data)) {
        $array[] = $i;
      }
      return $array;
    }
    private function prepare_array($data)
    {
      $array = array();
      foreach ($data as $key => $value) {
        $array[$key] = $value;
      }
      return $array;
    }
    
    private function prepare_query()
    {
      $args = func_get_args();
      parse_str($_SERVER['QUERY_STRING'], $query);
      foreach ($args as $arg) { foreach ($arg as $key => $value) {
        $query[$key] = $value;
      } }
      return http_build_query($query);
    }
  }
  
// ===================================
// = array_replace() (for PHP < 5.3) =
// ===================================
if (!function_exists('array_replace'))
{
  function array_replace( array &$array, array &$array1 )
  {
    $args = func_get_args();
    $count = func_num_args();
 
    for ($i = 0; $i < $count; ++$i) {
      if (is_array($args[$i])) {
        foreach ($args[$i] as $key => $val) {
          $array[$key] = $val;
        }
      }
      else {
        trigger_error(
          __FUNCTION__ . '(): Argument #' . ($i+1) . ' is not an array',
          E_USER_WARNING
        );
        return NULL;
      }
    }
 
    return $array;
  }
}  
?>