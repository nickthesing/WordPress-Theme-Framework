<?php
/*---------------------------------------------------------------------------------------------
* Theme Portfolio: Filter
* Version 1.0
* Description: Extra filter for portfolio. 
---------------------------------------------------------------------------------------------*/

function portfolio_filter()  { 
    $labels = array(
        'name' => _x( 'Filters', 'taxonomy general name', THEME_NAME ),
        'singular_name' => _x( 'filter', 'taxonomy singular name', THEME_NAME ),
        'search_items' =>  __( 'Search filters', THEME_NAME ),
        'popular_items' => __( 'Popular filters', THEME_NAME ),
        'all_items' => __( 'All filters', THEME_NAME ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit filters', THEME_NAME ), 
        'update_item' => __( 'Update filter', THEME_NAME ),
        'add_new_item' => __( 'Add New filter', THEME_NAME ),
        'new_item_name' => __( 'New filter Name', THEME_NAME ),
        'separate_items_with_commas' => __( 'Separate filters with commas', THEME_NAME ),
        'add_or_remove_items' => __( 'Add or remove filter', THEME_NAME ),
        'choose_from_most_used' => __( 'Choose from the most used filters', THEME_NAME ),
        'menu_name' => __( 'Filter', THEME_NAME ),
    );

    register_taxonomy(  
        __( "filter", THEME_NAME ),  
        array(__( "portfolio", THEME_NAME )),  
        array(  
            "hierarchical" => true,  
            "labels" => $labels,  
            "singular_label" => __( "Filter", THEME_NAME ),  
            "rewrite" => array(  
                'slug' => 'filter',  
                'hierarchical' => true  
            )  
        )  
    );  
}
add_action( 'init', 'portfolio_filter', 0 ); 
?>