<?php
/*
Plugin Name: Last Entries vTicker
Plugin URI: http://flatpress.georgi.co.uk/?x=entry:entry120811-115848 

Type: Block
Description: Κινούμενη λίστα των πρόσφατων καταχωρήσεων σου.
Author: Stanley
Version: 1.01
LastRevision: 
Author URI: http://flatpress.georgi.co.uk/ 
*/ 

function plugin_lastentriesvticker_widget() {
	
	global $fpdb;
	
	// load plugin strings
	// they're located under plugin.PLUGINNAME/lang/LANGID/
	$lang = lang_load('plugin:lastentriesvticker');
	
	$num = 10;
	####################
	
	/*
	$queryId = $fpdb->query("fullparse:false,start:0,count:$num");
	$fpdb->doquery($queryId);
	
	$fpdb->getQuery
	*/

    
	$q = new FPDB_Query(array('fullparse'=>false,'start'=>0,'count'=>$num), null);
	
	$string = '<div id="news-container"><ul>';
	
	
	$count = 0;
	
	while ($q->hasmore()) {
		
		list($id, $entry) = $q->getEntry();
		
		$link = get_permalink($id);
			
		$string .='<li>';
		$admin = BLOG_BASEURL . "admin.php?p=entry&amp;entry=";
		
    /* remove this line if you want the edit link added
    if (user_loggedin()) // if loggedin prints an "edit" link - 
			$string .= "<a href=\"{$admin}{$id}\">[".$lang['plugin']['lastentriesvticker']['edit']."]</a>";
    remove this line to add edit link */
		
    $string .= "<a href=\"{$link}\">{$entry['subject']}</a></li>\n";

		$count++;
	}
	
	if ($string == '<div id="news-container"><ul>'){
		$string .= '<li><a href="admin.php?p=entry&amp;action=write">'.$lang['plugin']['lastentriesvticker']['add_entry'].'</a></li>';
		$subject = $lang['plugin']['lastentriesvticker']['no_entries'];
	} else $subject = $lang['plugin']['lastentriesvticker']['latest'] . $lang['plugin']['lastentriesvticker']['subject_after_count'];	
	
	$string .= '</ul></div>';

	$widget = array();
	$widget['subject'] = $subject;
	$widget['content'] = $string;
	
  	/* include 'res/vticker.js'; */
  
	return $widget;
}

/**
 * Adds special stlye definitions into the HTML head.
 *
 */
function plugin_lastentriesvticker_style() {
	echo "	<!-- lastentriesvticker plugin style -->\n";
	echo '	<link rel="stylesheet" type="text/css" href="'. plugin_geturl('lastentriesvticker') ."res/lastentriesvticker.css\" />\n";
	echo "	<!-- end of lastentriesvticker plugin style -->\n";
}

/**
 * Adds special stlye definitions into the HTML head.
 *
 */
function plugin_lastentriesvticker_js() {
	echo "	<!-- lastentriesvticker plugin js -->\n";
	echo '	<script type="text/javascript" src="'. plugin_geturl('lastentriesvticker') ."res/jquery.vticker-min.js\"></script>\n";
	echo '	<script type="text/javascript" src="'. plugin_geturl('lastentriesvticker') ."res/vticker.js\"></script>\n";
	echo "	<!-- end of lastentriesvticker plugin js -->\n";
}

add_action('wp_head', 'plugin_lastentriesvticker_style');
add_action('wp_head', 'plugin_lastentriesvticker_js');

register_widget('lastentriesvticker', 'lastentriesvticker', 'plugin_lastentriesvticker_widget');

?>
