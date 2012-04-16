<?php
class User extends NORM
  {
    public $role = false;
    
    public function __construct()
    {
      parent::__construct();
      $this->config->ignore[] = 'role';
    }
    
    public function auth()
    {
      if (preg_match('/{([0-9]+)}/', $this->auth, $role)) {
        $this->role = $role[1];
        $role_obj = new Role;
        $role_obj = $role_obj->find($this->role);
        $auths = $role_obj->auth;
      } else {
        $auths = explode(';', $this->auth);
      }
      $auths = array_filter(array_merge($auths, AuthCode::codes($this)));
      return $auths;
    }
        
    public function signup($params)
    {
    	if (empty($params['first_name']) || empty($params['last_name']) || empty($params['email']) || empty($params['username']) || empty($params['password'])) {
	    	return 'empty';
	    }
    	if ($params['password'] != $params['confirm']) {
    		return 'match';
    	}
    	$checkExisting = mysql_query("SELECT * FROM `users` WHERE `email` = '{$params['email']}' OR `username` = '{$params['username']}'");
    	if (mysql_num_rows($checkExisting) != 0) {
    		return 'exists';
    	}
    	
    	$params['password'] = md5($params['password']);
    	
    	$this->create($params);
    	return 'success';
    }
    
    public function forgot_password($email)
    {
      $user = new User;
      $user = $user->find(array("`email` = '$email'"));
    	if (empty($user)) {
    		return 'nouser'; break;
    	}
    	$user = $user[0];
    	$new_password = $this->pass_gen();
    	$array['password'] = md5($new_password);
    	$user->update($array);
    	mail($email, 'Your New Password', 'Your new password is: '.$new_password, 'From: donotreply@donotreply.com');
    	return 'success';
    }
    
    public function change_password($params)
    {
      $session = $GLOBALS['session'];
      if ($params['password'] != $params['confirm']) {
        return 'match';
      }
      if ($params['password'] == '') {
        return 'empty';
      }
      $user = new User;
      $user = $user->find($session->user->id);
      if (md5($params['old']) != $user->password) {
        return 'old';
      }
      $array['password'] = md5($params['password']);
      $user->update($array);
      return 'success';
    }
    
    private function pass_gen($length = 8, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890')
    {
      $chars_length = (strlen($chars) - 1);
      $string = $chars{rand(0, $chars_length)};
      for ($i = 1; $i < $length; $i = strlen($string))
      {
          $r = $chars{rand(0, $chars_length)};
          if ($r != $string{$i - 1}) $string .=  $r;
      }
      return $string;
    }
  }
?>