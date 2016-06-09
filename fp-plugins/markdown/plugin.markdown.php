<?php
/*
Plugin Name: Markdown
Version: 1.1
Plugin URI: http://vast.fatal.ru/fp/markdown
Description: Επιτρέπει τη χρήση <a href="http://daringfireball.net/projects/markdown/">markdown</a> διαμόρφωσης σε καταχωρήσεις και σελίδες.
Author: Vasily Polovnyov<vast@whiteants.net>
Author URI: http://vazilla.pp.ru/
*/

# Openning and closing smart double-quotes.
//define( 'SMARTYPANTS_SMART_DOUBLEQUOTE_OPEN',  "&#171;" );
//define( 'SMARTYPANTS_SMART_DOUBLEQUOTE_CLOSE', "&#187;" );
define( 'XML_HTMLSAX3', plugin_getdir('markdown') . '/inc/');

require plugin_getdir('markdown') . '/inc/markdown.php';
require plugin_getdir('markdown') . '/inc/smartypants.php';
require plugin_getdir('markdown') . '/inc/safehtml.php';

function pl_markdown($text) {
	return SmartyPants(Markdown($text));
}

function pl_markdown_comment($text) {
	static $safehtml;
	if(!isset($safehtml)) {
	    $safehtml =& new SafeHTML();
	}
	return $safehtml->parse(SmartyPants(Markdown($text)));
}

//markdown will do it, so remove them
remove_filter('the_content',     'wpautop');
remove_filter('the_content_rss', 'wpautop');
remove_filter('the_excerpt',     'wpautop');
remove_filter('comment_text', 'wpautop');
remove_filter('comment_text', 'make_clickable');

//remove wptexturize -- this work is already done by smartypants
remove_filter('the_content',     'wptexturize');
remove_filter('the_content_rss', 'wptexturize');
remove_filter('the_excerpt',     'wptexturize');

add_filter('the_content',     'pl_markdown', 1);
add_filter('the_content_rss', 'pl_markdown', 1);

add_filter('comment_text', 'pl_markdown_comment');

?>
