<?php
/*  
Theme Name: Leggero Plus
Theme URI: http://www.flatpress.org/
Description: Παραλλαγή του προεπιλεγμένου θέματος "Leggero".
Version: 0.1
Author: NoWhereMan, Drudo, RamblingRoss & Christos Koulaxizis
Author URI: http://www.flatpress.org/
*/


	$theme['name'] = 'leggero';
	$theme['author'] = 'drudo and NoWhereMan';
	$theme['www'] = 'http://www.flatpress.org/';
	$theme['description'] = 'Το προπιλεγμένο θέμα για το FlatPress με μια ανάσα φρέσκιας μέντας και'.
							'μπλα μπλα';
	
	
	$theme['version'] = 0.705;
		
	$theme['style_def'] = 'style.css';
	$theme['style_admin'] = 'admin.css';
	
	$theme['default_style'] = 'leggero';
	
	
	
	// Other theme settings
	
		// overrides default tabmenu
		// and panel layout
	remove_filter('admin_head', 'admin_head_action');
	
		// register widgetsets
	register_widgetset('right');
	register_widgetset('left'); 
	
?>
