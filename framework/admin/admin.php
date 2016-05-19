<?php 
/*
** Theme admin class
** This class will load all necessary functions.
*/

if( !class_exists('Themeflip_admin') ) {

class Themeflip_admin {
    
	var $tabs;
	
	var $options;

	var $updateNotify;

	var $pages;

	var $generateData;

	var $settings;
	
    function init($config) {       

    	define('THEME_PAGE', strtolower(THEME_NAME) . '_options');

    	// Admin Config 
    	$this->config = $config['admin'];
    	$this->options = $this->config['options'];

    	$this->settings = ( get_option(SETTINGS) ) ? get_option(SETTINGS) : [];
    	$this->saveSettings();

        /* Load all admin functions */ 
        $this->functions();
        
        /* Load all metaboxes (custom posts fields) */  
        $this->metaboxes();

		/* Create the new admin menu. */
		add_action( 'admin_menu', array(&$this, 'createAdminMenu') );

		require_once(THEME_ADMIN_FUNCTIONS . '/options.class.php');
		$this->optionGenerator = new optionGenerator();
		
		/* Call the Theme Update Class */
		require_once(THEME_ADMIN_FUNCTIONS . '/notifier.class.php');
		$this->updateNotify = new themeUpdateNotifier();
		$this->updateNotify->theme_CreateNotifierMenu();

		add_action('wp_ajax_backupOptions', array(&$this, 'backupOptions'));
       	add_action('wp_ajax_restoreOptions', array(&$this, 'restoreOptions'));
	}
    
    function functions() {
        require_once(THEME_ADMIN_FUNCTIONS . '/head.php');
	}
   
    function metaboxes() {
    	$metas = $this->config['meta_options'];
        require_once(THEME_ADMIN_FUNCTIONS . '/meta.class.php');

        foreach ($metas as $key => $meta) {
        	$metabox = new tf_Metabox($meta);      
        }      
    }
	
	function createAdminMenu() {
		add_theme_page(THEME_NAME . ' Options', THEME_NAME . ' Options', 'administrator', THEME_PAGE, array(&$this, 'renderOptionPage'));
	}
	
	function renderOptionPage() {
		$this->pageHeader();	
		
		$this->pageContent();

		$this->pageFooter();
	}

	function pageHeader() {
		?>
			<div class="<?php echo FRAMEWORK; ?>-wrapper">
				<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css' />
				<div class="<?php echo FRAMEWORK; ?>-header">
					<div class="<?php echo FRAMEWORK; ?>-page-title">
						<?php $this->pageTabs(); ?>
					</div>	
				</div>
		<?php
	}
	
	function pageTabs() {
		$tabs = $this->config['tabs'];

		$activeTab = ( isset($_GET['tab']) ) ? $_GET['tab'] : 'general'; 

		$output = '<nav class="'.FRAMEWORK.'-tab-wrap"><ul>';
		foreach ($tabs as $tab => $name) {
			$active = ( $activeTab == $tab ) ? 'active' : '';
 			$output .= '<li><a class="'.$active.'" href="?page=' . THEME_PAGE . '&tab=' . $tab . '">';
				$output .= $name;
			$output .= '</a></li>';
		}

		$output .= '<li class="tf-update-button"><a href="#" class="tf-button">Save settings</a></li>';
		$output .= '<li class="tf-settings-updated">Settings updated</li>';

		// Extra menu items
		$output .= '<li class="nav-right"><a href="?page=' . THEME_PAGE . '&tab=documentation"><i class="icon-file"></i></a></li>';
		$output .= '<li class="nav-right"><a href="?page=' . THEME_PAGE . '&tab=updates"><i class="icon-code-fork"></i></a></li>';
		$output .= '</ul></nav>';
		echo $output;
	}
	
	function pageContent() {
		global $pagenow;
		if ( $pagenow == 'themes.php' && $_GET['page'] == THEME_PAGE ) {
			if ( isset ( $_GET['tab'] ) ) {
				$current_tab = $_GET['tab']; 
			} else { 
				$current_tab = 'general'; 
			}
			
			if ( $current_tab == 'updates') {
				$this->showUpdatePage();
			} elseif ( $current_tab == 'advanced' ) {
				$this->showAdvancedPage();
			}
			elseif(array_key_exists($current_tab, $this->config['tabs']) ) {
				$this->setupOptionPage($current_tab);
			}
		}
	}

	function pageFooter() { /* nothing here? */ }

	function getSettings() {
		return get_option(SETTINGS);
	}

	function saveSettings() {	
    	if ( isset( $_POST[FRAMEWORK.'_options_nonce'] ) && wp_verify_nonce( $_POST[FRAMEWORK.'_options_nonce'],FRAMEWORK.'_options_form') ) {
			$tab = ( isset($_GET['tab']) ) ? $_GET['tab'] : 'general';
			foreach ($this->options as $key => $options) {
				if ( $tab === $key ) {
					foreach ($options as $name => $option) {
						$id = FRAMEWORK.'_'.strtolower($option['id']);
						if ( isset($_POST[$id]) ) {
							$this->settings[$id] = $_POST[$id];
							update_option(SETTINGS, $this->settings);
						}
					}
				}
			}
		}
	}
	
	function setupOptionPage($tab) {
		$settings = $this->settings;

		echo '<div class="'.FRAMEWORK.'-option-container">';
		echo '<form method="post" id="'.FRAMEWORK.'-js-options-form">';

      	wp_nonce_field(FRAMEWORK.'_options_form', FRAMEWORK.'_options_nonce' );

      	if ( $this->options ) {
 
			foreach ( $this->options as $key => $options ) {
				
				if ( $tab === $key ) {

					foreach ($options as $name => $data) {
						
						if ( $name !== '' ) {
							$id = FRAMEWORK.'_'.strtolower($data['id']);

							$data['value'] = ( isset($settings[$id]) ) ? $settings[$id] : '';
							$data['name'] = $name;
							$data['id'] = $id;

							$this->optionGenerator->option($data);
						}
					}
				} else {
					echo '<p>There are no options for this tab. Please check the configuration file.</p>';
				}
			}
		}

		echo '</form></div>';
	}

	function showUpdatePage() {
		echo '<div class="'.FRAMEWORK.'-option-container">';
		echo '<h1>'.THEME_NAME.' Changes</h1>';

		$this->updateNotify->theme_showNotifier();
	
		echo '</div>';
	}

	function backupOptions() {
		if ( isset($_GET['backup']) && $_GET['backup'] ) {
			$settings = get_option(SETTINGS);
			$date = date("n-j-Y"); 

			$backup = ['settings' => $settings,'backupdate' => $date];

			$base64BackupValue = base64_encode(serialize($backup));
			update_option(FRAMEWORK . '_backup_options', $base64BackupValue);
			return '<p>' . __('Backup settings was succesfull.', THEME_NAME) . '</p>';
		}
	}

	function restoreOptions() {
		if ( isset($_GET['restore']) && $_GET['restore'] ) {
			$backup = unserialize(base64_decode(get_option(FRAMEWORK . '_backup_options')));
			$newSettings = $backup['settings'];
			update_option(SETTINGS, $newSettings);
			return '<p>' . __('Settings are succesfully restored.', THEME_NAME) . '</p>';
		}
	}
	
	function showAdvancedPage() {
		$backup = get_option(FRAMEWORK . '_backup_options');
		$un = unserialize(base64_decode($backup));

		$output = '<div class="'.FRAMEWORK.'-option-container">';
		$output .= '<form method="post" id="'.FRAMEWORK.'-js-options-form">';
		$output .= '<h3>Advanced '.THEME_NAME.' Options</h3>';

		$output .= '<div class="backup-info">';
		$output .= $this->backupOptions();
		$output .= $this->restoreOptions();
		$output .= '</div>';

		if ( $un['backupdate'] ) {
			$output .= '<p class="backup-notice">'.__('Last backup made on:', THEME_NAME).'<span class="js-date-update"> '.$un['backupdate'].'</span></p>';
		}
		
		$output .= '<a href="?page=' . THEME_PAGE . '&tab=advanced&backup=true" class="button primary-button '.FRAMEWORK.'-js-backup-options">Backup Options</a>';
		$output .= '<a href="?page=' . THEME_PAGE . '&tab=advanced&restore=true" class="button danger-button primary-button '.FRAMEWORK.'-js-restore-options">Restore Options</a>';

		$output .= '</form></div>';
		echo $output;
	}
    
} } ?>