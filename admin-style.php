<?php
function wp_growl_admin_theme_style() {
  global $post_type;
  if( 'endpoint' == $post_type )  
  wp_enqueue_style('endpoint-style', plugins_url('assets/css/style.css', __FILE__));
}