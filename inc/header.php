<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title><?=PROJECT_NAME.(isset($title) ? ' - '.$title : '')?></title>
    <?=AssetManager::display_stylesheets();?>
    <?=AssetManager::display_javascripts();?>
  </head>
  <body>
    <div id="container">