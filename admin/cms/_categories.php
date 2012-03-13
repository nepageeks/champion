<?
$parents = BasicCms::parent_categories();
if (!empty($parents)) {
	foreach ($parents as $category_id => $category_name)
	  {
	  	BasicCms::display_category_pages($category_id, $category_name);
	  }
}
?>