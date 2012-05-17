<?
require('../../inc/admin/config.php');
$session->auth_or_redirect('admin', '/admin');

$admin_title = 'Change Password';

include(ROOT.'/inc/admin/header.php');
?>

	<p><a href="/admin">Back to Admin Home</a></p>
	
	<?php if (isset($_GET['s'])) { ?>
	  <?php
	  switch ($_GET['s']) {
	    case 'old': 
	      $msg = 'Incorrect old password';
	      break;
	    case 'match':
	      $msg = 'Password confirmation must match';
	      break;
	    case 'success':
	      $msg = 'Password successfully changed';
	      break;
	    case 'empty':
	      $msg = 'Password cannot be empty';
	      break;
	    default:
	      $msg = 'There was an error; please try again';
	      break;
	  }
	  ?>
  	<p class="password_msg"><?=$msg?></p>
	<?php } ?>

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
include(ROOT.'/inc/admin/footer.php');
?>