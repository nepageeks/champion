<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

if (isset($_SESSION['user_session']))
  {
    header('Location: ./index.php');
    exit();
  }

$stylesheets[] = 'user_management';

include(ROOT.'/inc/header.php');
?>

<?php include ROOT.'/sessions/_form.php'; ?>

<p><a href="forgot_password.php">Forgot Password?</a></p>

<?
include(ROOT.'/inc/footer.php');
?>