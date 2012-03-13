<?php
class UserSession
  {
    public $logged_in;
    public $timestamp;
    
    public function __construct()
    {
      @session_start();
      $this->user = new User;
      if (isset($_SESSION['user_session'])) {
        $this->retrieve_from_session();
        $timeout = 20 * 60; // 20 minutes
        if (time() - $this->timestamp > $timeout) { $this->destroy(); }
        else { $this->timestamp = time(); $this->save(); }
      }
    }
    
    public function create($username, $password)
    {
      $username = addslashes($username);
      $password = md5($password);
      $user = new User;
      $user = $user->find(array("`username` = '$username'", "`password` = '$password'"));
      if (empty($user))
        {
          Flash::add('error', 'Incorrect username and/or password');
          header('Location: /login.php');
          exit;
        }
      else
        {
          $this->user = $user[0];
          $this->logged_in = time();
          $this->timestamp = time();
        }
      
      $this->save();
    }
    
    public function save()
    {
      $_SESSION['user_session'] = serialize($this);
    }
    
    public function destroy()
    {
      unset($_SESSION['user_session']);
      foreach (get_object_vars($this) as $key => $value)
        {
          unset($this->$key);
        }
    }
    
    public function auth($code = null)
    {
      if (is_null($code)) {
        return (isset($this->user));
      } else {
        if (in_array('su', $this->user->auth)) { return true; }
        $code = preg_replace_callback('/[^&|()\s]+/', array($this, 'auth_check'), $code);
        return eval('return ('.$code.');');
      }
    }
    
    public function auth_or_redirect($code, $redirect, $message = false, $referrer = true)
    {
      if (!$this->auth($code)) {
        if ($message === true) { Flash::add('error', 'You are not authorized to view that page.'); }
        elseif ($message !==false) { Flash::add('error', $message); }
        if ($referrer) { $_SESSION['referrer'] = $_SERVER['SCRIPT_NAME']; }
        header("Location: $redirect");
        exit;
      }
    }
    
    private function auth_check($match)
    {
      return (in_array($match[0], $this->user->auth)) ? 'true' : 'false';
    }
    
    private function retrieve_from_session()
    {
      $object = unserialize($_SESSION['user_session']);
      foreach (get_object_vars($object) as $key => $value)
        {
          $this->$key = $value;
        }

    }
  }
?>