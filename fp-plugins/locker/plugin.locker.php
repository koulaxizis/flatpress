<?php
/*
Plugin Name: Locker
Plugin URI: http://www.flatpress.org/
Description: Απενεργοποίηση δυνατότητας σχολιασμού σε όλο το ιστολόγιο.
Author: NoWhereMan  (E.Vacchi)
Version: 1.0
Author URI: http://www.nowhereland.it
*/

function plugin_locker_entry() {
  global $smarty;
  $smarty->
assign('entry_commslock', true);
  }
 
  add_action('entry_block', 'plugin_locker_entry');
?>
