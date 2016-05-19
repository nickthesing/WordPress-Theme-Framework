<?php

/*
 * All common functions.
 */
 
/*
 * Function to check if page user is currently on is a special page. 
 */
function theme_isPage( $page_type, $page_id ) {
    switch( $page_type ) {
        case 'portfolio':
            if ( $post->ID === get_option( 'portfolio_page' ) ) {
                return require( 'page-portfolio.php' );
            }
        break;
        case 'blog':
            if ( $post->ID === get_option( 'blog_page' ) ) {
                return require( 'page-blog.php' );
            }
        break;
    }
}

/*
 * Check menu type
 */
function my_plugin_body_class($classes) {
    $menu = theme_getOption('header_menu_type');

    $extraClass = ( $menu == 'side' ) ? 'menu-push' : '';
    
    $classes[] = $extraClass;
    return $classes;
}

add_filter('body_class', 'my_plugin_body_class');

/*
 * This function will get the option set in the admin.
 */
function tf_getSetting( $name ) {
    $settings = get_option(SETTINGS);
    return ( isset($settings[FRAMEWORK.'_'.$name]) ) ? $settings[FRAMEWORK.'_'.$name] : false;
}

/*
 * This function will load the categories in the portfolio.
 */ 
function theme_getCategories() {
    foreach (get_the_category() as $cat) {
		if (!$cat->cat_name == '') {
			$output .= $cat->cat_name . ',';
		}
	}
	return $output;
}

/*
 * This function will get the meta option set in a post or page of custom post-type.
 */
function theme_getMeta( $post_id, $meta_name, $single ) {
    $meta_option = get_post_meta($post_id, THEME_SLUG . '_' . $meta_name, $single);
    return $meta_option;
}

/*
 * The next function will add Google Analytics to the footer. It grabs the admin option. 
 */
function theme_analytics() {
    $output = theme_getOption('google_analytics');
    if ( $output <> "" ) 
        echo stripslashes($output) . "\n";
}
add_action('wp_footer','theme_analytics');
