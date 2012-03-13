<?php
class AuthCode extends NORM
  {
    public function codes($user)
    {
      $codes = array(
        // 'admin' => ($user->username == 'admin')
        );
      
      return array_keys(array_filter($codes));
    }
  }
?>