<?php
/**
 * Save post hook
 *
 * save_post hook that ..
 *
 * @author  		Gary Swift <garyswiftmail@gmail.com>
 *
 * @since 			1.0
 *
 * @param int    	$post_id
 */
function wp_growl_save_post_endpoint($post_id) {
    // Return if this isn't a 'endpoint' post
    if ( "endpoint" !== get_post_type($post_id) ) return;
    // Process the endpoint
    wp_growl_run_endpoint_manager($post_id);
}