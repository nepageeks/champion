<?php
$categoryPages = mysql_query("SELECT * FROM `cms_blocks` WHERE `category_id` = '$category_id'");
if (mysql_num_rows($categoryPages) != 0) {
	include('./_categoryRow.php');
	while ($p = mysql_fetch_assoc($categoryPages)) {
		include('./_pageRow.php');
	}
}
?>