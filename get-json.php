<?php
function wp_growl_get_endpoint_id($post_id) {
	if (!$post_id) {
		global $post;
		return $post->post_id;
	}
	return $post_id;	
}
function wp_growl_get_endpoint_file_contents($post_id) {
	if( $file_name = get_field('file_name', $post_id) ) {
	    $upload_dir = wp_upload_dir();
	    $file_path = $upload_dir["basedir"].WP_GROWL_ENDPOINTS_DIR;	
	    $file = $file_path.$file_name;
	    if (file_exists($file)) {
			return file_get_contents($file);
	    }
	}	
}
function wp_growl_get_endpoint_json($post_id = null) {
	$post_id = wp_growl_get_endpoint_id($post_id);
	$file_contents = wp_growl_get_endpoint_file_contents($post_id);
	if (json_decode($file_contents, true)) {
		return $file_contents;				
	}
}
function wp_growl_get_endpoint_array($post_id = null) {
	$post_id = wp_growl_get_endpoint_id($post_id);
	$file_contents = wp_growl_get_endpoint_file_contents($post_id);
	if ($file_contents_array = json_decode($file_contents, true)) {
		return $file_contents_array;				
	}
}