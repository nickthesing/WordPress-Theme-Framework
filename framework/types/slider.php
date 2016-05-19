<?php
/*---------------------------------------------------------------------------------------------
* Theme Post Type: Slider
* Version 1.0
* Description: Post Type: Slider
---------------------------------------------------------------------------------------------*/

function theme_posttype_slider() {
	$labels = array(
		'name' => __('Slider Items', THEME_NAME),
		'singular_name' => __('Item', THEME_NAME),
		'add_new' => __('Add Item', THEME_NAME),
		'add_new_item' => __('Add New Item' , THEME_NAME),
		'edit_item' => __('Edit Item' , THEME_NAME),
		'new_item' => __('New Item' , THEME_NAME),
		'view_item' => __('View Item Details' , THEME_NAME),
		'search_items' => __('Search Slider Items' , THEME_NAME),
		'not_found' => __('No slider items were found with that criteria' , THEME_NAME),
		'not_found_in_trash' => __('No slider items found in the Trash with that criteria' , THEME_NAME),
		'view' => __('View Item' , THEME_NAME)
	);
 
	$args = array(
		'labels' => $labels,
		'description' => 'This is the holding location for all slider items',
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'rewrite' => true,
		'hierarchical' => true,
		'menu_position' => 5,
		'supports' => array(
			'title',
			'thumbnail',
			'editor'
		),
		'taxonomies' => array(
			'category', 
			'post_tag'
		)
	); 

	register_post_type( 'slider', $args );
}

add_action('init', 'theme_posttype_slider'); 
?>