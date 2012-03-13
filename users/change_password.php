<?
/* Make sure this require() points to config.php. */
require('../inc/config.php');

$session->auth_or_redirect(null, '/login.php', true);

include(ROOT.'/inc/header.php');
?>

<h1>My Account</h1>

<p><a href="./">Back</a></p>

<form action="./functions.php?f=change" method="POST">
	<p>
		<label>Old Password</label><br />
		<input type="password" name="old" value="" id="old" />
	</p>
	<p>
		<label>New Password</label><br />
		<input type="password" name="password" value="" id="password" />
	</p>
	<p>
		<label>Confirm</label><br />
		<input type="password" name="confirm" value="" id="confirm" />
	</p>
	<p>
		<input type="submit" name="submitBtn" value="Change" id="submitBtn" />
	</p>
</form>

<?
include(ROOT.'/inc/footer.php');
?>