<?php
/**
 * Custom Columns
 * 
 * Manage the columns of the `endpoint` post type
 *
 * @author  		Gary Swift <garyswiftmail@gmail.com>
 *
 * @since 			1.0
 */
function manage_columns_for_endpoint($columns) {
	unset($columns['date']);
	$columns['url'] = 'Source URL';
	$columns['updated'] = 'Updated';
    $columns['date'] = _x('Date', 'column name');
    return $columns;
}
function populate_endpoint_columns($column, $post_id) {
    if($column == 'url'){
		$post = get_post($post_id); 
		$slug = $post->post_name;    	
	    if ($url = get_field('url')) {
	     	echo $url;
	    }
	    else {
	    	echo "-";
	    }   
    }
    elseif($column == 'updated'){
		if ($file_name = get_field('file_name')) {
			$upload_dir = wp_upload_dir();
			$file_path = $upload_dir["basedir"].WP_GROWL_ENDPOINTS_DIR;	     	
			$file = $file_path.$file_name;
		    if ( file_exists($file) ) {
		        echo date("Y-m-d H:i:s", filemtime( $file ) );
		    }
		    else {
		    	echo "-";
		    } 		    	     	
	    }	    
    }    
}
add_action('manage_endpoint_posts_columns','manage_columns_for_endpoint');
add_action('manage_endpoint_posts_custom_column','populate_endpoint_columns',10,2);