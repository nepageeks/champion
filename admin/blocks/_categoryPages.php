<?php
$blocks = new CmsBlock;
$blocks = $blocks->find_by_category_id($category_id);
if (!empty($blocks)) {
	include('./_categoryRow.php');
  foreach ($blocks as $block) {
		include('./_pageRow.php');
	}
}
?>