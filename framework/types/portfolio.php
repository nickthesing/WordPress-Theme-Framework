<?php
/*---------------------------------------------------------------------------------------------
* Theme Post Type: Portfolio
* Version 1.0
* Description: Post Type: Portfolio
---------------------------------------------------------------------------------------------*/

function theme_posttype_portfolio() {
	$labels = array(
		'name' => __('Portfolio', THEME_NAME),
		'singular_name' => __('Portfolio', THEME_NAME),
		'add_new' => __('Add Item', THEME_NAME),
		'add_new_item' => __('Add New Item' , THEME_NAME),
		'edit_item' => __('Edit Item' , THEME_NAME),
		'new_item' => __('New Item' , THEME_NAME),
		'view_item' => __('View Item Details' , THEME_NAME),
		'search_items' => __('Search Portfolio Items' , THEME_NAME),
		'not_found' => __('No portfolio items were found with that criteria' , THEME_NAME),
		'not_found_in_trash' => __('No portfolio items found in the Trash with that criteria' , THEME_NAME),
		'view' => __('View Item' , THEME_NAME)
	);
 
	$args = array(
		'labels' => $labels,
		'description' => __('This is the holding location for all portfolio items', THEME_NAME),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'rewrite' => true,
		'hierarchical' => true,
		'menu_position' => 5,
		'supports' => array(
			'title',
			'excerpt',
			'editor',
			'thumbnail',
		),
		'taxonomies' => array(
			'category', 
			'post_tag'
		)
	); 

	register_post_type( 'portfolio', $args );
}

add_action('init', 'theme_posttype_portfolio');  
?>