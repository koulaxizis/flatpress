<?php

$fp_config = array (
  'general' => 
  array (
    'www' => 'http://localhost',
    'title' => 'FlatPress',
    'subtitle' => 'Το FlatPress μου',
    'footer' => 'Μετάφραση από τον <a href="http://koulaxizis.net" target="_blank">Χρήστο Κουλαξίζη</a>, επανέλεγχος από την <a href="http://en.gravatar.com/kanellia" target="_blank">Κανελλία Τούντα</a>',
    'author' => 'Ελληνικό FlatPress',
    'email' => 'webmaster@localhost.com',
    'startpage' => NULL,
    'maxentries' => '5',
    'notify' => true,
    'theme' => 'leggero',
    'style' => 'leggero',
    'blogid' => 'fpdefid',
    'charset' => 'utf-8',
  ),
  'locale' => 
  array (
    'timeoffset' => '3',
    'timeformat' => '%H:%M:%S',
    'dateformat' => '%A, %e %B, %Y',
    'dateformatshort' => '%d-%m-%Y',
    'charset' => 'utf-8',
    'lang' => 'el-gr',
  ),
  'plugins' =>
  array (
	'blockparser' =>
	array (
		'pages' =>
			array(
				'menu',
				'about',
			),
	),
  ),
);

?>
