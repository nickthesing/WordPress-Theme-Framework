<?php 
/**
** 	Themeflip class
** 	This class will load all necessary functions.
**	Framework created by SomniaThemes
**/

if( !class_exists('Themeflip_Core') ) {

class Themeflip_Core {
	/*
	* Initializes the theme framework, loads the required files, and calls the
	* functions needed to run the theme.
	*/
	function init($options) {

		/* Check for the PHP version first */
		$this->checkPHPversion();

		$this->constants($options);

		$configFile = TEMPLATEPATH . '/themeflip_config.php';

		// Settings:
		define('SETTINGS', 'settings');
		define('FRAMEWORK', 'tf');

		if ( file_exists( $configFile ) ) {
			require_once($configFile);
			$this->themeflipConfig = $config;
		}
		
		/* Add theme support */ 
		add_action('after_setup_theme', array(&$this, 'supports'));

		// Enqueue
		if ( ! is_admin() ) {
			add_action('wp_enqueue_scripts', array(&$this, '_enqueueJS'));
			add_action('wp_enqueue_scripts', array(&$this, '_enqueueCSS'));
			add_action('wp_enqueue_scripts', array(&$this, '_enqueueFonts'));
		}

		/* Load all functions */
		$this->functions();
		
		/* Load all types */
		$this->types();
		
		/* Load all widgets */
		$this->widgets();   

		/* Load Shortcodes */
		$this->shortcodes();
		
		/* Load the admin files */
		$this->admin();
	}
	
	private function constants($options) {
		//define several constants used in this framework.
		define('THEME_NAME', $options['name']);
		define('THEME_SLUG', $options['slug']);
		define('THEME_WEBSITE', $options['website']);
		
		define('THEME_DIR', get_template_directory());
		define('THEME_URI', get_template_directory_uri());
		define('THEME_FW', THEME_DIR . '/framework');
		define('THEME_HELPERS', THEME_FW . '/helpers');
		define('THEME_TYPES', THEME_FW . '/types');
		define('THEME_FUNCTIONS', THEME_FW . '/functions');
		define('THEME_SHORTCODES', THEME_FW . '/shortcodes');
		define('THEME_WIDGETS', THEME_FW . '/widgets');
		define('THEME_PLUGINS', THEME_FW . '/plugins');
		
		define('THEME_IMAGES', THEME_URI . '/images');
		define('THEME_CSS', THEME_URI . '/css');
		define('THEME_FONTS', THEME_URI . '/fonts');
		define('THEME_JS', THEME_URI . '/js');
		
		define('THEME_ADMIN', THEME_FW . '/admin');
		define('THEME_ADMIN_ASSETS', THEME_URI . '/framework/admin');
		define('THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions');
	}
        
	/*
	 * Load some support functions.
	 */
	function supports() {
		if ( function_exists( 'add_theme_support' ) ) {
			
			// Register header and sub-footer menu.
			if ( function_exists( 'register_nav_menus' ) ) {
				$menus = $this->themeflipConfig['menus'];

				foreach ($menus as $id => $name) {
					register_nav_menus(array($id => $name));
					wp_create_nav_menu(THEME_NAME.' '.$name, array(THEME_SLUG.'_'.$id));
				}
			}
			
			/* USE WordPress build in custom background */
			add_theme_support( 'custom-background' );

			/* Add textdomain to theme, used for translation*/
			load_theme_textdomain(THEME_NAME);

			/* Enable Editor Styling */
			add_editor_style();
			
			// Enable post-thumbnails
			add_theme_support( 'post-thumbnails', array( 'post', 'page', THEME_SLUG.'_video') );

			// Enable post formats
			add_theme_support( 'post-formats', array( 'gallery', 'image' ) );

			// Enable html5 support
			add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

			// Enable infinite scroll
			add_theme_support( 'infinite-scroll', array('container' => 'blogContent', 'type' => 'click' ) );

			if ( function_exists( 'add_image_size' ) ) {
				add_image_size( 'video-overview-image', '1280', '900', true);
				add_image_size( 'full-content-width', '750', '500', true);
				add_image_size( 'fullscreen-background', '1920', '1200', true);
			}

			//set thumbnail size for comments etc.
			set_post_thumbnail_size( 80, 80, true );

			if (function_exists('automatic_feed_links')) {
				add_theme_support( 'automatic-feed-links' );
			}

			if ( ! isset( $content_width ) ) {
				$content_width = 960;
			}
		}
    }

	/*
	* Register types. 
	*/
	private function types() {
		$types = $this->themeflipConfig['post_types'];

		foreach ($types as $key => $type) {
			register_post_type(THEME_SLUG.'_'.$key,$type);
		}
	}	
	
	/* 
	* Load the core functions.
	*/		   
	private function functions() {
		require_once(THEME_FUNCTIONS . '/common.php');		
		require_once(THEME_FUNCTIONS . '/filter.php');
		
		require_once(THEME_HELPERS . '/themeGenerator.php');
		require_once(THEME_HELPERS . '/sidebarGenerator.php');
	}

	function _enqueueJS() {
		$includes = $this->themeflipConfig['includes']['js'];
		foreach ($includes as $name => $link) {
			wp_enqueue_script($name, THEME_JS . $link, array('jquery'), null, true);
		}

		$localize = $this->themeflipConfig['includes']['localize'];

		foreach ($localize as $file => $key) {
			foreach($key as $c => $d) {
				wp_localize_script($file, $c, $d);
			}
		}
	}

	function _enqueueCSS() {
		$includes = $this->themeflipConfig['includes']['css'];
		foreach ($includes as $name => $link) {
			wp_register_style($name, THEME_CSS . $link, array(), '1.0', 'all');
			wp_enqueue_style($name);
		}
	}
      
    function _enqueueFonts() {
		$includes = $this->themeflipConfig['includes']['fonts'];
		foreach ($includes as $name => $link) {
			wp_register_style($name, $link, array(), '1.0', 'all');
			wp_enqueue_style($name);
		}
	}
   	/*
	* Load and register all the widgets.
	*/	
	private function widgets() {
		$widgets = $this->themeflipConfig['widgets'];

		foreach ($widgets as $name => $loc) {
			if ( file_exists(THEME_WIDGETS . '/' . $loc) ) {
				require_once(THEME_WIDGETS . '/' . $loc);
				register_widget('theme_' . $name . 'Widget');
			}
		}
	}

	/*
	* Load the plugin and register the plugin.
	*/
	private function shortcodes() {
		$shortcodes = $this->themeflipConfig['shortcodes'];

		foreach ($shortcodes as $name => $loc) {
			if ( file_exists(THEME_WIDGETS . '/' . $loc) ) {
				require_once(THEME_SHORTCODES . '/' . $loc);
			}
		}
	}

	private function checkPHPversion() {
		if ( version_compare(PHP_VERSION, '5.3.0') <= 0 ) {
			wp_die('You have PHP version: ' . PHP_VERSION . ' installed. 
					This theme requires atleast PHP Version 5.3.0. Please contact your webhost for more information. 
					You can revert back to your old theme by going to your FTP server and deleting the theme you just activated.', 'WordPress Error');
		}
	}
	
	/*
	* Load the admin files.
	*/
	private function admin() {
		if (is_admin()) {
			require_once (THEME_ADMIN . '/admin.php');
			$admin = new Themeflip_admin();
			$admin->init($this->themeflipConfig);
		}
	}

} } ?>