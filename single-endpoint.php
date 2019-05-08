<?php
/**
 * The template for single endpoints
 *
 * @author  		Gary Swift <garyswiftmail@gmail.com>
 *
 * @since 			1.0
 */
if( $file_contents = wp_growl_get_endpoint_json() ) {
	header('Content-Type: application/json');
	echo $file_contents;
}
exit;