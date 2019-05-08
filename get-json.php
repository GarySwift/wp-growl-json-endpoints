<?php
function wp_growl_get_endpoint_json($post_id = null) {
	if (!$post_id) {
		global $post;
		$post_id = $post->post_id;
	}
	if( $file_name = get_field('file_name', $post_id) ) {
	    $upload_dir = wp_upload_dir();
	    $file_path = $upload_dir["basedir"].WP_GROWL_ENDPOINTS_DIR;	
	    $file = $file_path.$file_name;
	    if (file_exists($file)) {
	    	$file_contents = file_get_contents($file);
	    	# Check if json is valid
			if (json_decode($file_contents, true)) {
				return $file_contents;
			}
	    }
	}
}