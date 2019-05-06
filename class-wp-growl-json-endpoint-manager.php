<?php
class WP_Growl_Json_Endpoint_Manager {
    /**
     * summary
     */
    private $post_id = null;

    public function __construct($post_id){
    	$this->post_id = $post_id;
    }

	public function get_json_from_url () {
		// URL which should be requested
		$url = get_field('url', $this->post_id);
		//  Initiate curl
		$ch = curl_init();
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result = curl_exec($ch);
		// Closing
		curl_close($ch);
		// Test if json if valid before saving to file
		if ( $endpoint_data = $this->validate_json($result) ) {	
			$this->save_json_to_file($endpoint_data, $post_id);
		}
	}

	private function validate_json($result) {
		if ( ($endpoint_data = json_decode($result, true)) !== null) {
			return $endpoint_data;
		}
		return false;
	}

	private function save_json_to_file($endpoint_data, $post_id) {
		/*
		 * Save $endpoint_data to a json file
		 */
	    if ( $json = json_encode($endpoint_data, JSON_PRETTY_PRINT) ) {
		    $upload_dir = wp_upload_dir();
		    $file_path = $upload_dir["basedir"].WP_GROWL_ENDPOINTS_DIR;
		    $file_name = get_post_field( 'post_name', $post_id ).'.json';;
		    $file = $file_path.$file_name;
		    if (!file_exists($file_path)) {
		        mkdir($file_path, 0777, true);
		    }
		    if (file_put_contents($file, $json) && function_exists('update_field')) {
		    	update_field('file_name', $file_name, $post_id);    		
		   	}	    	
	    }
	}  
}