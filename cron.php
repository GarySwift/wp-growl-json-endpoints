<?php
/**
 * Cron/WP Schedule Event
 *
 * Schedules a hook which will be executed by the WordPress actions core on a specific interval.
 *
 * @author  		Gary Swift <garyswiftmail@gmail.com>
 *
 * @since 			1.0
 * 
 * @link 			https://codex.wordpress.org/Function_Reference/wp_schedule_event
 */
register_activation_hook(__FILE__, 'wp_growl_schedule_activation');
function wp_growl_schedule_activation() {
    if (! wp_next_scheduled ( 'wp_growl_event' )) {
		wp_schedule_event(time(), 'daily', 'wp_growl_event');
    }
}

register_deactivation_hook(__FILE__, 'wp_growl_schedule_deactivation');
function wp_growl_schedule_deactivation() {
	wp_clear_scheduled_hook('wp_growl_do_this_daily');
}

add_action('wp_growl_event', 'wp_growl_do_this_daily');
function wp_growl_do_this_daily() {
	global $wpdb;
	$qry = "SELECT ID FROM `$wpdb->posts` where post_type='endpoint' AND post_status='publish'";
	$endpoints_wpdb =  $wpdb->get_results( $qry );
	foreach ($endpoints_wpdb as $product) {
		wp_growl_run_endpoint_manager($post_id);
	}
}