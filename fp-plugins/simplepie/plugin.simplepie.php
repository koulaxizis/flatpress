<?php
/*
Plugin Name: SimplePie
Plugin URI: http://www.sneakatron.co.uk/
Description: Εμφανίζει μια ροή νέων (rss feed) σε μικροεφαρμογή.
Author: sneakatron
Version: 1.0
Author URI: http://www.sneakatron.co.uk/
*/ 

function plugin_simplepie() {


require_once('simplepie.inc');//include the simplepie class

$subject = "Πρόσφατα νέα";//the name of the widget . Change this to what you want e.g. what's oing on..
$url = 'http://www.flatpress.org/home/rss.php';//the feed displayed

$feed = new SimplePie();
$feed->set_feed_url($url = 'https://github.com/koulaxizis/flatpress/releases.atom');//This is the feed being processed
/*to display multiple feeds  uncomment this; change the feeds and comment out the above line:
$feed->set_feed_url(array(
	'http://rss.news.yahoo.com/rss/topstories',
	'http://news.google.com/?output=atom',
	'http://rss.cnn.com/rss/cnn_topstories.rss'
));
*/

$feed->enable_cache(false);//disabled cahce due to 'technical dificulties'
$length = 5; //number of items displayed
$feed->init();//initialise the feed


ob_start(); //starts output buffering

echo '<ul>';
foreach ($feed->get_items() as $item):

//variables. Some of these are not used
$perm = $item->get_permalink();//permalink to news
$title = $item->get_title();//title of news
$date = $item->get_date('j M Y');//the date posted
$content = $item->get_content();//the content of the news


//This is the ouput list

echo "<li><a href=\"$perm\">$title</a></li>";


endforeach;
echo '</ul>';
$string = ob_get_clean(); // get content from the output buffer



//this outputs the content to the widget
return array(
'subject' => $subject,
'content' => $string // your buffered string
);
}

register_widget('simplepie', 'simplepie', 'plugin_simplepie');
?>
