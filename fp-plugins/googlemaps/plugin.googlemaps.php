<?php
/*
Plugin Name: Google Maps Widget
Plugin URI: http://marcthibeault.com/google-maps-plugin
Description: Δημιουργία μικροεφαρμογής με χάρτη απ' την υπηρεσία Google Maps. Διάβασε τις <a href="https://support.google.com/maps/answer/3544418?hl=el">οδηγίες χρήσης</a>! Προτεινόμενο μέγεθος: <b>200x150</b>.
Author: Marc Thibeault
Version: 1.0
Author URI: http://marcthibeault.com
*/ 
 
function plugin_googleMaps_widget() {
	
	//To set the widget to show the location you want, go to one the following pages and follow the instructions in order to get the embed code. 
	//If you use the new Google Maps: https://support.google.com/maps/answer/3544418
	//If you use the old Google Maps: https://support.google.com/maps/answer/72644?hl=en
	//Select the custom size with a maximum width of 200px, otherwise it likely won't fit in your sidebar. 
	//Copy your embed code below between the apostrophes. 

	$string = 'Επικόλλησε εδώ τον κώδικα ενσωμάτωσης. <a href="https://support.google.com/maps/answer/3544418?hl=el">Μάθε πως</a>!';
	
	//The widget's block title is Google Maps. Change it to what fits your needs. 
	$entry['subject'] = "Χάρτης";
	$entry['content'] = $string;
	return $entry;
}
register_widget('googlemaps', 'Google Maps', 'plugin_googlemaps_widget');
?>
