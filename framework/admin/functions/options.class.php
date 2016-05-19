<?php

class optionGenerator {

	public function option($option) {
		$settings = ( isset($option['settings']) ) ? : [true, true];

		echo '<div class='.FRAMEWORK.'-option>';

		if ( $settings[0] ) {
			$this->option_header($option);
		}

		echo '<div class="'.FRAMEWORK.'-option-content">';
		call_user_func(array(&$this,'option_'.$option['type']), $option);

		echo '</div>';

		if ( $settings[1] ) {
			$this->option_footer($option);
		}

		echo '</div>';
	}

	private function option_header($option) {
		echo '<div class="'.FRAMEWORK.'-option-heading">';
		echo '<h2>'.$option['name'].'</h2>';
		echo '<p>'.$option['desc'].'</p>';
		echo '</div>';
	}

	private function option_footer($option) {
		echo '<div class="'.FRAMEWORK.'-option-footer">';

		echo '</div>';
	}

	private function option_text($option) {
		$default = isset($option['default']) ? $option['default'] : '';
		$value = ( $option['value'] ) ? $option['value'] : $default;
		$output = '<input id="'.$option['id'].'" name="'. $option['id'].'"type="text" value="'. $value.'" />';
		echo $output;
	}

	private function option_sidebar($option, $meta) {
		$this->show_field_start($option);
		$sidebars = $this->getSidebars();

		$output = '<div class="options-left-section"><ul class="options-sidebarlist">';
		
		foreach ($sidebars as $key => $sidebar) {
			if ( $key == 'normal_sidebar' || $key == 'footer_sidebar' ) {
				$output .= '<li data-sidebarname="' . $key . '">' . $sidebar . '</li>';
			} else {
				$output .= '<li data-sidebarname="' . $key . '">' . $sidebar . '<a href="#" class="option-remove-sidebar">X</a></li>';
			}
		}

		$output .= '</ul><input id="' . $option['id'] .'" name="' . $option['id'] .'"type="hidden" value="' . $meta .'" />';
		$output .= '<div class="remove-message"><h4>Are you sure you want to delete this sidebar?</h4><a class="remove-true button button-primary" href="#">Yes</a><a class="remove-cancel button action" href="#">Cancel</a></div>';
		$output .='</div>';
		echo $output;
		$this->show_field_end($option);
	}

	private function option_sidebar_add($option, $meta) {
		$this->show_field_start($option); 
		$output = '<div class="options-left-section">';
		$output .= '<input id="' . $option['id'] .'" class="option-sidebar-add-input" name="' . $option['id'] .'"type="text" />';
		$output .= '<a data-input="' . THEME_SLUG  . '_sidebar_list" data-preview-img="img_' . $option['id'] . '" href="#" class="option-add-sidebar button button-primary button-upload">Add Sidebar</a>';
		$output .= '</div>';
		echo $output;
		$this->show_field_end($option);
	}		
	
	private function option_textarea($option) {
		$output = '<textarea name="' . $option['id'] . '" type="' . $option['type'] . '" cols="" rows="">' . $option['value'] . '</textarea>';
		echo $output;
	}

	private function option_categories($option) {
		$categories = get_categories();
		$output = "<select name='{$option['id']}'>";
		$output .= "<option value=''>Select Category</option>";
		foreach ($categories as $category) {
			$selected = ( $category->category_nicename == $option['value']) ? 'selected="selected"' : '';
			$output .= "<option value='{$category->category_nicename}' {$selected}>{$category->cat_name}</option>";
		}
		$output .= "</select>";
		echo $output;
	}

	private function option_colorpicker($option) {
		$output = '<input id="' . $option['id'] .'" name="' . $option['id'] .'"type="text" value="' . $option['value'] .'" class="'.FRAMEWORK.'-js-color-picker" />';
		echo $output;
	}

	private function option_upload($option) {
		$value = ( $option['value'] !== '' ) ? $option['value'] : '';

		$output =  '<div class="'.FRAMEWORK.'-input-container"><input id="' . $option['id'] . '" class="custom_media_url" type="text" name="' . $option['id'] .'" value="' . $value .'"><a href="#" class="tf-remove-upload icon-close"></a></div>';
		$output .= '<div class="'.FRAMEWORK.'-option-buttons"><a data-input="' . $option['id'] . '" data-preview-img="img_' . $option['id'] . '" href="#" class="main-button tf-js-upload">Upload</a>';
		$output .= '<a href="#TB_inline?width=300&height=300&inlineId=preview-content" class="secondary-button tf-js-preview thickbox">Preview</a></div>';
		$output .= '<div id="preview-content"><div class="preview-content-block"><div class="preview-content-container"></div></div></div>';
 		echo $output;
	}

	private function option_radio_images($option) {
		$output = '<div class="'.FRAMEWORK.'-radio-images clearfix">';
		
		foreach ($option['options'] as $option_sub) {
			$checked = ( $option['value'] == $option_sub) ? $checked = 'checked' : $checked = null;
			$output .= '<label class="radio-label radio-image-' . $option_sub . ' ' .$checked . '" for="' . $option['id'] .'-'. $option_sub .'"></label>';
			$output .= '<input class="radio-image-input" type="radio" id="'. $option['id'] .'-'. $option_sub . '" name="' . $option['id'] .'" value="' . $option_sub . '" ' . $checked . ' />';
		}	
		$output .= '</div>';
		echo $output;
	}

	private function option_font_selector($option, $meta) {
		$this->show_field_start($option); 
		$meta = get_option($option['id']) == '' ? $meta : $meta; 

		$output = '<div class="options-left-section"><select name="' . $option['id'] . '" id="' . $option['id'] . '"></select></div>';

		if ( $option['preview'] ) {
			$output .= '<h3 id="' . $option['id'] . '" class="preview-font">the quick brown fox jumps over the lazy dog.</h3>';
		}
		$output .= '<script type="text/javascript">';				   
		$output .= 'jQuery(document).ready(function() { ';
		$output .= 'jQuery("#' . $option['id'] . '").FontSelector({ ';
		$output .= 'previewContainer: jQuery("h3#' . $option['id'] . '"), ';
		$output .= 'currentFont: "' . $meta  . '", ';
		$output .= 'previewText: "The quick brown fox jumps over the lazy dog."}); }); ';
		$output .= '</script>';		
		echo $output;
	}

	private function option_sidebar_select($option, $meta) {
		$this->show_field_start($option);
		$sidebars = $this->getSidebars();
		
		$output = "<select name='{$option['id']}'>";
		$output .= "<option value=''>". __('Select Sidebar', THEME_NAME) . "</option>";

		foreach ($sidebars as $key => $sidebar) {
			$selected = ( $key == $meta ) ? 'selected="selected"' : '';
			$output .= "<option value='{$key}' {$selected}>{$sidebar}</option>";
		}

		$output .= "</select>";
		echo $output;
		$this->show_field_end($option);
	}

	private	function option_custom_text($option) {
		$output = '<div class="'.FRAMEWORK.'-custom-text">';
		$output .= '<h2>' . $option['name'] . '</h2><p>' . $option['desc'] . '</p>';
		$output .= '</div>';
		echo $output;
	}

	private function option_message_box($option) {
		$output = '<div class="'.FRAMEWORK.'-option-message-box">';
		$output .= '<h2>' . $option['name'] . '</h2><p>' . $option['desc'] . '</p>';
		$output .= '</div>';
		echo $output;
	}
	
	private function option_select($option) {
		$output = '<select name="' . $option['id'] . '" id="' . $option['id'] . '">';
		$output .= "<option value=''>". __('Select Option', THEME_NAME) . "</option>";
		if ( !empty($option['options'])) {
			foreach ($option['options'] as $key => $suboption) {
				$selected = ( $key == $option['value'] ) ? 'selected="selected"' : '';
				$output .= '<option value="'.$key.'"' . $selected . '>' .  $suboption . '</option>';
			}
		}
		$output .= '</select>';
		echo $output;
	}
	
	private function option_checkbox($option) {
		$checked = ( $option['value'] == 'true' ) ? $checked = 'checked="checked"' : $checked = '';  
		$output = '<input type="hidden" name="'.$option['id'].'" value="false" />';
		$output .= '<input class="js-checkbox" type="checkbox" name=" ' . $option['id'] . '" id=" ' . $option['id'] . '" value="true"' . $checked . '/>';	
		echo $output;
	}
	
	private function option_pages_select($option) {		
		$output = '<select name="' . $option['id'] . '" id="' . $option['id'] . '">';			
		$output .= '<option value="">' . __( 'Select page' , THEME_NAME) . '</option>';

		$pages = get_pages();
		foreach ( $pages as $page ) {
			$selected = ( $page->ID == $option['value'] ) ? 'selected="selected"' : '';
			$select_option = '<option ' . $selected . ' value="' . $page->ID . '">';
			$select_option .= $page->post_title;
			$select_option .= '</option>';
			$output .= $select_option;
		}
		$output .= '</select>';
		echo $output;
	}

	private function getSidebars() {
		global $wp_registered_sidebars;
		if ( empty( $wp_registered_sidebars ) ) {
			return;
		}
		foreach ( $wp_registered_sidebars as $key => $value ) {
			$this->sidebars[$key] = $value['name'];
		}
		return $sidebars;
	}
}
?>