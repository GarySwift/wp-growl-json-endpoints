<?php
function wp_growl_register_cpt_endpoint() {

	/**
	 * Post Type: Endpoints.
	 */

	$labels = array(
		"name" => __( "Endpoints", "wp_growl" ),
		"singular_name" => __( "Endpoint", "wp_growl" ),
	);

	$show = true;

	$args = array(
		"label" => __( "Endpoints", "wp_growl" ),
		"labels" => $labels,
		"description" => "",
		"public" => $show,
		"publicly_queryable" => $show,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "endpoint", "with_front" => false ),
		"query_var" => false,
		"menu_position" => 100,
		"menu_icon" => "dashicons-admin-links",
		"supports" => array( "title" ),
	);

	register_post_type( "endpoint", $args );
}

add_action( 'init', 'wp_growl_register_cpt_endpoint' );