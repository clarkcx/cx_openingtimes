<?php
/*
Plugin Name: CX: Opening Times
Plugin URI: http://www.ablewild.com
Description: This plugin allows you to set business opening hours for inclusion in your website. This plugin is only licenced for the use of customers of Clark CX Ltd.
Version: 1.0
Author: Pete Clark
Author URI: http://www.ablewild.com/
*/

/*************************************
* global variables
*************************************/

$cx_openingtimes_plugin_name = 'Opening times';

// Retrieve our plugins settings from the options table
$cx_openingtimes_options = get_option('cx_openingtimes_settings');


/*************************************
* includes
*************************************/

include('inc/adminpage.php'); // This is the plugin options page
include('inc/shortcodes.php'); // This is the plugin options page

/*************************************
* settings link
*************************************/

function cx_openingtimes_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=cx-openingtimes-admin">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'cx_openingtimes_settings_link' );

?>