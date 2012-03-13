<?php
class BasicCms
  {
    public function block($name_id)
    {
      include_once ROOT.'/inc/markitup/parsers/inc.markdown.php';
      
      $type = is_numeric($name_id) ? 'first_by_id' : 'first_by_name';
      $block = new CmsBlock;
      $block = $block->$type($name_id);
      
      return Markdown(stripslashes($block->body));
    }
    
    public function setup_markitup($set = 'markdown', $skin = 'simple', $packed = true)
    {
      $markitup_file = $packed ? 'jquery.markitup.pack.js' : 'jquery.markitup.js';
      echo <<<EOF
<script type="text/javascript" src="/inc/markitup/sets/$set/set.js"></script>
<script type="text/javascript" src="/inc/markitup/$markitup_file"></script>
<link rel="stylesheet" type="text/css" href="/inc/markitup/skins/$skin/style.css" />
<link rel="stylesheet" type="text/css" href="/inc/markitup/sets/$set/style.css" />

EOF;
    }
    
    public function parse_page($page_path, $block_name, $new_text)
    {
      // Load page
      $page = file_get_contents(ROOT.$page_path);
      // Remove opening/closing php tags
      $page = preg_replace('/\<\?(php)?/', '', $page, 1);
      $page = preg_replace('/\?>$/', '', $page, 1);
      $page = preg_replace('/(.+)config.php\'(.+)\n/', '', $page, 1);
      // Replace includes
      $page = preg_replace_callback('/include(?:\s|\()(.+)\)?;/', array(@self, 'replace_include'), $page);
      // Replace block
      $page = str_replace('<?=BasicCms::block('.$block_name.');?>', $new_text, $page);
      
      return $page;
    }
    
    private function replace_include($path)
    {
      $path = $path[1];
      $path = str_replace(array('ROOT.', '\'', '(', ')'), array($_SERVER['DOCUMENT_ROOT']), $path);
      return '?>'.file_get_contents($path).'<?';
    }
    
    // all_categories -  returns array of all categories, in alphabetical order; empty array if there are none
    function all_categories()
    {
      $categories = new CmsCategory;
      return $categories->order_by('name')->find(array('1=1'), array('index' => 'id'));
    }
    // parent_categories -  returns array of topmost-level categories, in alphabetical order; empty array if there are none
    function parent_categories()
    {
      $categories = new CmsCategory;
      return $categories->order_by('name')->find(array("`parent` IS NULL"), array('index' => 'id'));
    }
    // child_categories -  returns array of child categories for a given category_id, in alphabetical order; empty array if there are none
    function child_categories($category_id)
    {
      $categories = new CmsCategory;
      return $categories->order_by('name')->find(array("`parent` = '$category_id'"), array('index' => 'id'));
    }
    // display_category_pages()
    function display_category_pages($category_id, $category_name)
    {
    	include('./_categoryPages.php');
    	if ($children = self::child_categories($category_id)) {
    		foreach ($children as $child_id => $child) {
    			self::display_category_pages($child_id, $child->name);
    		}
    	}
    }
  }
?>