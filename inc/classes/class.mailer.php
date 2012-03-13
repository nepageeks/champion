<?php
class Mailer
  {
    public $mailer_dir;
    public $text_body;
    public $html_body;
    public $headers;
    
    public function __construct()
    {
      $this->mailer_dir = $_SERVER['DOCUMENT_ROOT'].'/inc/mailers/';
      if (!file_exists($this->mailer_dir)) { trigger_error('Mailer directory does not exist: '.$this->mailer_dir, E_USER_ERROR); }
    }
    
    public function load($mailer_name, $data = array())
    {
      $mailers = glob($this->mailer_dir.$mailer_name.'*');
      if (empty($mailers)) { trigger_error('Can\'t find any mailers named "'.$mailer_name.'"', E_USER_ERROR); }
      foreach ($mailers as $mailer) {
        if (preg_match('/'.$mailer_name.'.(.+)?.php/', $mailer, $type)) {
          switch ($type[1]) {
            case 'html':
              $this->html_body = wordwrap($this->parse_to_string($mailer, $data));
              break;
            case 'text':
              $this->text_body = $this->parse_to_string($mailer, $data);
              break;
          }
        }
      }
    if (empty($this->text_body) && empty($this->html_body)) { trigger_error('Loaded neither text nor HTML mailers', E_USER_ERROR); }
    if (empty($this->html_body)) { $this->html_body = wordwrap($this->text_body); }
    if (empty($this->text_body)) { $this->text_body = trim(strip_tags($this->html_body)); }
    var_dump($this);
    }
    
    public function headers($headers)
    {
      $this->headers = $headers;
    }
    
    public function send()
    {
      include('Mail.php');
      include('Mail/mime.php');
      
      $mime = new Mail_mime();
      
      $mime->setTXTBody($this->text_body);
      $mime->setHTMLBody($this->html_body);
      
      $body = $mime->get();
      $headers = $mime->headers($this->headers);
      
      $mail_object =& Mail::factory('mail');
      $mail_object->send($this->headers['To'], $headers, $body);
    }
    
    private function parse_to_string($mailer, $data)
    {
      ob_start();
      include $mailer;
      $parsed = ob_get_contents();
      ob_end_clean();
      return $parsed;
    }
  }
?>