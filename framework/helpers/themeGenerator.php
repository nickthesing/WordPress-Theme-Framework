<?php

/*
 * themeGenerator helper class.
 */
class themeGenerator {
    
    function title() {
        global $page, $paged; ?>        
        <title><?php bloginfo('name'); wp_title( '-', true, 'left' ); ?></title>
        <?php
    }

    function sideMenu() { 
        $menu = theme_getOption('header_menu_type');
        if ( $menu != 'side' ) { return; }
        ?>
        <div class="menu-wrap side-menu">

            <a href="#" class="close-menu icon-close"></a>

            <div class="menu-inner">

                <nav class="main-nav">
                    <?php themeGenerator('menu', 'header'); ?>
                </nav>

                <?php themeGenerator('headerContact'); ?>

            </div>

        </div>

        <div class="top-bar row-fluid">
            <div class="span4">
                <div class="menu-trigger">
                    <span class="icon-menu"></span>
                </div>
            </div>
            <div class="top-bar-logo span4">
                <?php themeGenerator('headerLogo'); ?>
            </div>
            <div class="social-media span4">
                 <?php themeGenerator('socialmedia'); ?>
            </div>
        </div>
    <?php
    }

    function wrapMenu() {
        $menu = theme_getOption('header_menu_type');
        if ( $menu != 'normal' ) { return; }

        ?>
        <div class="inline-menu-wrap">
            <div class="inline-menu">
                <div class="container">
                    <div class="row-fluid">
                        <div class="span3">
                            <?php themeGenerator('headerLogo'); ?>
                        </div>

                        <nav class="span9 menu-holder">
                            <?php themeGenerator('menu', 'header'); ?>
                        </nav>

                        <div class="menu-mobile-wrapper span4 offset5"> <!-- Menu Mobile Wrapper -->
                            <a id="menu-mobile-trigger" class="icon-menu-2"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    function header() {
        $type = theme_getOption('header_type');
        $headerText = theme_getOption('header_text');
        $headerButtonText = theme_getOption('header_button_text');
        $animation = unserialize(theme_getOption('header_text_ani'));

        $pageType = theme_getMeta(get_the_ID(), 'page_type', true);

        // If the page is a single page, remove the header and set the wrapper to the top.
        if ($pageType == 'single' || is_single()) { ?>
            <style>header.header { display: none; height: 0; min-height: 0; } .wrap { top: 0; }</style>
        <?php return; }

        if ( isset($animation['animation'] ) && isset($animation['delay']) ) {
            $an = 'data-animation="'.$animation["animation"].'" data-animation-delay="'.$animation["delay"].'"';
        } else { $an = ''; }

        if ( $type === 'image' ) { ?>
            <div class="header-background-overlay"></div>
            <?php if ( $headerText ) : ?>
                <div <?php echo $an; ?> class="animated header-text"> 
                    <?php echo $headerText; ?>
                </div>
             <?php endif; ?>

             <div class="trigger-down">
                 <a data-scroll=".wrap" data-speed="1000" class="icon-arrow-down-2" href="#"></a>
             </div>
            
        <?php }
        if ( $type === 'video' ) { 
                $headerVideoMP4 = theme_getOption('header_video');
                $headerVideoOGV = theme_getOption('header_video_ogv');
                $headerVideoPoster = theme_getOption('header_video_poster');
        ?>

            <div class="video-insert"></div>

            <?php if ( $headerVideoPoster != '' ) : ?>
                <div class="video-poster"><img src="<?php echo $headerVideoPoster; ?>" alt="Video Poster"></div>
            <?php endif; ?>

            <script>
            jQuery(document).ready(function() {
                jQuery('.video-insert').videoBG({
                    mp4:'<?php echo $headerVideoMP4; ?>',
                    ogv:'<?php echo $headerVideoOGV; ?>',
                    //poster:'<?php echo $headerVideoPoster; ?>',
                    scale:true,
                    zIndex: 1,
                    autoplay: false,
                });

                jQuery('.videopause').on('click', function(e) {
                    e.preventDefault();

                    // Video
                    var v = jQuery('.video-insert').find('video').get(0);

                    if ( jQuery(this).hasClass('icon-pause') ) {
                        v.pause();
                        jQuery('.video-controls a').toggleClass('icon-pause');
                        return;
                    }

                    v.play();
                    jQuery('.header-text').fadeOut(350);
                    jQuery('.video-poster').addClass('hideposter');
                    jQuery('.video-controls a').toggleClass('icon-pause');

                });
            });
            </script>

            <div class="video-controls"><a href="#" class="videopause icon-play-2"></a></div>
            
            <?php if ( $headerText ) : ?>
                <div <?php echo $an; ?> class="animated header-text header-video-text"> 
                    <?php echo $headerText; ?>
                </div>
            <?php endif; ?>


       <?php } if ( $type === 'portfolio' ) {

            $cat = theme_getOption('header_cat');
            $query = array('post_type' => 'portfolio', 'posts_per_page' => 999, 'category_name' => $cat);
            $loop = new WP_Query($query);

        ob_start(); ?>
        <div class="header-portfolio">

            <div class="overlay-text">
              <?php if ( $headerText ) : ?>
                    <div <?php echo $an; ?>  class="animated header-text"> 
                        <?php echo $headerText; ?>
                        <a class="portfolio-button closetext" href="#"><?php echo $headerButtonText; ?></a>
                    </div>
                 <?php endif; ?>

                 <!-- <div class="trigger-down">
                     <a class="button" href="#"><i class="icon-arrow-down-2"></i></a>
                 </div> -->
            </div>

            <div class="header-wrap">

                <?php
                    if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post();
                    $size = theme_getMeta(get_the_ID(), 'portfolio_item_size', true);
                    $video = theme_getMeta(get_the_ID(), 'portfolio_videomp4', true);

                    $imageSize = 'portfolio-head';
                    $retina_imageSize = 'portfolio-head-retina';
                    $size = 'portfolio-head';

                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), $imageSize); 
                    $retina_image = wp_get_attachment_image_src(get_post_thumbnail_id(), $retina_imageSize); 

                    $post_terms = get_the_terms(  get_the_ID(), 'filter' ); 
                    $post_t = array();

                    if ( isset($post_terms) && $post_terms !== false ) {
                        foreach ($post_terms as $post_term) {
                            $post_t[] = $post_term->slug;
                        }
                    }

                    $post_classes = implode(" ", $post_t) . ' ' . $size . ' portfolio-item clearfix';
                ?>

                    <article <?php themeGenerator('extraClass', $post_classes); ?>>
                        <a class="portfolio-single-link" data-singleid="<?php the_ID(); ?>" href="<?php the_permalink(); ?>">
                            <img class="itemImage" data-at2x="<?php echo $retina_image[0]; ?>" src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(); ?>" />
                            <div class="image-overlay"></div>
                             <?php if ( $video !== '' ) : ?>
                                <span class="overlay-icon icon-play-2"></span>
                            <?php endif; ?>
                        </a>
                    </article>

                <?php endwhile; endif; ?>
            </div>

            <div class="portfolio-nav">
                <ul>
                    <li class="nav-right"> 
                        <a href="#" class="next icon-arrow-right-2"></a>
                    </li>
                    <li class="nav-left">
                        <a href="#" class="prev icon-arrow-left-2"></a>
                    </li>
                </ul>
            </div>
        </div> 

        <?php
        $output = ob_get_clean();
        echo $output; 
        wp_reset_query();
        }
    }
    
    /* Get the sidebar */  
    function sidebar($sidebar, $post_id = null) {
        sidebarGenerator('getSidebar', $sidebar, $post_id);
    }
   
    /* Adds a class to the default wp class output */
    function extraClass($class) {
        post_class($class); 
    }

    function editLink() {
        edit_post_link(__('(Edit)', THEME_NAME),'<p class="entry_edit container">','</p>');
    }

    function stickyMenu() {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/MSIE/i',$u_agent) ) return; 
        if ( theme_getOption('stickymenu') == 'true' ) echo 'sticky-menu';
    }
    
    function meta() {
        $enableResponsive = theme_getOption('responsive_design');
        $favicon = theme_getOption('website_favicon');

        if ( $enableResponsive ) : ?> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php endif;  

        if ( $favicon != '' ) : ?>
            <link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon; ?>" />
        <?php endif;
    }

    function footerMeta() {
        $showCopyright = theme_getOption('footer_copyright');
        $copyrightText = theme_getOption('footer_copyright_text'); ?>

            <div class="footer-menu clearfix span6">
                <?php themeGenerator('menu', 'footer'); ?>
            </div>

        <?php if ( $showCopyright ) : ?>
            <div class="copyright-text span6"><?php echo $copyrightText; ?></div>    
        <?php endif;
    }
    
    function socialmedia() {
        $listSocialMedia = array('apple', 'dribbble', 'facebook', 'flickr-2', 'forrst', 'github', 'google-drive', 'google-plus', 'instagram', 'linkedin', 'picassa', 'pinterest', 'feed-2', 'stackoverflow', 'stumbleupon', 'tumblr', 'twitter', 'vimeo','wordpress','yelp', 'youtube');
        $optionData = array();
        $output = "";

        foreach ( $listSocialMedia as $key => $sm ) {
            $optionData[$sm]['socialmedia'] = theme_GetOption($sm . '_link');
            $optionData[$sm]['header'] = theme_GetOption($sm . '_header');
            $optionData[$sm]['widgets'] = theme_GetOption($sm . '_widgets');
        }

        $output = "<div class='socialmedia-menu widget-social-media'><ul class='clearfix'>"; 

        foreach( $optionData as $key => $sm ) {
            if ( $sm['header'] === 'true' ) {
                if ( isset( $sm['socialmedia']) ) {
                    $output .= "<li><a class='icon-{$key}' href='{$sm['socialmedia']}'></a></li>";
                }
            }
        }

        $output .= "</ul></div>";
        echo $output;
    }

    function loadGoogleFonts() {
        $normalFonts = array("Arial","Arial Black","Helvetica","Helvetica Neue","Comic Sans MS","Courier New","Georgia","Impact","Lucida Console","Lucida Sans Unicode","Lucida Grande","Tahoma","Times New Roman","Trebuchet MS","Verdana");
        $fonts = array(theme_getOption('heading_font'), theme_getOption('body_font'), theme_getOption('footer_heading_font'), theme_getOption('menu_font'));
        $newFonts = '';
        
        foreach( $fonts as $font ) {
            if ( !in_array($font, $normalFonts) ) {
                if ( $font != '' ) {
                    $newFonts .= str_replace(' ', '%20', $font.'|');
                }
            }
        }
        
        if ( $newFonts != '' ) {
            $output = '<link href="http://fonts.googleapis.com/css?family='.$newFonts.'" rel="stylesheet" type="text/css">';
            echo $output;
        }
    }

    function pageLayout() {
        $layout = theme_getOption('pagelayout');
        echo $layout;
    }

    function headerLogo() {
        $headerLogo = theme_getOption('logo');
        $headerLogoTitle = theme_getOption('logotitle');
        
        if(!empty($headerLogo)) {
        ?>
        
        <div class="header-logo side">
            <a href="#">
                <img src="<?php echo $headerLogo; ?>" alt="<?php echo $headerLogoTitle; ?>" title="<?php echo $headerLogoTitle; ?>" />
            </a>
        </div>

        <?php
        }

        else {
        ?>
        
        <div class="header-logo side">
            <a href="<?php echo get_bloginfo('url'); ?>">
                <h4 class="logo">
                    <?php echo get_bloginfo('name'); ?>
                </h4>
            </a>
        </div>

        <?php
        }  
    }

    function callToAction() {
        $showCalltoaction = theme_getOption('callToAction');
        $calltoactionText = theme_getOption('calltoaction_text');
        $calltoactionButtonText = theme_getOption('calltoaction_button_text');
        $calltoactionButtonLink = theme_getOption('calltoaction_button_link');
        $calltoactionButtonLinkPage = theme_getOption('calltoaction_button_linkp');

        $ctaBLink = ( isset($calltoactionButtonLinkPage) ) ?  $ctaBLink = get_permalink($calltoactionButtonLinkPage) : $ctaBLink = $calltoactionButtonLink;

        if ( $showCalltoaction && is_page_template('template-home.php') ) { ?>

            <div class="container calltoaction-container"> <!-- Call to Action -->
                <div class="calltoaction clearfix">
                    <div class="row-fluid">
                        <div class="cta-text-holder span9 clearfix">
                            <?php echo $calltoactionText; ?>
                        </div>
                        <div class="cta-button-holder span3 clearfix">
                            <a href="<?php echo $calltoactionButtonLink; ?>" class="cta-button button">
                               <?php echo $calltoactionButtonText; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div> <!-- Close Call to Action -->

    <?php }
    }

    
    function homepageSlider($pageID) {
        $homepage = 'template-home.php';
        
        if ( !is_page_template($homepage) ) { 
            return;
        }
            
        $slider = theme_getMeta($pageID, 'homepage_slider', true);
        $slider_cat = theme_getMeta($pageID, 'flex_category', true);
        $slider_height = theme_getMeta($pageID, 'homepage_slider_height', true);
        $id = theme_getMeta($pageID, 'homepage_slider_id', true);
        ?>

        <div id="homepage-slider"> <!-- Homepage Slider Container -->

            <?php if($slider === 'flexslider') { ?>
                <div id="flexslider-<?php the_ID(); ?>" class="flexslider" style="height: <?php echo $slider_height; ?>px;">
                    <ul class="slides">
                        <?php
                        $slides = array('post_type'=> 'slider','post_status'=> 'publish','category_name' => $slider_cat); 
                        query_posts($slides); 
                        
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blogpost-full');
                            $slide_text = get_the_content();
                        ?>  
                        <li>
                           
                            <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" style="height: <?php echo $slider_height; ?>px;"/>
                            
                            <?php if(!empty($slide_text)) { ?>
                                <div class="flex-caption">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo $slide_text; ?></p>
                                </div>
                            <?php } ?>
                        </li>
                    <?php endwhile; endif; ?>
                    </ul>
                </div>
                <?php wp_reset_query(); 
            } 

            if($slider === 'layerslider') {
                echo do_shortcode('[layerslider id="'.$id.'"]');
            }

            if($slider === 'revslider') { 
                if ( function_exists( 'putRevSlider' ) ) {
                    putRevSlider($id);
                }
            }

            ?>
        </div> <!-- Close Homepage Slider -->
    <?php } 
        
    function pageNavigation() {
        if ( function_exists('wp_pagenavi') ) {

        }
    }

    function blogpostMeta($specialMeta = false) { 
        if ( $specialMeta ) : ?>
            <ul class="span6">
                <li class="meta-date"><?php the_time('F jS, Y') ?></li>
                <li class="meta-author"><?php _e('Written by', THEME_NAME); ?> <?php the_author_posts_link(); ?></li>
                <li class="meta-categories">
                    <?php the_category(', '); ?>
                </li>
            </ul>
            <ul class="span6">
                <li class="meta-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></li>
                <li class="read-more">
                    <a href="<?php the_permalink(); ?>"><?php _e('Read this post',  THEME_NAME); ?></a>
                </li>

                <?php if (has_tag()) : ?>
                    <li class="meta-tags">
                        <?php the_tags('');  ?>
                    </li>
                <?php endif; ?>
            </ul>

        <?php return; endif; ?>

        <ul>
            <li class="meta-date"><?php the_time('F jS, Y') ?></li>
            <li class="meta-author"><?php _e('Written by', THEME_NAME); ?> <?php the_author_posts_link(); ?></li>
            <li class="meta-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></li>
            <li class="meta-categories">
                <?php the_category(', '); ?>
            </li>
            <?php if (has_tag() ) : ?>
            <li class="meta-tags">
                <?php the_tags('');  ?>
            </li>
            <?php endif; ?>
            <li class="read-more">
                <a href="<?php the_permalink(); ?>"><?php _e('Read this post',  THEME_NAME); ?></a>
            </li>
        </ul>


      <?php 
    }

    function blogpostThumbnail($thumbnailSize) {        
        if(has_post_thumbnail()) : ?>

            <?php $enableHoverDir = ( theme_getOption('blogpost_overlay') ) ? 'hoverdir' : ''; ?>
            <div class="post-thumb <?php echo $enableHoverDir; ?> preload">
                <?php the_post_thumbnail($thumbnailSize); ?>
                <div class="post-thumb-overlay">
                    <section class="post-thumb-overlay-inner">
                        <hgroup>
                            <h2><?php the_title(); ?></h2>
                        </hgroup>
                        <span class="overlay-meta-container">
                            <span class="overlay-meta-comments"><a href="<?php comments_link() ?>"><?php wp_count_comments(); ?> </a></span>
                            <span class="meta-link"><a href="<?php the_permalink(); ?>"></a></span>
                        </span>
                    </section>
                </div>
            </div>
        <?php endif;   
    }

    
    function blogpostTitle() { ?>

    <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

    <?php
    }

    function blogpostContent($post) {     
        if ( !empty($post->post_excerpt) ) { 
            echo the_excerpt();
        } else {
            $content = the_content();
            echo theme_stringLimitWords($content, 500);
        }
    }

    function headerContact() {
        $headerContact = theme_getOption('header_contact');
        $email = theme_getOption('email');

        if ( $headerContact != "true" ) {
            return;
        }
        ?>

        <div class="header-contact">
            <a class="button" href="mailto:<?php echo $email; ?>">
                <?php echo $email; ?>      
            </a>
        </div>

        <?php
    }


    function singleMeta(){ 

    ?>
        <div class="row-fluid clearfix">
            <div class="meta-container-single">
                <span class="meta-date"><?php the_time('F jS, Y') ?></span>
                <span class="meta-comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></span>
            </div>
        </div>

        <div class="post-content clearfix">
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>
        </div>

        <div class="meta-container-single clearfix">
            <ul>
                <li class="meta-categories">
                    <?php the_category(', '); ?>
                </li>
                <?php if (has_tag()) : ?>
                <li class="meta-tags">
                    <?php the_tags('');  ?>
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="post-footer clearfix">
            <div class="post-meta-author clearfix span6">
                <div class="meta-author-avatar">
                    <?php echo get_avatar( get_the_author_meta('email'), '60' ); ?> 
                </div>
                <div class="meta-author-bio">
                    <h4><?php the_author(); ?></h4>
                    <p>
                       <?php _e('Hover over to read this authors bio or click through to see a full list of posts by this author.', THEME_NAME); ?>
                    </p>
                    <?php themeGenerator('authorMeta'); ?>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="author-view-posts button button-white">View Posts</a>
                </div>
            </div>
            <div class="post-share clearfix span6">
                <h4>Share this post</h4>
                <p>Do you like this post or do you just want to share it with people you know?</p>
                <ul class="post-share-socialmedia ">
                    <li class="social-icons-facebook-icon">
                        <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"></a>
                    </li>
                    <li class="social-icons-pinterest-icon">
                        <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&amp;description=<?php urlencode(the_title()); ?>" class="pin-it-button" count-layout="horizontal"></a>
                    </li>
                    <li class="social-icons-linkedin-icon">
                        <a target="_blank"  href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php urlencode(the_title()); ?>"></a>
                    </li>
                    <li class="social-icons-googleplus-icon">
                        <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
                    </li>
                    <li class="social-icons-twitter-icon">
                        <a target="_blank" href="http://twitter.com/home?status=<?php urlencode(the_title()); ?>%20-%20<?php the_permalink();?>"></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="single-navigation navigation clearfix">
            <div class="nav-left"><?php previous_post_link('%link', '<span></span> Older entries') ?></div>
            <div class="nav-right"><?php next_post_link('%link', 'Newer entries <span></span>') ?></div>
        </div>
        <div class="content-title comments-header">
            <h4><?php comments_number('No Comments', '1 Comment', '% Comments'); ?></h4>
            <div class="leave-comment">
                <a href="#respond" class="button button-white"><?php _e('Leave a Comment', THEME_NAME); ?></a>
            </div>
        </div>
    <?php }

    function authorMeta() { 
        $authormeta = get_the_author_meta('description'); 
    ?>     
        <div class="meta-author-bio-info">
            <?php if(empty($authormeta)) { ?>
            <p><?php _e('Unfortunately this author has no description.', THEME_NAME); ?></p>                             
            <?php } else {  ?>
            <p><?php echo $authormeta; ?></p>
            <?php } ?>
        </div>
    
    <?php }

    function menu($menuName) {
        switch ($menuName) {
            case 'header':
                wp_nav_menu( array('theme_location' => 'header_menu', 'menu_class' => 'menu', 'container' => '', 'walker' => new theme_customMenuSettings()) );
            break;
            case 'footer':
                wp_nav_menu( array('theme_location' => 'subfooter_menu', 'menu_class' => 'sitemap-menu', 'container' => '') );
            break;
            case 'topheader':
                wp_nav_menu( array('theme_location' => 'topheader_menu', 'menu_class' => 'sitemap-menu', 'container' => '') );
            break;
        }            
    }

	function search() {
		get_search_form();
	}
	
    function breadcrumbs() { 
        $enableBreadcrumbs = theme_getOption('breadcrumbs');
        if ( !$enableBreadcrumbs ) return;
        ?>
        <div class="breadcrumbs">
            <div class="container">
                <?php

                $delimiter        = '/ ';     // delimiter between crumbs
                $home             = __('Home', THEME_NAME); // text for the 'Home' link
                $before         = '<li class="current">'; // tag before the current crumb
                $after             = '</li>';     // tag after the current crumb
                $output = '';

                global $post;
                $homeLink = get_bloginfo('url');

                if (!is_front_page()) {
             
                $output .= '<ul class="clearfix"><li><a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '</li>';

                    /* Blog page */
                    if (is_home() ) {
                        $output .= $before . get_the_title( get_option('page_for_posts') ) . $after;
                    }

                    elseif ( is_category() ) {
                        $thisCat = get_category(get_query_var('cat'), false);
                        if ($thisCat->parent != 0) {
                              $output .= get_category_parents($thisCat->parent, true, $delimiter . ' ');
                        }
                        $output .= $before . __('Archive by category ', THEME_NAME) . '"' . single_cat_title('', false) . '"' . $after;
                    }

                    elseif ( is_search() ) {
                        $output .= $before . __('Search results for ', THEME_NAME) . '"' . get_search_query() . '"' . $after;
                    }

                    /* Single */ 
                    elseif ( is_single() ) {
                        if (get_post_type() != 'post') {
                            $post_type = get_post_type_object(get_post_type());
                            $slug = $post_type->rewrite;
                            $output .= '<li><a href="' . $homeLink .  $slug['slug'] . '">' . $post_type->labels->singular_name . '</a>' . $delimiter . '</li>';
                            $output .=  $before . get_the_title() . $after;
                        } else {
                            $cat = get_the_category(); $cat = $cat[0];
                            $cats = get_category_parents($cat, true,  $delimiter . ' ');
                            $output .= '<li>' . $cats . '</li>';
                            $output .= $before . get_the_title() . $after;
                        }
                    }

                    /* Fallback */
                    elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                        $post_type = get_post_type_object(get_post_type());
                        $output .= $before . $post_type->labels->singular_name . $after;
                    }

                    /* Normal page */
                    elseif (is_page() && !$post->post_parent) {
                        $output .= $before . get_the_title() . $after;
                    }

                    /* Tag page */
                    elseif ( is_tag() ) {
                        $output .= $before . __('Posts tagged ', THEME_NAME) . '"' . single_tag_title('', false) . '"' . $after;
                    }

                    /* Author page */
                    elseif ( is_author() ) {
                        global $author;
                        $userdata = get_userdata($author);
                        $output .= $before . __('Articles posted by ', THEME_NAME). $userdata->display_name . $after;
                    }

                    elseif (is_archive() ) {
                        $output .= $before . __('Archive ', THEME_NAME) . get_the_time('Y') . ' - ' . get_the_time('m') . $after;
                    }

                    /* Error  404 page */
                    elseif ( is_404() ) {
                        $output .= $before . __('Error 404', THEME_NAME) . $after;
                    }

                    if (get_query_var('paged')){
                        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $output .= ' (';
                        $output .= __('Page', THEME_NAME) . ' ' . get_query_var('paged');
                        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $output .= ')';
                    }
                
                    $output .= '</ul>';
                    echo $output;
                }
                ?>
            </div>
        </div>
        <?php
    }

    function getMenuSidebar($sidebar) {
        if (function_exists('dynamic_sidebar')) {
            
            ob_start();
            dynamic_sidebar($sidebar);
            $output = ob_get_contents();
            ob_end_clean();

            return $output;
       }
    }

    function footerPageout() {
        $footerLogo = theme_getOption('footer_logo');
        $footerPageout = theme_getOption('footer_pageout');
        $footerLogoTitle = theme_getOption('logotitle');
        
        if ( $footerPageout ) { ?>
            <div class="page-out clearfix">
                <div class="container">
                    <div class="row-fluid">
                        <div class="footer-logo span3">
                            <img src="<?php echo $footerLogo; ?>" alt="<?php echo $footerLogoTitle; ?>" />
                        </div>
                        <div class="top-off-page span1 offset8">
                            <a href="#"><i class="icon-arrow-up"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }

    function pageTitle($pageID) {

        $homepage = 'template-home.php'; 
        if ( is_page_template($homepage) ) return;
        
        $pageTitleImage = theme_getMeta($pageID, 'title_image', true);
        $pageTitle = theme_getMeta($pageID, 'title_text', true);

    ?>    
    <div class="page-title">
        <div class="container">
            <?php if(!empty($pageTitleImage)) : ?>
            <div class="page-title-avatar">
                <img src="<?php echo $pageTitleImage; ?>" alt="Page Title" />
            </div>
            <?php endif; ?>
            <div class="page-title-content">
                <h1><?php wp_title($sep = ''); ?></h1>
                <?php if(!empty($pageTitle)) : ?>
                <p class="page-description"><?php echo $pageTitle; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php }

    function optionsHeadCode() {
        $headCode = theme_getOption('closehead');
        echo $headCode;
    }

    function optionsBodyCode() {
        $bodyCode = theme_getOption('closebody');
        echo $bodyCode;
    }
		
}

function themeGenerator($function) {
    global $_themeGenerator;
    $_themeGenerator = new themeGenerator;
    $args = array_slice( func_get_args(), 1 );
    return call_user_func_array(array( &$_themeGenerator, $function ), $args );
}
?>