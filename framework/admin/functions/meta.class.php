<?php 
/**
 * Content Designer Meta Box Class
 *
 * @author: SomniaThemes & 66Themes
 * @version: 1.0
 */

class tf_MetaBox {

	var $meta_box;
	var $meta_fields;

	function __construct($meta_box) {
		if (!is_admin()) return;

		require_once(THEME_ADMIN_FUNCTIONS . '/options.class.php');
		$this->optionGenerator = new optionGenerator();

		$this->meta_box = $meta_box;
		$this->meta_fields = $this->meta_box['fields'];

		add_action('admin_menu', array(&$this, 'tf_add'));
		add_action('save_post', array(&$this, 'tf_save'));
	}

	function tf_add() {
		foreach ($this->meta_box['pages'] as $page) {
			add_meta_box($this->meta_box['id'], $this->meta_box['title'], array(&$this, 'tf_show'), $page, $this->meta_box['context'], $this->meta_box['priority']);		
			add_filter( 'postbox_classes_' . $page . '_' . $this->meta_box['id'], array(&$this, 'tf_add_my_meta_box_classes' ));
		}
	}

	function tf_add_my_meta_box_classes( $classes = array() ) {
	    if( !in_array( 'theme_custom_meta', $classes ) )
	        $classes[] = 'theme_custom_meta';
	    return $classes;
	}

	function tf_save($post_id) {
		if ( isset($_POST['post_type']) ) { 
			$post_type_object = get_post_type_object($_POST['post_type']);
		}

		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 						// check autosave
		|| (!isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])			// check revision
		|| (!in_array($_POST['post_type'], $this->meta_box['pages']))			// check if current post type is supported
		|| (!check_admin_referer(basename(__FILE__), FRAMEWORK . '_metabox'))		// verify nonce
		|| (!current_user_can($post_type_object->cap->edit_post, $post_id))) {	// check permission
			return $post_id;
		}

		foreach ($this->meta_fields as $field) {
			$id = FRAMEWORK.'_'.strtolower($field['id']);
			$type = $field['type'];

			if ( !isset($field['multiple'])) { $field['multiple'] = false; }
			$old = get_post_meta($post_id, $id, !$field['multiple']);
			$new = isset($_POST[$id]) ? $_POST[$id] : ($field['multiple'] ? array() : '');
			
			$this->tf_save_field($post_id, $field, $old, $new);
		}
	}

	// Common functions for saving field
	function tf_save_field($post_id, $field, $old, $new) {
		$id = FRAMEWORK.'_'.strtolower($field['id']);

		// single value
		if (!$field['multiple']) {
			if ('' != $new && $new != $old) {
				update_post_meta($post_id, $id, $new);
			} elseif ('' == $new) {
				delete_post_meta($post_id, $id, $old);
			}
			return;
		}

		$add = array_diff($new, $old);
		$delete = array_diff($old, $new);
		foreach ($add as $add_new) {
			add_post_meta($post_id, $name, $add_new, false);
		}
		foreach ($delete as $delete_old) {
			delete_post_meta($post_id, $name, $delete_old);
		}
	}
	
	function tf_show() {
		global $post;
		wp_nonce_field(basename(__FILE__), FRAMEWORK . '_metabox');
		echo '<div class="'.FRAMEWORK.'-wrapper">';

		foreach ($this->meta_fields as $field) {
			$id = FRAMEWORK.'_'.strtolower($field['id']);
			
			$meta = get_post_meta($post->ID, $id, true);
			if ( isset($field['std']) ) {
				$meta = !empty($meta) ? $meta : $field['std'];
 			}

 			$field['value'] = $meta;
 			$field['id'] = $id;
 		
			$this->optionGenerator->option($field);
		}
		echo '</div>';
	}
} 
?>