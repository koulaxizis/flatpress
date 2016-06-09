<?php
/*
Plugin Name: Go to Top
Plugin URI: http://eg.goez.tk
Description: Δημιουργία ενός κουμπιού "Πίσω στην κορυφή!".
Author: eggoez
Version: 1.3.4
Author URI: http://goez.tk
*/ 
 
add_action('wp_head', 'plugin_gotop_head', 0);
function plugin_gotop_head() {
	$pdir=plugin_geturl('gotop');
	echo <<<gotop
	<!-- start of gotop -->
	<script type="text/javascript" src="{$pdir}gt.js"></script>
	<script type="text/javascript" src="{$pdir}top.js"></script>
	<!-- end of gotop -->
gotop;
}

?>
