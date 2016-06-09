This plugin parses a feed and displays it in a widget. I's based on the simple pie class: http://simplepie.org


There is some configuartion to be done, so open the plugin.simplepie.php file and edit as below:

1. Edit this line: 	
   $url = 'http://www.flatpress.org/home/rss.php';
   so that it links the feed you want to be parsed

2. chnage this line 
   $length = 5;	
   so that it displays the number of items you want (set to 0 it displays all items)

3. save the file


To install just upload it to your fp-plugins directory then enable it through the plugin panel.

