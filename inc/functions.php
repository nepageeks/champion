<?php
include('./config.php');

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    case 'contact': 
      $headers['From']    = 'noreply@example.com';
      $headers['To']      = 'client@example.com';
      $headers['Subject'] = 'Form Submission';

      $mailer = new Mailer;
      $mailer->load('contact', $_POST['contact']);
      $mailer->headers($headers);
      $mailer->send();

      foreach ($_POST['contact'] as $key => $value) {
        if (is_array($value)) { $value = implode(';', $value); }
        $data[$key] = addslashes($value);
      }
      $data['created_at'] = date('Y-m-d H:i:s');
      $data['updated_at'] = date('Y-m-d H:i:s');
      $postQuery  = 'INSERT INTO `contact` (`';
      $postQuery .= implode('`, `', array_keys($data));
      $postQuery .= '`) VALUES (\'';
      $postQuery .= implode('\', \'', array_values($data));
      $postQuery .= '\');';
      $success = mysql_query($postQuery);
      
      Flash::add('success', 'Thanks for your submission. We\'ll contact you shortly.');
      
      $URL = '/contact.php';
      break;
      
    case 'quote':
      $quote = new Quote;
      $quote->create($_POST['quote']);
      
      Flash::add('success', 'Thanks for your submission. We\'ll contact you shortly.');
      
      $URL = '../quote.php';
      break;
      
    default:
      exit;
      break;
  }

header("Location: $URL");

include('./closedb.php');
?>