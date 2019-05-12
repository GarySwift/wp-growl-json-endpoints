<?php
/*
Plugin Name: WP Growl: JSON Endpoints
Plugin URI: 
Description: Allows users attach URL a custom post type which is used to retrieve data and and save it as a JSON file.
Version: 1
Author: Gary Swift
Author URI: https://github.com/wp-swift-wordpress-plugins
License: GPL2
*/

/**
 * Constant vars
 */
define('WP_GROWL_ENDPOINTS_DIR', '/endpoints/');

/**
 * Include files
 */
require_once plugin_dir_path( __FILE__ ) . 'cpt/endpoint.php';
require_once plugin_dir_path( __FILE__ ) . 'acf/endpoint-fields.php';
require_once plugin_dir_path( __FILE__ ) . 'posts-screen-columns/endpoint.php';
require_once plugin_dir_path( __FILE__ ) . 'class-wp-growl-json-endpoint-manager.php';
require_once plugin_dir_path( __FILE__ ) . 'get-json.php';
require_once plugin_dir_path( __FILE__ ) . 'cron-helper-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'save-post.php';
require_once plugin_dir_path( __FILE__ ) . 'single-endpoint-filter.php';
require_once plugin_dir_path( __FILE__ ) . 'admin-style.php';

/**
 * Filter, actions, hooks
 */
add_action( 'init', 'wp_growl_register_cpt_endpoint' );
add_filter('template_include', 'wp_growl_plugin_templates');
add_action( 'save_post', 'wp_growl_save_post_endpoint' );
add_action('manage_endpoint_posts_columns','manage_columns_for_endpoint');
add_action('manage_endpoint_posts_custom_column','populate_endpoint_columns',10,2);
add_action('admin_enqueue_scripts', 'wp_growl_admin_theme_style');

/**
 * Cron/WP Schedule Event
 *
 * Schedules a hook which will be executed by the WordPress actions core on a specific interval.
 *
 * @author      Gary Swift <garyswiftmail@gmail.com>
 *
 * @since       1.0
 * 
 * @link      https://codex.wordpress.org/Function_Reference/wp_schedule_event
 */

/**
 * Handle activation
 */
register_activation_hook(__FILE__, 'wp_growl_endpoint_schedule_activation');
function wp_growl_endpoint_schedule_activation() {
    if (! wp_next_scheduled ( 'wp_growl_endpoint_daily_event' )) {
      wp_schedule_event(time(), 'daily', 'wp_growl_endpoint_daily_event');
    }
    if (! wp_next_scheduled ( 'wp_growl_endpoint_twicedaily_event' )) {
      wp_schedule_event(time(), 'twicedaily', 'wp_growl_endpoint_twicedaily_event');
    } 
    if (! wp_next_scheduled ( 'wp_growl_endpoint_hourly_event' )) {
      wp_schedule_event(time(), 'hourly', 'wp_growl_endpoint_hourly_event');
    }        
}

/**
 * Handle deactivation
 */
register_deactivation_hook(__FILE__, 'wp_growl_endpoint_schedule_deactivation');
function wp_growl_endpoint_schedule_deactivation() {
  wp_clear_scheduled_hook('wp_growl_endpoint_daily_event');
  wp_clear_scheduled_hook('wp_growl_endpoint_twicedaily_event');
  wp_clear_scheduled_hook('wp_growl_endpoint_hourly_event');
}

/**
 * The cron callback functions
 */
add_action('wp_growl_endpoint_daily_event', 'wp_growl_do_this_daily');
add_action('wp_growl_endpoint_twicedaily_event', 'wp_growl_do_this_twicedaily');
add_action('wp_growl_endpoint_hourly_event', 'wp_growl_do_this_hourly');
function wp_growl_do_this_daily() {
  wp_growl_run_endpoint_manager_loop( wp_growl_get_endpoints_from_db( 'daily' ) );
}
function wp_growl_do_this_twicedaily() {
  wp_growl_run_endpoint_manager_loop( wp_growl_get_endpoints_from_db( 'twicedaily' ) );
}
function wp_growl_do_this_hourly() {
  wp_growl_run_endpoint_manager_loop( wp_growl_get_endpoints_from_db( 'hourly' ) );
}