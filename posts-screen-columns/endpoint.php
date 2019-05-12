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
	$columns['endpoint_post_id'] = 'ID';
	$columns['cron_frequency'] = 'Frequency';
	$columns['endpoint_updated'] = 'Updated';
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
    elseif($column == 'endpoint_post_id'){
	    echo '<input value="'.$post_id.'" onclick="this.focus();this.select();document.execCommand(\'copy\')" onfocus="this.focus();this.select();document.execCommand(\'copy\')" style="width: 80px; text-align: center">';
    }    
    elseif($column == 'cron_frequency'){
		$post = get_post($post_id); 
		$slug = $post->post_name;    	
	    if ($cron_frequency = get_field('cron_frequency')) {
	     	switch ($cron_frequency) {
	     		case 'daily':
	     			echo 'Once Daily';
	     			break;
	     		case 'twicedaily':
	     			echo 'Twice	 Daily';
	     			break;	
	     		case 'hourly':
	     			echo 'Hourly';
	     			break;		     			     		
	     		default:
	     			echo $cron_frequency;
	     			break;
	     	}
	    }
	    else {
	    	echo "-";
	    }   
    }    
    elseif($column == 'endpoint_updated'){
		if ($file_name = get_field('file_name')) {
			$upload_dir = wp_upload_dir();
			$file_path = $upload_dir["basedir"].WP_GROWL_ENDPOINTS_DIR;	     	
			$file = $file_path.$file_name;
		    if ( file_exists($file) ) {
		    	$filemtime = date("Y-m-d", filemtime( $file ) );
		    	$now = date("Y-m-d");
		    	if ($filemtime == $now) {
		    		echo "<b>Today:</b><br>".date("H:i", filemtime( $file ) );
		    	}
		    	else {
		    		echo date("Y/m/d", filemtime( $file ) );
		    	}
		    }
		    else {
		    	echo '<span title="File cannot be found!">&dash;</span>';
		    } 		    	     	
	    }	    
    }        
}
// add_action('manage_endpoint_posts_columns','manage_columns_for_endpoint');
// add_action('manage_endpoint_posts_custom_column','populate_endpoint_columns',10,2);