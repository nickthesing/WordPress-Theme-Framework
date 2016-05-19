<?php
/*---------------------------------------------------------------------------------------------
* Theme Widget - Flickr
* Version 1.0
* Description: Display photos from Flickr
---------------------------------------------------------------------------------------------*/

class theme_flickrWidget extends WP_Widget {

 	// The description for the widget in the admin
	function theme_flickrWidget() {
		$widget_ops = array('classname' => 'widget-flickr', 'description' => __( 'Display photos from Flickr', THEME_NAME ) );
		$this->WP_Widget('flickr', THEME_NAME . ' - ' . __('Flickr Photos', THEME_NAME), $widget_ops);
	}
	
	// Get and create the variables for the widget 
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Flickr', THEME_NAME) : $instance['title'], $instance, $this->id_base);
		$type = empty( $instance['type'] ) ? 'user' : $instance['type'];
		$flickr_id = $instance['flickr_id'];
		$count = (int)$instance['count'];
		$display = empty( $instance['display'] ) ? 'latest' : $instance['display'];
		$set_id = empty( $instance['set_id'] ) ? '' : $instance['set_id'];

		$count = ( $count < 1 ) ? 1 : $count;
		
		if (!empty($set_id)) {
			$set_id = '&amp;source=user_set&set='.$set_id.'';
		}
		
		if ( !empty( $flickr_id ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
		?>
		<div class="flickr-wrap clearfix">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $count; ?>&amp;display=<?php echo $display; ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type;?>&amp;<?php echo $type;?>=<?php echo $flickr_id.$set_id;?>"></script>
		</div>
		
		<?php
			echo $after_widget;
		}
	}
	
 	// The update function 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['count'] = (int) $new_instance['count'];
		$instance['display'] = strip_tags($new_instance['display']);
		$instance['set_id'] = strip_tags($new_instance['set_id']);
		
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$type = isset($instance['type']) ? esc_attr($instance['type']) : 'user';
		$flickr_id = isset($instance['flickr_id']) ? esc_attr($instance['flickr_id']) : '';
		$set_id = isset($instance['set_id']) ? esc_attr($instance['set_id']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		$display = isset( $instance['display'] ) ? $instance['display'] : 'latest';
?>

<!-- Create the fields people have to fill in for the widget -->
<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
<p>
	<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Type:', THEME_NAME ); ?></label>
	<select name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>" class="widefat">
		<option value="user"<?php selected($type,'user');?>>User</option>
		<option value="group"<?php selected($type,'group');?>>Group</option>
	</select>
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):', THEME_NAME); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" />
</p>
		
<p>
	<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of photo to show:', THEME_NAME); ?></label>
	<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" />
</p>
				
<p>
	<label for="<?php echo $this->get_field_id('set_id'); ?>"><?php _e('Set ID(optional):', THEME_NAME); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('set_id'); ?>" name="<?php echo $this->get_field_name('set_id'); ?>" type="text" value="<?php echo $set_id; ?>" />
</p>
		
<p>
<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Method for display your photos:', THEME_NAME); ?></label>
<select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
	<option<?php if($display == 'latest') echo ' selected="selected"'?> value="latest"><?php _e('Latest', THEME_NAME); ?></option>
	<option<?php if($display == 'random') echo ' selected="selected"'?> value="random"><?php _e('Random', THEME_NAME); ?></option>
</select>
</p>

<?php
	}
}