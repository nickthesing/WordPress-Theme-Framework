<?php

/*
 * Sidebar generator helper class
 */

class sidebarGenerator { 
    var $sidebar_names = array();
    var $column_width;
    var $widget_class = '';
    
    function sidebarGenerator() {
        $this->sidebar_names = array( 
            'normal_sidebar' => __('Normal Sidebar', THEME_NAME),
            'footer_sidebar' => __('Footer Sidebar', THEME_NAME),
            'extra_footer_sidebar' => __('Extra Footer Sidebar', THEME_NAME)
		);
    }
    
    /* Add a special column to the sidebar */
    function sidebarColumn() {
        //get the column width from the admin
        if( tf_getSetting('footer_widget_width') ) {
            $this->column_width = theme_getOption('footer_widget_width');
        }
		else {
			$this->column_width = 4;
		}

        switch($this->column_width) {
            case 'column-1': $this->widget_class = "col-lg-12 col-md-12 col-sm-12 col-xs-12"; break;
            case 'column-2': $this->widget_class = "col-lg-6 col-md-6 col-sm-6 col-xs-12"; break;
            case 'column-3': $this->widget_class = "col-lg-4 col-md-4 col-sm-6 col-xs-12"; break;
            case 'column-4': $this->widget_class = "col-lg-3 col-md-3 col-sm-6 col-xs-12"; break;
        }
        return $this->widget_class;
    }

    /* Register the sidebars */
    function registerSidebar() {
        if ( function_exists('register_sidebars') ) {
            foreach ($this->sidebar_names as $id => $name) {
                if ($id == 'footer_sidebar' || $id == 'extra_footer_sidebar' ) {
                     register_sidebar(array(
                        'name' => $name,
                        'id' => $id,
                        'discription' => $name,
                        'before_widget' => '<div class="widgetBox ' . $this->sidebarColumn() . ' %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h5>',
                        'after_title' => '</h5>'
                    ));
                }
                else {
                    register_sidebar(array(
                        'name' => $name,
                        'id' => $id,
                        'discription' => $name,
                        'before_widget' => '<div id="%1$s" class="widgetBox %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h5>',
                        'after_title' => '</h5>'
                    ));	
                }
            }
        }
    }              
    
    /* Get the sidebar specific to the name given. */ 
    function getSidebar($sidebar, $post_id) {
        if (function_exists('dynamic_sidebar')){
            dynamic_sidebar($sidebar);
	   }
    }
}


global $_sidebarGenerator;
$_sidebarGenerator = new sidebarGenerator;

add_action('widgets_init', array($_sidebarGenerator, 'registerSidebar'));

function sidebarGenerator($function){
    global $_sidebarGenerator;
    $args = array_slice( func_get_args(), 1 );
    return call_user_func_array(array( &$_sidebarGenerator, $function ), $args );
}
?>