<?php
/*
Plugin Name: Clock
Version: 0.1
Plugin URI: http://bobu.altervista.org
Type: Block
Description: Ψηφιακό ρολόι, ημερομηνία και διεύθυνση IP του επισκέπτη, σε μικροεφαρμογή.
Author: Bobu
Author URI: http://bobu.altervista.org
*/


function plugin_clock_widget() {

	
	// load plugin strings
	// they're located under plugin.PLUGINNAME/lang/LANGID/
	$lang = lang_load('plugin:clock');
	
	$widget = array();
	$widget['subject'] = $lang['plugin']['clock']['subject'];
	//$widget['content'] = '<ul id="widget_clock"><p>'. date('H:i:s', time()).'</p></ul>';
	include 'time.php';
			$h=plugin_geturl('clock').'res/stclock.css';
			echo '<link rel="stylesheet" type="text/css" href="'.$h."\" />\n";	

	return $widget;
}
	
register_widget('clock', 'Clock', 'plugin_clock_widget');
