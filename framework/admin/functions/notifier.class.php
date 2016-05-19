<?php

/*
 * themeUpdateNotifier class.
 */

class themeUpdateNotifier {

	var $theme_website = THEME_WEBSITE;

	function __construct() {
		$this->theme_folder_name = lcfirst(THEME_NAME);
		$this->changelog_xml_file = $this->theme_website . 'changelogs/' . $this->theme_folder_name .'/notifier.xml'; 
		$this->chache_interval = 1;
		$this->theme_data = wp_get_theme();

		if (function_exists('simplexml_load_string')) {
			$this->xml = $this->theme_getLatestThemeVersion($this->chache_interval);
		}
 	}

 	function theme_showNotifier() {
		if( (float)$this->xml->latest > (float)$this->theme_data['Version']) { ?>
 			<div class="theme_option">
 				<div class="theme-option-message-box">
					<h2>
						Update available!
					</h2>
					<p>
						There is a new version for the <?php echo THEME_NAME; ?> theme available.</strong> You have version <?php echo $this->theme_data->Version; ?> installed. 
						Please update to version <?php echo $this->xml->latest; ?>. Please visit <a href="index.php?page=theme-update-notifier">this page</a> for more information.
					</p>
					<div class="theme-new-changes">
						<h2>
							Changes
						</h2>
						<?php echo $this->xml->newchanges; ?>
					</div>
				</div>
			</div>
		<?php
 		} else {
 			echo '<p>'.__('There might be a problem fetching the notifier data.', THEME_NAME).'</p>';
 		}
 	}

 	function theme_CreateNotifierMenu() {
 		add_action('admin_menu', array(&$this, 'theme_UpdateNotifierMenu'));
 	}

	function theme_UpdateNotifierMenu() {
		if (function_exists('simplexml_load_string')) {		
			if( (float)$this->xml->latest > (float)$this->theme_data['Version']) {
				add_dashboard_page( THEME_NAME . ' Theme Updates', THEME_NAME . ' <span class="update-plugins count-1"><span class="update-count">Update!</span></span>', 'administrator', 'theme-update-notifier', array(&$this, 'theme_UpdateNotifier'));
			}
		}
	}

	function theme_UpdateNotifier() { ?>		
		<style>
			.update-nag { display: none; }
			#instructions {max-width: 400px; float: left; }
			h3.title {margin: 0 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd; clear: both; }
			#instructions h3 { margin: 0!important; }
		</style>

		<div class="wrap">
		
			<div id="icon-tools" class="icon32"></div>
			<h2><?php echo THEME_NAME ?> Theme Updates</h2>
		    <div id="message" class="updated below-h2"><p><strong>There is a new version for the <?php echo THEME_NAME; ?> theme available.</strong> You have version <?php echo $this->theme_data->Version; ?> installed. Please update to version <?php echo $this->xml->latest; ?>.</p></div>

			<img style="float: left; margin: 0 20px 20px 0; border: 1px solid #ddd;" src="<?php echo get_bloginfo( 'template_url' ) . '/screenshot.png'; ?>" />
			
			<div id="instructions">
			    <h3>Update Download and Instructions</h3>
			    <p><strong>Please note:</strong> make a <strong>backup</strong> of the Theme inside your WordPress installation folder <strong>/wp-content/themes/<?php echo $this->theme_folder_name; ?>/</strong></p>
			    <p>To update the Theme, login to <a href="http://www.themeforest.net/">ThemeForest</a>, head over to your <strong>downloads</strong> section and re-download the theme like you did when you bought it.</p>
			    <p>Extract the zip's contents, look for the extracted theme folder, and after you have all the new files upload them using FTP to the <strong>/wp-content/themes/<?php echo $this->theme_folder_name; ?>/</strong> folder overwriting the old ones (this is why it's important to backup any changes you've made to the theme files).</p>
			    <p>If you didn't make any changes to the theme files, you are free to overwrite them with the new ones without the risk of losing theme settings, pages, posts, etc, and backwards compatibility is guaranteed.</p>
			</div>
		    
		    <h3 class="title">Changelog</h3>
		    <?php echo $this->xml->changelog; ?>

		</div>
	    
	<?php }

	function theme_getLatestThemeVersion($interval) {
		$notifier_file_url = $this->changelog_xml_file;	
		$db_cache_field = 'notifier-cache';
		$db_cache_field_last_updated = 'notifier-cache-last-updated';
		$last = get_option( $db_cache_field_last_updated );
		$now = time();

		if ( !$last || (( $now - $last ) > $interval) ) {

			if( function_exists('curl_init') ) {
				$ch = curl_init($notifier_file_url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				$cache = curl_exec($ch);
				curl_close($ch);
			} else {
				$cache = file_get_contents($notifier_file_url);
			}
			
			if ($cache) {			
				update_option( $db_cache_field, $cache );
				update_option( $db_cache_field_last_updated, time() );
			} 
			$notifier_data = get_option( $db_cache_field );
		}
		else {
			$notifier_data = get_option( $db_cache_field );
		}
		
		if( strpos((string)$notifier_data, '<notifier>') === false ) {
			$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
		}

		$xml = simplexml_load_string($notifier_data); 		
		return $xml;
	}	
}