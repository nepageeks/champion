<?php
// 
//  AdminHelper
//  version 0.3
//  
//  Copyright 2009-2010 Christopher David Yudichak. All rights reserved.

class AdminHelper
  {
    public static function admin_nav($id = null, $truncate = true)
    {
    	global $admin_links;
    	global $session;
    	$nav = '<ul';
    	if ($id != null) { $nav .= ' id="'.$id.'"'; }
    	$nav .= '>'."\n";
    	foreach ($admin_links as $name => $props) {
    		$auth = empty($props['auth']) ? 'admin' : $props['auth'];
    		if ($session->auth($props['auth'])) {
    			if ($truncate) { $name = substr($name, 0, 25); }
    			if (strpos($props['path'], 'http') !== false) {
    			  $nav .= '<li><a href="'.$props['path'].'" target="_blank">'.$name.'</a></li>'."\n";
    		  } else {
    			  $nav .= '<li><a href="/admin/'.$props['path'].'">'.$name.'</a></li>'."\n";
    		  }
    		}
    	}
    	$nav .= '<li><a href="/logout.php">Logout</a></li>'."\n";
    	$nav .= '</ul>'."\n";
    	return $nav;
    }
  }
?>