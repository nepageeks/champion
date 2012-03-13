<?
/* Make sure this require() points to config.php. */
require('./inc/config.php');

$session->auth_or_redirect(null, '/login.php', true);

include(ROOT.'/inc/header.php');
?>

<form action="/users/functions.php?f=signup" method="POST">
	<p>
		<label>First Name</label><br />
		<input type="text" name="first_name" value="" id="first_name">
	</p>
	<p>
		<label>Last Name</label><br />
		<input type="text" name="last_name" value="" id="last_name">
	</p>
	<p>
		<label>Email</label><br />
		<input type="text" name="email" value="" id="email" />
	</p>
	<p>
		<label>Username</label><br />
		<input type="text" name="username" value="" id="username" />
	</p>
	<p>
		<label>Password</label><br />
		<input type="password" name="password" value="" id="password" />
	</p>
	<p>
		<label>Confirm</label><br />
		<input type="password" name="confirm" value="" id="confirm" />
	</p>
	<p>
		<input type="submit" name="submitBtn" value="Signup" id="submitBtn" />
	</p>
</form>

<?
include(ROOT.'/inc/footer.php');
?>