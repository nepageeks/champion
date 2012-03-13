    <div id="admin_body">
      <div id="admin_nav">
      	<div id="nav_head"><h2></h2></div>
      	<div id="nav_body"><?=AdminHelper::admin_nav();?></div>
      </div><!--end admin nav-->
      <div id="admin_box">
          <div id="box_head">
          	<h1><?=isset($admin_title)?$admin_title:'Admin';?></h1>
            <?=isset($admin_subtitle)?'<h2>'.$admin_subtitle.'</h2>':'';?>
          </div>
          <div id="box_body">