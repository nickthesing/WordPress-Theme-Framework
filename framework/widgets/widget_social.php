<?php
/*---------------------------------------------------------------------------------------------
* Theme Widget - Recent Posts
* Version 1.0
* Description: Shows all the latest blogposts.
---------------------------------------------------------------------------------------------*/

class theme_socialWidget extends WP_Widget {

	// The description for the widget in the admin
	function theme_socialWidget() {
		$widget_ops = array('classname' => 'widget-social-media', 'description' => __( 'Display a set of social media icons', THEME_NAME ) );
		$this->WP_Widget('social', THEME_NAME . ' - ' . __('Social Media', THEME_NAME), $widget_ops);
	}

 	// Get and create the variables for the widget 
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Social Media', THEME_NAME) : $instance['title'], $instance, $this->id_base);

		echo $before_widget;

		if ( $title ) { echo $before_title . $title . $after_title; }

		?>
		
		<?php
		
		$listSocialMedia = array('apple', 'dribbble', 'facebook', 'flickr-2', 'forrst', 'github', 'google-drive', 'google-plus', 'instagram', 'linkedin', 'picassa', 'pinterest', 'feed-2', 'stackoverflow', 'stumbleupon', 'tumblr', 'twitter', 'vimeo','wordpress','yelp', 'youtube');
        $optionData = array();
        $output = "";

        foreach ( $listSocialMedia as $key => $sm ) {
            $optionData[$sm]['socialmedia'] = theme_GetOption($sm . '_link');
            $optionData[$sm]['header'] = theme_GetOption($sm . '_header');
            $optionData[$sm]['widgets'] = theme_GetOption($sm . '_widgets');
        }

        $output = "<ul class='clearfix'>"; 

        foreach( $optionData as $key => $sm ) {
            if ( $sm['widgets'] === 'true' ) {
                if ( isset( $sm['socialmedia']) ) {
                    $output .= "<li><a class='icon-{$key}' href='{$sm['socialmedia']}'></a></li>";
                }
            }
        }

        $output .= "</ul>";

        echo $output;
        
        ?>

		<?php
			echo $after_widget;
		}

	// The update function 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
?>

<!-- Create the fields people have to fill in for the widget -->
<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
</p>

<p><i>The Social Media Icons can be set in the <a href="themes.php?page=<?php echo strtolower(THEME_NAME); ?>_options&tab=socialmedia"> Theme Options </a></i></p>

<?php
	}
}

