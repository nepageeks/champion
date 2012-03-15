<?php
/**
* Form Builder Helper
*
* @author Christopher David YUDICHAK
* @version 0.1
**/
 
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
 
class FormBuilder
{
  /**
   * Model name/instance
   *
   * Sets model for form, if available
   *
   * @var string/object (default = null)
   **/
  public $model = null;
  
  /**
   * Label
   *
   * Whether or not to display labels on this form
   *
   * @var boolean
   **/
  public $label = true;
  
  /**
   * Data
   *
   * Holds existing data for form to use
   *
   * @var object
   **/
  public $data;
  
  /**
   * Standard options
   *
   * List of options available by default to all element builders
   *
   * Options
   * for: Property name for form's object (determines attributes and value)
   * name: "name" attribute
   * id: "id" attribute
   * classes: array for "classes" attributes
   * label: <label> element text, or false for no <label>
   * value: "value" attribute
   * value_field: field from which to pull "value" (for associations)
   * options: string of attributes to display inside element
   *
   * @var array
   **/
  public $standard_options = array(
    'for' => '',
    'name' => '',
    'id' => '',
    'classes' => array(),
    'label' => true,
    'value' => '',
    'value_field' => '',
    'wrap' => true,
    'wrap_tag' => 'p',
    'wrap_id' => '',
    'wrap_classes' => array(),
    'options' => '');
  
  public function __construct($args = array())
  {
    $options = array_merge($this->standard_options, array(
    'model' => '',
    'action' => '',
    'method' => '',
    'data' => ''));
    $options = array_replace($options, $args);
    
    // Set the model, if passed
    if (!empty($options['model'])) {
    // If it's a string, set to the string
    if (is_string($options['model'])) { $this->model = $options['model']; }
    // If it's a NORM object, set to object's class name
    if (is_object($options['model'])) { $this->model = $this->modelizer(get_class($options['model'])); $this->data = $options['model']; }
    // If the model is set, name is empty, and the action is not a file...set the name, based on action and model
    if (empty($options['name']) && !strpos($options['action'], '.php')) { $options['name'] = $options['action'].'_'.$this->model; }
    }
    
    // If data still isn't set and the 'data' option has been passed...
    if (empty($this->data) && !empty($options['data'])) {
      if (is_array($options['data'])) { $this->data = $this->convert_to_object($options['data']); }
      else { $this->data = $options['data']; }
    }
    
    if (!empty($this->data) && !is_object($this->data)) { trigger_error('The \'data\' param must be an array or object', E_USER_ERROR); return; }
    
    $this->label = $options['label'];
    
    // Required Values (action)
    if (empty($options['action'])) { trigger_error(__FUNCTION__.'(): Must pass an \'action\' parameter', E_USER_WARNING); return; }
    
    // Set Optional Parameters
    if (empty($options['id'])) { $options['id'] = $this->ider($options['name']); }
    
    // Check/reset action
    if (!strpos($options['action'], '.php')) { $options['action'] = './functions.php?f='.$options['action']; }
    
    // Prepare classes
    $classes = $this->classer($options['classes']);
    
    // Build <form> element
    $form = "<form action=\"{$options['action']}\"";
    // If 'name' is set, display it
    if (!empty($options['name'])) { $form .= ' name="'.$options['name'].'"'; }
    // If 'id' is set, display it
    if (!empty($options['id'])) { $form .= ' id="'.$options['id'].'"'; }
    // If 'method' is set, display it
    if (!empty($options['method'])) { $form .= ' method="'.$options['method'].'"'; }
    // If 'options' are set, display them
    if (!empty($options['options'])) { $form .= ' '.$options['options']; }
    $form .= $classes.'>'."\n";
    echo $form;
  }
  
  public function end()
  {
    return '</form>'."\n";
  }
  
  /**
   * input()
   *
   * Builds and returns <input> element
   *
   * @param array $args Options for <input> element
   * Options:
   * Standard Options
   * type: "type" attribute, must be 'text', 'hidden', or 'password'
   *
   * @return string <input> element
   **/
  public function input($args = array())
  {
    $options = array_merge($this->standard_options, array(
    'type' => 'text'));
    $options = array_replace($options, $args);
    
    // Check for 'for' parameter
    $this->build_from_for($options);
    
    // Required Values (name, type)
    if (empty($options['name'])) { trigger_error(__FUNCTION__.'(): Must pass a \'name\' parameter', E_USER_WARNING); return; }
    if (!in_array($options['type'], array('text', 'hidden', 'password'))) { trigger_error(__FUNCTION__.'(): The \'type\' parameter must be \'text\', \'hidden\', or \'password\'', E_USER_WARNING); return; }
    
    // Prepare attributes
    $this->prepare_attributes($options);
    
    // Build <input> element
    $input = "<input type=\"{$options['type']}\" name=\"{$options['name']}\" id=\"{$options['id']}\" value=\"{$options['value']}\" {$options['classes']} {$options['options']}/>";
    $input .= "\n";
    
    // Build wrapper
    list($open_wrap, $close_wrap) = $this->wrapper($options);
    
    if ($options['type'] == 'hidden') { return $this->displayer($input); }
    else { return $this->displayer($open_wrap, $options['label'], $input, $close_wrap); }
    
  }
  
  /**
   * textarea()
   *
   * Builds and returns <textarea> element
   *
   * @param array $args Options for <textarea> element
   * Options:
   * Standard Options
   *
   * @return string <textarea> element
   **/
  public function textarea($args = array())
  {
    $options = $this->standard_options;
    $options = array_replace($options, $args);
    
    // Check for 'for' parameter
    $this->build_from_for($options);
    
    // Required Values (name)
    if (empty($options['name'])) { trigger_error(__FUNCTION__.'(): Must pass a \'name\' parameter', E_USER_WARNING); return; }
    
    // Prepare attributes
    $this->prepare_attributes($options);
    
    // Build <textarea> element
    $textarea = "<textarea name=\"{$options['name']}\" id=\"{$options['id']}\"";
    // If 'options' are set, display them
    if (!empty($options['options'])) {
    $textarea .= ' '.$options['options'];
    }
    $textarea .= $options['classes'].'>'."\n";
    // Display the value
    $textarea .= $options['value'];
    // Close the <textarea>
    $textarea .= '</textarea>'."\n";
    
    // Build wrapper
    list($open_wrap, $close_wrap) = $this->wrapper($options);
    
    return $this->displayer($open_wrap, $options['label'], $textarea, $close_wrap);
  }
  
  /**
   * checkboxes()
   *
   * Builds and returns checkbox-type <input> element
   *
   * @param array $args Options for <input> element
   * Options:
   * Standard Options
   * text: Array of strings to display as values
   * values: Optional array of strings to use as the checkbox values (key must match 'text' array)
   * value: Optional array of selected values
   *
   * @return string <input> element
   **/
  public function checkboxes($args = array())
  {
    $options = array_merge($this->standard_options, array(
    'text' => null,
    'values' => null,
    'value' => array()));
    $options = array_replace($options, $args);
    
    // Check for 'for' parameter
    $this->build_from_for($options);
    
    // Required Values (name, text)
    if (empty($options['name'])) { trigger_error(__FUNCTION__.'(): Must pass a \'name\' parameter', E_USER_WARNING); return; }
    if (empty($options['text'])) { trigger_error(__FUNCTION__.'(): Must pass a \'text\' parameter', E_USER_WARNING); return; }
    
    // Prepare attributes
    $this->prepare_attributes($options);
    
    // Build checkboxes
    $checkboxes = '';
    $checkboxes .= $this->input(array('type' => 'hidden', 'label' => false, 'name' => $options['for']));
    foreach ($options['text'] as $key => $text) {
    $value = $text;
    if (isset($options['values'][$key])) { $value = $options['values'][$key]; }
    $checkboxes .= '<input type="checkbox" name="'.$options['name'].'[]" id="'.$this->ider($options['id'].'_'.$value).'" value="'.$value.'"'.$options['classes'].' ';
    if ($options['value'] == $value || in_array($value, (array)$options['value'])) { $checkboxes .= 'checked="checked" '; }
    $checkboxes .= '/>'."\n";
    $checkboxes .= $this->labeler($text, $this->ider($options['id'].'_'.$value), 'class="inline"');
    }
    
    // Build wrapper
    list($open_wrap, $close_wrap) = $this->wrapper($options);
    
    return $this->displayer($open_wrap, $options['label'], $checkboxes, $close_wrap);
  }
  
  /**
   * radios()
   *
   * Builds and returns radio-type <input> element
   *
   * @param array $args Options for <input> element
   * Options:
   * Standard Options
   * text: Array of strings to display as values
   * values: Optional array of strings to use as the radio values (key must match 'text' array)
   * value: Optional array of selected values
   *
   * @return string <input> element
   **/
  public function radios($args = array())
  {
    $options = array_merge($this->standard_options, array(
    'text' => null,
    'values' => null,
    'value' => array()));
    $options = array_replace($options, $args);
    
    // Check for 'for' parameter
    $this->build_from_for($options);
    
    // Required Values (name, text)
    if (empty($options['name'])) { trigger_error(__FUNCTION__.'(): Must pass a \'name\' parameter', E_USER_WARNING); return; }
    if (empty($options['text'])) { trigger_error(__FUNCTION__.'(): Must pass a \'text\' parameter', E_USER_WARNING); return; }
    
    // Prepare attributes
    $this->prepare_attributes($options);
    
    // Build checkboxes
    $radios = '';
    foreach ($options['text'] as $key => $text) {
    $value = $text;
    if (isset($options['values'][$key])) { $value = $options['values'][$key]; }
    $radios .= '<input type="radio" name="'.$options['name'].'" id="'.$this->ider($options['id'].'_'.$value).'" value="'.$value.'"'.$options['classes'].' ';
    if ($options['value'] == $value || in_array($value, (array)$options['value'])) { $radios .= 'checked="checked" '; }
    $radios .= '/>'."\n";
    $radios .= $this->labeler($text, $this->ider($options['id'].'_'.$value), 'class="inline"');
    }
    
    // Build wrapper
    list($open_wrap, $close_wrap) = $this->wrapper($options);
    
    return $this->displayer($open_wrap, $options['label'], $radios, $close_wrap);
  }
  
  /**
   * select()
   *
   * Builds and returns <select> element
   *
   * @param array $args Options for <select> element
   * Options:
   * Standard Options
   * text: Array of strings to display as values
   * values: Optional array of strings to use as the <option> values (key must match 'text' array)
   * blank: Whether or not to include a blank <option>
   *
   * @return string <select> element
   **/
  public function select($args = array())
  {
    $options = array_merge($this->standard_options, array(
    'text' => null,
    'values' => null,
    'blank' => false,
    'raw' => false,
    'build' => array()));
    $options = array_replace($options, $args);
    
    // Check for 'for' parameter
    $this->build_from_for($options);
    
    // Build text and values, if necessary
    if (!empty($options['build'])) { $this->select_builder($options); }
    
    // Required Values (name, text)
    if (empty($options['name'])) { trigger_error(__FUNCTION__.'(): Must pass a \'name\' parameter', E_USER_WARNING); return; }
    if (empty($options['text']) && !is_array($options['text']) && !$options['raw']) { trigger_error(__FUNCTION__.'(): Must pass a \'text\' parameter', E_USER_WARNING); return; }
    
    // Prepare attributes
    $this->prepare_attributes($options);
    
    // Build <select> element
    $select = "<select name=\"{$options['name']}\" id=\"{$options['id']}\"";
    // If 'options' are set, display them
    if (!empty($options['options'])) {
    $select .= ' '.$options['options'];
    }
    $select .= $options['classes'].'>'."\n";
    // If 'blank' is true, display blank <option> element
    if ($options['blank']) {
    $select .= '<option></option>'."\n";
    }
    
    // If 'raw' is set, use that; otherwise, build from 'text'
    if ($options['raw']) {
      $select .= $options['raw'];
    } else {
      // Output each <option> element
      foreach ($options['text'] as $key => $t) {
      $value = $t;
      $select .= '<option';
      // If 'values' array is set, use that as the value attribute
      if (isset($options['values'][$key])) { $value = $options['values'][$key]; $select .= ' value="'.$options['values'][$key].'"'; }
      // If this value is the selected value, select it
      if ($options['value'] == $value) { $select .= ' selected="selected"'; }
      $select .= '>'.$t.'</option>'."\n";
      }
    }
    

    // Close the <select>
    $select .= '</select>'."\n";
    
    // Build wrapper
    list($open_wrap, $close_wrap) = $this->wrapper($options);
    
    return $this->displayer($open_wrap, $options['label'], $select, $close_wrap);
  }
  
  /**
   * submit()
   *
   * Builds and returns submit-type <input> element
   *
   * @param array $args Options for <input> element
   * Options:
   * name: "name" attribute
   * id: "id" attribute
   * classes: array for "classes" attributes
   * value: "value" attribute
   * !! DOES NOT USE STANDARD OPTIONS !!
   *
   * @return string <input> element
   **/
  public function submit($args = array())
  {
    $options = array(
    'name' => 'submitBtn',
    'id' => 'submitBtn',
    'classes' => array(),
    'wrap' => true,
    'wrap_tag' => 'p',
    'wrap_id' => '',
    'wrap_classes' => array(),
    'value' => 'Submit');
    $options = array_replace($options, $args);
     
    // Prepare classes
    $options['classes'] = $this->classer($options['classes']);
     
    // Build <input> element
    $submit = "<input type=\"submit\" name=\"{$options['name']}\" value=\"{$options['value']}\" id=\"{$options['id']}\" {$options['classes']}/>\n";
    
    // Build wrapper
    list($open_wrap, $close_wrap) = $this->wrapper($options);
     
    return $this->displayer($open_wrap, $submit, $close_wrap);
  }
  
  /**
   * ider()
   *
   * Builds and returns "id" attribute
   *
   * @param string $string String to display for "id" attribute
   *
   * @return string "id" attribute
   **/
  private function ider($string)
  {
    $string = str_replace(array('[', ':'), '_', $string);
    $string = str_replace(']', '', $string);
    $string = trim($string, '_');
    return $string;
  }
  
  /**
   * namer()
   *
   * Builds and returns "name" attribute
   *
   * @param string $string String to display for "name" attribute
   *
   * @return string "name" attribute
   **/
  private function namer($string)
  {
    if (!empty($this->model)) { $string = $this->model.'['.$string.']'; }
    return $string;
  }
  
  /**
   * labeler()
   *
   * Builds and returns <label> element
   *
   * @param string $string String to display for <label> element
   * @param string $for String to display for "for" attribute
   * @param string $options String for additional attributes to display
   *
   * @return string <label> element
   **/
  private function labeler($label, $for = null, $options = null)
  {
    if (!$this->label) { return ''; }
    if ($label) {
    if (!empty($this->model)) { $label = str_replace($this->model, '', $label); }
    
    $labelString = $label;
    $labelString = str_replace(array('[', ']'), '', $labelString);
    $labelString = str_replace('_', ' ', $labelString);
    $labelString = ucwords($labelString);
    $label = '<label';
    if (!empty($for)) { $label .= ' for="'.$for.'"'; }
    if (!empty($options)) { $label .= ' '.$options; }
    $label .= '>'.$labelString.'</label>'."\n";
    }
    else { $label = ''; }
    
    return $label;
  }
  
  /**
   * classer()
   *
   * Builds and returns "class" attribute
   *
   * @param array $classes Array of classes to display
   *
   * @return string Completed "class" attribute
   **/
  private function classer($classes)
  {
    $classes = implode(' ', $classes);
    if (!empty($classes)) { $classes = ' class="'.$classes.'" '; }
    return $classes;
  }
  
  /**
   * wrapper()
   *
   * Builds an optional wrapper element
   *
   * @param array $options Options passed to the element builder
   *
   * @return array The opener and closer for the wrap, ready to be passed to displayer()
   **/
  private function wrapper($options)
    {
      if ($options['wrap']) {
        $open_wrap = '<'.$options['wrap_tag'].(!empty($options['wrap_id']) ? ' id="'.$options['wrap_id'].'"' : '').(!empty($options['wrap_classes']) ? ' class="'.implode(' ', $options['wrap_classes']).'"' : '').'>'."\n";
        $close_wrap = '</'.$options['wrap_tag'].'>'."\n";
      } else {
        $open_wrap = ''; $close_wrap = '';
      }
      return array($open_wrap, $close_wrap);
    }
  
  /**
   * displayer()
   *
   * Displays element with passed options
   *
   * @param mixed $args Elements to display (overloaded)
   *
   * @return string Requested element
   **/
  private function displayer()
  {
    $args = func_get_args();
    return implode('', $args);
  }
  
  /**
   * prepare_attributes()
   *
   * Prepare comment attributes before building form element
   *
   * @param array $options The options array from this instance (destructive)
   *
   * @return void
   **/
  private function prepare_attributes(&$options)
  {
    // Set name parameter
    $options['name'] = $this->namer($options['name']);
    
    // Set optional parameters
    if (empty($options['id'])) { $options['id'] = $this->ider($options['name']); }
    if ($options['label'] === true) { $options['label'] = $options['name']; }
    
    // Prepare classes
    $options['classes'] = $this->classer($options['classes']);
    
    // Prepare label
    $options['label'] = $this->labeler($options['label'], $options['id']);
  }
  
  /**
   * build_from_for()
   *
   * Set attributes based on instance's 'for' attribute
   *
   * @param array $options The options array from this instance (destructive)
   *
   * @return void
   **/
  private function build_from_for(&$options)
  {
    if (!empty($options['for'])) {
      $options['name'] = $options['for'];
      if (!empty($this->data)) {
        if (empty($options['value_field'])) {
          $options['value'] = $this->data->$options['for'];
        } else {
          $options['value'] = $this->data->$options['for']->$options['value_field'];
        }  
      }
    }
  }
  
  /**
   * select_builder()
   *
   * Set "text" and "values" attributes based on instance's 'build' attribute
   *
   * @param array $options The options array from this instance (destructive)
   *
   * @return void
   **/
  private function select_builder(&$options)
  {
    $options['text'] = NORM::all($options['build'][0], $options['build'][1]);
    if (isset($options['build'][2])) { $options['values'] = NORM::all($options['build'][0], $options['build'][2]); }
  }
  
  /**
   * modelizer()
   *
   * Convert a class to a valid model type
   *
   * @param array $string String to convert
   *
   * @return void
   **/
  private function modelizer($string)
  {
    $string[0] = strtolower($string[0]);
    $func = create_function('$c', 'return " " . strtolower($c[1]);');
    $string = preg_replace_callback('/([A-Z])/', $func, $string);
  	$string = str_replace(' ', '_', $string);
	  $string = strtolower($string);
	  return $string;
  }
  
  private function convert_to_object($array)
  {
  	if(!is_array($array)) {
  		return $array;
  	}
  	$object = new stdClass();
  	if (is_array($array) && count($array) > 0) {
  	  foreach ($array as $name=>$value) {
  	     $name = strtolower(trim($name));
  	     if (!empty($name)) {
  	        $object->$name = $this->convert_to_object($value);
  	     }
  	  }
        return $object;
  	}
      else {
        return FALSE;
      }
  }
}
?>