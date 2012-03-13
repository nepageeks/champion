<?
/* Make sure this require() points to config.php. */
require('../inc/config.php');

$title = 'Authorization Required [Error 401]';

include(ROOT.'/inc/header.php');
?>

401 - Authorization Required

<?
include(ROOT.'/inc/footer.php');
?>