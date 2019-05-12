<?php
/**
 * Filter to add template for single endpoints
 * 
 * @author      Gary Swift <garyswiftmail@gmail.com>
 *
 * @since       1.0
 */
function wp_growl_plugin_templates( $template ) {
    $post_types = array('endpoint');
    if (is_singular($post_types)) {
        $template = plugin_dir_path( __FILE__ ) . 'single-endpoint.php';
    }
    return $template;
}