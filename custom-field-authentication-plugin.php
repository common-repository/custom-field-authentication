<?php
/*
Plugin Name: Custom Field Authentication
Plugin URI: http://w3prodigy.com/wordpress-plugins/custom-field-authentication/
Description: Require authentication on pages and posts using a Custom Field. Add a custom field with the name 'login_required' and a value of 'true' to restrict access for regular users for a page or post.
Version: 1.0
Author: Jay Fortner
Author URI: http://w3prodigy.com
License: GNU General Public License v2
*/

if(!function_exists('custom_field_authentication')) {
	function custom_field_authentication()
	{
		global $post;
		
		/** Posts and Pages with a custom field of 'login_required' will check authentication */
		$key_name = 'login_required';
		$value = get_post_meta($post->ID, $key_name, true);
		
		if($value == "true" && !is_admin()) {
			switch(is_user_logged_in()) {
				case true: break;
				case false: wp_redirect(get_bloginfo('url')); break;
			} // switch
		} // if
		
	} // function
	
	add_action('wp', 'custom_field_authentication');
} // if

?>