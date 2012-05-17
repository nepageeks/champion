<?php

include('./config.php');



$action = $_GET['f'];

$todayDate = date('Y-m-d H:i:s');



switch ($action)

  {

    case 'contact': 

      $headers['From']    = 'donotreply@championbuildersinc.com';

      $headers['To']      = 'jason@nepageeks.com';

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
$headers['From']    = 'donotreply@championbuildersinc.com';
$headers['To']      = 'jason@nepageeks.com';
$headers['Subject'] = 'New quote request from championbuildersinc.com';

$mailer = new Mailer;
$mailer->load('quote', $_POST['quote']);
$mailer->headers($headers);
$mailer->send();

foreach ($_POST['quote'] as $key => $value) {
  if (is_array($value)) { $value = implode(';', $value); }
  $data[$key] = addslashes($value);
}
$data['created_at'] = date('Y-m-d H:i:s');
$data['updated_at'] = date('Y-m-d H:i:s');
$postQuery  = 'INSERT INTO `quote` (`';
$postQuery .= implode('`, `', array_keys($data));
$postQuery .= '`) VALUES (\'';
$postQuery .= implode('\', \'', array_values($data));
$postQuery .= '\');';
$success = mysql_query($postQuery);

      

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