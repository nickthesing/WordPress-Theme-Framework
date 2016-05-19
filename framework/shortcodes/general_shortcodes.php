<?php

/*---------------------------------------------------------------------------------------------
* Theme Shortcode - Highlight
* Version 1.0
* Description: Highlight shortcode
---------------------------------------------------------------------------------------------*/

function theme_highlight($atts, $content = null) {
	extract(shortcode_atts(array(
	    'color' => '',
		'textcolor' =>''),
	$atts));

	$bcolor = ( $color != '' ) ? 'background-color:'.$color.';' : '';
	$textcolor = ( $textcolor != '' ) ? 'color:'.$textcolor.';' : '';

	$style = 'style="'.$bcolor.$textcolor.'"';
	
	$output = '<span class="highlight" '.$style.'> ' . $content . '</span>';
	return $output;
}
add_shortcode('highlight','theme_highlight');

function theme_spacer($atts, $content = null) {
	extract(shortcode_atts(array(
		'height' => '',
	), $atts));

	$style = $height != '' ? 'style="height:'.$height.'px;"' : '';

	$output = '<div class="spacer" '.$style.'></div>';
	return $output;
}
add_shortcode('spacer','theme_spacer');

function theme_tooltip($atts, $content = null) {
	extract(shortcode_atts(array(
		'position' => 'top',
		'title' => ''
	), $atts));

	$output = '<a href="#" data-toggle="tooltip" data-placement="'.$position.'" title="'.$title.'">'.$content.'</a>';
	return $output;
}
add_shortcode('tooltip', 'theme_tooltip');

function theme_icon($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon' => '',
		'position' => '',
	), $atts));

	$output = '<div class="icon-wrap clearfix icon-float-'.$position.'"><span class="icon-shortcode '.$icon.'"></span>'.$content.'</div>';
	return $output;
}
add_shortcode('icon', 'theme_icon');

function theme_lightbox( $atts, $content = null) {
		extract(shortcode_atts (
			array(
			'image_url' => '',
			'retina_image_url' => '',
			'image_title' => '',
			'gallery' => '',
			), $atts ));

			$gallery = ( $gallery != '' ) ? 'data-lightbox-gallery="'. $gallery .'"' : '';
			$retina_image_url = ( $retina_image_url != '' ) ? 'data-lightbox-hidpi="'. $retina_image_url .'"' : '';

	$output = '<a '. $gallery .' '. $retina_image_url .' href="'. $image_url .' " title="'. $image_title. '" class="lightbox-shortcode"> '. do_shortcode($content) . '</a>';	
	
	return $output;
}
add_shortcode('lightbox', 'theme_lightbox');

?>