<?php

function theme_admin_style() {
	wp_enqueue_style( 'wp-color-picker' );
    wp_register_style( 'custom_wp_admin_css', THEME_ADMIN_ASSETS . '/css/admin.css', false, '1.0' );	
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'theme_admin_style' );

function theme_admin_scripts() {
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-form');
	wp_enqueue_script('wp-color-picker');
	
	wp_enqueue_script('jquery-fontselector',  THEME_ADMIN_ASSETS  . '/js/jquery.fontselector.js', false, null);
	wp_enqueue_script('custom-checkboxes',  THEME_ADMIN_ASSETS  . '/js/iphone-style-checkboxes.js', false, null);
	wp_enqueue_script('custom-admin',  THEME_ADMIN_ASSETS  . '/js/custom-admin.js', false, null);

	if(function_exists( wp_enqueue_media() )) {
   		wp_enqueue_media();
	} else {
    	wp_enqueue_style('thickbox');
    	wp_enqueue_script('media-upload');
    	wp_enqueue_script('thickbox');
	}
}


if (is_admin()) {
	add_action('admin_enqueue_scripts', 'theme_admin_scripts');
}
?>