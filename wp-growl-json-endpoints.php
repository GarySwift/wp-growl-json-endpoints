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
require_once plugin_dir_path( __FILE__ ) . 'cron.php';
require_once plugin_dir_path( __FILE__ ) . 'get-json.php';
require_once plugin_dir_path( __FILE__ ) . 'class-wp-growl-json-endpoint-manager.php';

/**
 * save_post hook that adds default taxonomy and saves the processed ACF form data into FormBuilder data
 */
function wp_growl_save_post_endpoint($post_id) {
    // Return if this isn't a 'endpoint' post
    if ( "endpoint" !== get_post_type($post_id) ) return;
    // Process the endpoint
    wp_growl_run_endpoint_manager($post_id);
}
add_action( 'save_post', 'wp_growl_save_post_endpoint' );


/**
 * Filter to add template for single endpoints
 * 
 * @author      Gary Swift <garyswiftmail@gmail.com>
 *
 * @since       1.0
 */
add_filter('template_include', 'wp_growl_plugin_templates');
function wp_growl_plugin_templates( $template ) {
    $post_types = array('endpoint');

    if (is_singular($post_types)) {
        $template = plugin_dir_path( __FILE__ ) . 'single-endpoint.php';
    }

    return $template;
}
/**
 * Init WP_Growl_Json_Endpoint_Manager
 *
 * @author  		Gary Swift <garyswiftmail@gmail.com>
 *
 * @since 			1.0
 */
function wp_growl_run_endpoint_manager($post_id) {
    $endpoint_manager = new WP_Growl_Json_Endpoint_Manager($post_id);
    $endpoint_manager->get_json_from_url();
}
/**
 * Debugging
 *
 * @author  		Gary Swift <garyswiftmail@gmail.com>
 */
if ( ! function_exists('write_log')) {
    function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
    }
}