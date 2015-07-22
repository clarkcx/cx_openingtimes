<?php
/*
Plugin Name: CX: Opening Times
Plugin URI: http://www.ablewild.com
Description: This plugin allows you to set business opening hours for inclusion in your website. This plugin is only licenced for the use of customers of Clark CX Ltd.
Version: 1.0.1
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

/*************************************
* Add a custom capability on activation
*************************************/

register_activation_hook( __FILE__, 'cx_opening_times_add_cap' );
register_deactivation_hook( __FILE__, 'cx_opening_times_rmv_cap' );

function cx_opening_times_add_cap() {
    
    global $wp_roles;
    $wp_roles->add_cap( 'administrator', 'view_opening_times' );
    $wp_roles->add_cap( 'editor', 'view_opening_times' );
    $wp_roles->add_cap( 'author', 'view_opening_times' );
}

function cx_opening_times_rmv_cap() {
    
    global $wp_roles;
    $wp_roles->remove_cap( 'administrator', 'view_opening_times' );
    $wp_roles->remove_cap( 'editor', 'view_opening_times' );
    $wp_roles->remove_cap( 'author', 'view_opening_times' );
}

?>