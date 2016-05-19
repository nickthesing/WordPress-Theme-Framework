<?php
/**
* Framework: ThemeFlip
* Framework URI: http://themeflip.net
* Description: Framework for Themeflip themes.
* Version: 1.0.0
* Author: ThemeFlip
* Author URI: http://themeflip.net
* License: GPL2
*/

$file = TEMPLATEPATH . '/framework/themeflip.php';

if ( file_exists($file) ) {
	require_once($file);
}

if ( class_exists('Themeflip_Core') ) {
	$Themeflip = new Themeflip_Core();
	$Themeflip->init([
		'name' => 'Vidyo',
		'slug' => 'vd',
		'website' => 'vidyo.themeflip.net'
	]);
}
?>