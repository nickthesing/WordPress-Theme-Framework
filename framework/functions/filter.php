<?php
/*
 * Different filter functions. 
 */

/* 
*	Change the default password_form layout. 
*/
function theme_passwordForm() {
    global $post;
   
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $output = '<div class="protected-post"><h4>' . __('Password Protected Page Content', THEME_NAME) . '</h4><p>' . __('This post is password protected. To view it please enter your password below.', THEME_NAME) . '</p><form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post"><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" class="button" value="' . esc_attr__( "Login" ) . '" /></form></div>';
    
    return $output;
}

add_filter( 'the_password_form', 'theme_passwordForm' );


/*
*	Add First and Last class to widgets in the sidebar. 
*/
function theme_FirstLastClasses($params) {
	global $my_widget_num;
	$this_id = $params[0]['id'];
	
	$arr_registered_widgets = wp_get_sidebars_widgets();

	if(!$my_widget_num) {
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { 
		return $params;
	}

	if(isset($my_widget_num[$this_id])) {
		$my_widget_num[$this_id] ++;
	} else { 
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' ';

	if($my_widget_num[$this_id] == 1) {
		$class .= 'widget-first ';
	} elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { 
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);
	return $params;
}
add_filter('dynamic_sidebar_params', 'theme_FirstLastClasses');

?>