<?php
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
 * Do a loop to get each endpoint id
 */
function wp_growl_run_endpoint_manager_loop($endpoints_wpdb) {
  foreach ($endpoints_wpdb as $endpoint) {
    wp_growl_run_endpoint_manager($endpoint->ID);
  } 
}

/**
 * Do a database query using $wpdb
 *
 * This gets all endpoint IDs that are set to the cron frequency
 */
function wp_growl_get_endpoints_from_db($cron_frequency) {
  global $wpdb; 
  $prefix = $wpdb->prefix;
  $qry = "SELECT ID, post_title
  FROM wp_gaggler_posts 
  INNER JOIN wp_gaggler_postmeta
  ON ( ".$prefix."posts.ID = ".$prefix."postmeta.post_id )
  WHERE 1=1 
  AND ( ( ".$prefix."postmeta.meta_key = 'cron_frequency'
  AND ".$prefix."postmeta.meta_value = '$cron_frequency' ) )
  AND ".$prefix."posts.post_type = 'endpoint'
  AND ((".$prefix."posts.post_status = 'publish'))
  GROUP BY ".$prefix."posts.ID
  ORDER BY ".$prefix."posts.post_date DESC";
  return $wpdb->get_results( $qry );
}