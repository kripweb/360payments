<?php
function adding_scripts() {
	wp_register_script('custom_zendesk', get_stylesheet_directory_uri() . '/js/zendesk.js', array('jquery'), '1.1', true);
	wp_enqueue_script('custom_zendesk');
	wp_enqueue_script( 'hilghtpack', 'https://secure.networkmerchants.com/contrib/js/highlight.pack.js', false );
}
 
add_action( 'wp_enqueue_scripts', 'adding_scripts' );