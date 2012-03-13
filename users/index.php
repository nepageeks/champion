<?
/* Make sure this require() points to config.php. */
require('../inc/config.php');

$session->auth_or_redirect(null, '/login.php', true);

include(ROOT.'/inc/header.php');
?>

<h1>My Account</h1>

<p><a href="./change_password.php">Change Password</a></p>
<p><a href="/logout.php">Logout</a></p>

<?
include(ROOT.'/inc/footer.php');
?>