<?php
require($_SERVER['DOCUMENT_ROOT'].'/inc/config.php');

include_once "inc.markdown.php";

parse_str(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY));
$block = new CmsBlock;
$block = $block->find($id);

$path = empty($block->location) ? '/content.php' : $block->location;
$block_name = empty($block->location) ? '$_GET[\'page\']' : "'".$block->name."'";
$parsed_text = Markdown($_POST['data']);

eval(BasicCms::parse_page($path, $block_name, $parsed_text));
?>