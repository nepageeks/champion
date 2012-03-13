<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$session->auth_or_redirect(null, '/login.php', true);

include(ROOT.'/inc/header.php');
?>

<form action="/users/functions.php?f=forgot" method="POST">
	Email: <input type="text" name="email" value="" id="email" />
	<input type="submit" name="submitBtn" value="Submit" id="submitBtn" />
</form>

<?
include(ROOT.'/inc/footer.php');
?>