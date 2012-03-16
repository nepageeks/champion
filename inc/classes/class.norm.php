<?php
/**
 * NORM - NORM Object-Relational Mapper
 * 
 * This is a very basic ORM to speed development of web applications
 * 
 * @version pre-0.2
 * @author Christopher David YUDICHAK <Christopher@cobaltceiling.com>
 * @license X11
 * @copyright (C) 2010 Christopher David YUDICHAK
 *
 */

class NORM
{
  /**
   * Config
   *
   * Stores configuration information for model
   *
   * @var object
   **/
  public $config;
  
  function __construct($options = null)
  {
    $this->config->associations = array();
    
    if (isset($options['table_name'])) {
      $this->config->table_name = $options['table_name'];
    } else {
      $this->config->table_name = Inflect::pluralize(strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', get_class($this))));
    }
    $this->config->ignore = array('config', 'id', 'created_at');
    
    $fields = mysql_query("SHOW COLUMNS FROM {$this->config->table_name}") or trigger_error("Table `{$this->config->table_name}` does not exist", E_USER_ERROR);
    while ($f = mysql_fetch_assoc($fields)) {
      $this->$f['Field'] = null;
      if (method_exists($this, $f['Field'])) {
        $this->$f['Field'] = $this->$f['Field']();
      }
    }
  }
  
  public function __get($name)
  {
    if (array_key_exists($name, $this->config->associations)) { // Association [NORM::run_association()]
      return $this->run_association($name);
    } else if (method_exists($this, $name)) {  // Virtual Attributes
      return $this->$name();
    } else {
      trigger_error("Property $name doesn't exist", E_USER_ERROR);
    }
  }
  
  public function __call($name, $arguments)
  {
    if (preg_match('/(find|first)_by_(.+)/', $name, $matches)) { // Dynamic finders [NORM::dynamic_finder()]
      $fields = explode('_and_', $matches[2]);
      return $this->dynamic_finder($fields, $arguments, $matches[1]);
    } elseif (preg_match('/(validates)_(.+)/', $name, $matches)) { // Validators [NORM::validate()]
      $this->config->validations[$matches[2]][] = $arguments[0];
    } else {
      trigger_error("Method $name doesn't exist", E_USER_ERROR);
    }
  }
  
  /**
   * find()
   * 
   * Find records in database by id or array of conditions
   * 
   * @param mixed $conditions An integer id or array of string conditions (default: performs search of all records)
   * @param array $options Options to customize the created object(s)
   *
   * @return mixed If find(id), objectified record; if find(conditions), array of objectified records
   **/
  public function find($conditions = array('1=1'), $options = array('index' => null))
  {
    $class = get_class($this);
    if (!is_array($conditions)) {
      $id = addslashes($conditions);
      $attribs = mysql_fetch_assoc(mysql_query("SELECT * FROM `{$this->config->table_name}` WHERE `id` = '$id'"));
      $m = new $class();
      $m->update_attributes($attribs, 'get');
      return $m;
    } else {
      $query_string = implode(' AND ', $conditions);
      if (!empty($this->config->order)) { $query_string .= ' ORDER BY '.$this->config->order.''; }
      if (!empty($this->config->limit)) { $query_string .= ' LIMIT '.$this->config->limit.''; }
      $get = mysql_query('SELECT * FROM `'.$this->config->table_name.'` WHERE '.$query_string);
      $members = array();
      while ($m = mysql_fetch_assoc($get)) {
        $member = new $class();
        $member->update_attributes($m, 'get');
        if (is_null($options['index'])) {
          $members[] = $member;
        } else {
          $members[$m[$options['index']]] = $member;
        }
      }
      return $members;
    }
    return array();
  }
  
  /**
   * first()
   * 
   * Returns first record in database with given conditions
   * 
   * @param mixed $conditions Array of string conditions
   *
   * @return object Requested object
   **/
  public function first($conditions = array('1=1'))
  {
    $members = $this->find($conditions);
    if (empty($members)) { return null; }
    else { return $members[0]; }
  }
  
  /**
   * order_by()
   * 
   * Set the order in which a model should be displayed when pulled from the database
   * 
   * @param string $field The field by which to sort the records
   * @param string $order Order to follow (default: ASC)
   *
   * @return object $this, to allow inline function call
   **/
  public function order_by($field = null, $order = 'ASC', $escape = true)
  {
    if (!is_null($field)) {
      if ($escape) { $field = '`'.$field.'`'; }
      $this->config->order = "$field $order"; 
    }
    return $this;
  }
  
  public function limit($limit)
  {
    if (!is_null($limit)) {
      $this->config->limit = $limit; 
    }
    return $this;
  }
  
  /**
   * count()
   * 
   * Return the count of records in the database
   *
   * @return integer Count of records
   **/
  public function count()
  {
    $query = mysql_fetch_assoc(mysql_query("SELECT COUNT(*) AS `count` FROM `{$this->config->table_name}`"));
    return $query['count'];
  }
  
  /**
   * all()
   * 
   * Returns all records for a given model without instantiating an object
   * 
   * @param string $class The class of the model on which to perform the search
   * @param string $field If provided, an array of just the specified field will be returned (default: null)
   * @param string $key_field The value in this field will be the key for that array entry (default: null)
   *
   * @return array Array of objectified records
   **/
  public function all($class, $field = null, $key_field = null)
  {
    $obj = new $class;
    if (is_null($field)) {
      return $obj->find();
    } else {
      $array = array();
      $objs = $obj->find();
      foreach ($objs as $o) {
        if (is_null($key_field)) { $array[] = $o->$field; }
        else { $array[$o->$key_field] = $o->$field; }
      }
      return $array;
    }    
  }
  
  /**
   * create()
   * 
   * Creates new record in the database
   * 
   * @param array $attribs Attributes for the new record
   *
   * @return void
   **/
  public function create($attribs = array())
  {
    $date = date('Y-m-d H:i:s');
    $create_query = 'INSERT INTO `'.$this->config->table_name.'` (`created_at`, `updated_at`) VALUES (\''.$date.'\', \''.$date.'\')';
    $create = mysql_query($create_query);
    $this->id = mysql_insert_id();
    $this->created_at = $date;
    $this->updated_at = $date;
    $this->update($attribs);
    if (!$this->valid()) { $this->delete(); $this->id = null; }
  }
  
  /**
   * update_attributes()
   * 
   * Update the attributes of a model
   * 
   * @param array $attribs Attributes for the model
   *
   * @return void
   **/
  public function update_attributes($attribs, $method = 'set')
  {
    foreach ($attribs as $key => $value) {
      if (property_exists($this, $key)) {
        switch ($method) {
          case 'get':
            $func = $key;
            break;
          case 'set':
            $func = '_'.$key;
            break;
        }
        $this->$key = $value;
        if (is_string($this->$key)) { $this->$key = stripslashes($this->$key); }
        if (method_exists($this, $func)) { $this->$key = call_user_func(array($this, $func), $this->$key); }
      }
    }
  }
  
  /**
   * update()
   * 
   * Update the attributes of a model and save the changes to the database
   * 
   * @param array $attribs Attributes for the model
   *
   * @return void
   **/
  public function update($attribs)
  {
    $this->update_attributes($attribs);
    $this->save();
    return $this;
  }
  
  /**
   * save()
   * 
   * Save the current state of the object to the database
   *
   * @return void
   **/
  public function save()
  {
    if ($this->valid()) {
      $this->updated_at = date('Y-m-d H:i:s');
      foreach ($this as $key => $value) {
        if (!in_array($key, $this->config->ignore) && $value !== null && !is_object($value) && !is_array($value)) {
          $sql_updates[] = '`'.$key.'` = \''.addslashes($value).'\'';
        }
      }
      
      $query = 'UPDATE `'.$this->config->table_name.'` SET '.implode(', ', $sql_updates).' WHERE `id` = '.$this->id;
      mysql_query($query);
      return true;
    } else {
      return false;
    }
  }
  
  /**
   * delete()
   * 
   * Delete the current object from the database
   *
   * @return void
   **/
  public function delete()
  {
    mysql_query('DELETE FROM `'.$this->config->table_name.'` WHERE `id` = '.$this->id);
  }
  
  /**
   * Associations
   * 
   * Associations accept the following standard options:
   * as: Name of the object property in which the assocations will be stored
   * field: Name of the field on which to make the association
   **/
  
  /**
   * belongs_to()
   * 
   * Prepare a belongs_to association to another model type (This model contains a foreign key for another given model)
   * 
   * @param string $class Class of the associated model
   * @param array $options Standard association options (see above)
   *
   * @return void
   **/
  public function belongs_to($class, $options = array())
  {
    $property = (isset($options['as'])) ? $options['as'] : $class;
    $options['model'] = (isset($options['class'])) ? $options['class'] : $class;
    $this->config->associations[$property] = array('belongs_to' => $options);
    return;
  }
  
  /**
   * has_one()
   * 
   * Prepare a has_one association to another model type (Another given model contains a foreign key for this model)
   * 
   * @param string $class Class of the associated model
   * @param array $options Standard association options (see above)
   *
   * @return void
   **/
  public function has_one($class, $options = array())
  {
    $property = (isset($options['as'])) ? $options['as'] : $class;
    $options['model'] = (isset($options['class'])) ? $options['class'] : $class;
    $this->config->associations[$property] = array('has_one' => $options);
    return;
  }
  
  /**
   * has_many()
   * 
   * Prepare a has_many association to another model type (Multiple records of another given model contain a foreign key for this model)
   * 
   * @param string $classes Class of the associated model (plural)
   * @param array $options Standard association options (see above)
   *
   * @return void
   **/
  public function has_many($classes, $options = array())
  {
    $property = (isset($options['as'])) ? $options['as'] : $classes;
    $options['model'] = (isset($options['class'])) ? $options['class'] : $classes;
    $this->config->associations[$property] = array('has_many' => $options);
    return;
  }
  
  /**
   * run_association()
   * 
   * Runs association when requested
   * 
   * @param string $class Class of the association to run
   *
   * @return Association model(s)
   **/
  private function run_association($class)
  {
    $type = key($this->config->associations[$class]);
    $options = $this->config->associations[$class][$type];
    
    $class_name = $this->classify(Inflect::singularize($options['model']));
    $c  = new $class_name;
    
    // Set the field for lookup
    if (isset($options['field'])) { $id_field = $options['field']; }
    else { $id_field = ($type == 'belongs_to') ? $options['model'].'_id' : strtolower(get_class($this)).'_id'; }
    // Perform search
    list($find, $param) = ($type == 'belongs_to') ? array('find_by_id', $this->$id_field) : array('find_by_'.$id_field, $this->id);
    $members = $c->order_by(@$options['order_by'])->$find($param);
    array_push($this->config->ignore, $class);
    if (empty($members)) { return null; }
    else { return ($type == 'has_many') ? $members : $members[0]; }
  }
  
  /**
   * classify()
   * 
   * Convert a string to a valid class name
   * 
   * @param string $string String to classify
   *
   * @return string Altered string
   **/
  private function classify($string)
  {
    $string = str_replace('_', ' ', $string);
    $string = ucwords($string);
    $string = str_replace(' ', '', $string);
    return $string;
  }
  
  /**
   * dynamic_finder()
   * 
   * Builds find()/first() conditions dynamically from method name
   * 
   * @param array $fields Fields for conditions
   * @param array $arguments Array of arguments passed to method
   * @param array $type Type of lookup to perform (find/first)
   *
   * @return mixed Results of lookup
   **/
  private function dynamic_finder($fields, $arguments, $type = 'find')
  {
    foreach ($fields as $key => $field) {
      $conditions[] = "`$field` = '{$arguments[$key]}'";
    }
    return $this->$type($conditions);
  }
  
  public function valid()
  {
    foreach ($this->config->validations as $validator => $fields) {
      foreach ($fields as $field) {
        if (!$this->validate($field, $validator)) { $this->config->errors[] = $field.' did not pass '.$validator; }
      }
    }
    return empty($this->config->errors);
  }
  
  public function validate($field, $validator)
  {
    switch ($validator) {
      case 'presence_of':
        return !empty($this->$field);
        break;
      case 'numericality_of':
        return is_numeric($this->$field);
        break;
    }
  }
}

?>