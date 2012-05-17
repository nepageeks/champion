<?php if (@$theme === false)  { include(ROOT.'/inc/header.php'); } else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Champion Builders Admin</title>
    <link rel="stylesheet" href="/css/admin.css" type="text/css" media="screen" charset="utf-8" />
    <?php
    if (isset($stylesheets))
      {
        foreach ($stylesheets as $s) {
          echo '<link rel="stylesheet" href="/css/'.$s.'.css" type="text/css" charset="utf-8" />'."\n";
        }
      }
    ?>
    <?php
    if (isset($javascripts))
      {
        foreach ($javascripts as $j) {
          echo '<script src="/js/'.$j.'.js" type="text/javascript" charset="utf-8"></script>'."\n";
        }
      }
    ?>
  </head>
  <body id="admin">
    <div id="admin_header">
      <div id="admin_header_content">
        <h1 id="admin_logo"><a href="/admin/"><p><?=PROJECT_NAME?></p></a></h1>
        <p>Welcome, Admin! <a href="/" target="_blank">View Site</a> | <a href="/logout.php">Log Out</a></p>
      </div>
    </div>
<?php }?>
<?php include(ROOT.'/inc/admin/inner_header.php'); ?>