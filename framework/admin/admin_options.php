<?php 

$options = array(
	/* General */
	array( "name" => "Website Description",
		"desc" => "Here you can specify your website description. Your meta description will often show up in search results.",
		"id" => THEME_SLUG ."_website_description",
		"type" => "text",
		"tab" => "general"
	),
	array( "name" => "Website Keywords",
		"desc" => "Here you can specify website keywords. Describe a few keywords which are relevant to your website content. <b>Divide them by a comma</b>",
		"id" => THEME_SLUG ."_website_keywords",
		"type" => "textarea",
		"tab" => "general"
	),
	array( "name" => "Website Favicon",
		"desc" => "Here you can upload your favicon. A favicon is the little icon you see in the URL bar at the top.",
		"id" => THEME_SLUG ."_website_favicon",
		"type" => "upload",
		"tab" => "general"
	),
	array( "name" => "Theme single page behavior.",
		"desc" => "Specify the theme single page behavior. Choose between single overlay pages, or default WordPress single pages (seperate page).",
		"id" => THEME_SLUG ."_theme_single",
		"type" => "select",
		"tab" => "general",
		"options" => array('overlay' => 'Overlay Single Pages', 'default' => 'Default WordPress behavior'),
		"std" => 'overlay'
	),
	array( "name" => "Google Analytics",
		"desc" => "You can insert your Google Analytics in this field. For more information visit <a href='http://www.google.com/analytics/'>http://www.google.com/analytics/</a>",
		"id" => THEME_SLUG ."_google_analytics",
		"type" => "textarea",
		"tab" => "general"
	),
	array( "name" => "Extra Code in the " . htmlspecialchars('</head>') . "",
		"desc" => "If you want to put any extra code in the head part of your website. Please insert it here.  It will be inserted right before the  " . htmlspecialchars('</head>') . "",
		"id" => THEME_SLUG ."_closehead",
		"type" => "textarea",
		"tab" => "general"
	),
	array( "name" => "Extra Code in the " . htmlspecialchars('</body>') . "",
		"desc" => "If you want to put any extra code in the body part of your website. Please insert it here.  It will be inserted right before the " . htmlspecialchars('</body>') . "",
		"id" => THEME_SLUG ."_closebody",
		"type" => "textarea",
		"tab" => "general"
	),

	/* header */
	array( "name" => "Header Type",
		"desc" => "Select the header type.",
		"id" => THEME_SLUG ."_header_type",
		"type" => "select",
		"tab" => "header",
		"options" => array('image' => 'Image Header', 'portfolio' => 'Portfolio Header', 'video' => 'Video Header')
	),
	array( "name" => "Header Portfolio Category",
		"desc" => "Choose the header portfolio category. Note: this only works if the header type is Portfolio Header.",
		"id" => THEME_SLUG ."_header_cat",
		"type" => "categories",
		"tab" => "header",
	),
	array( "name" => "Header Menu Type",
		"desc" => "Select the header menu type.",
		"id" => THEME_SLUG ."_header_menu_type",
		"type" => "select",
		"tab" => "header",
		"options" => array('side' => 'Side Menu', 'normal' => 'Normal Menu'),
		"std" => 'side'
	),
	array( "name" => "Header Text Animation",
		"desc" => "Specify the animation for the header text.",
		"id" => THEME_SLUG ."_header_text_ani",
		"type" => "animate",
		"tab" => "header",
	),
	array( "name" => "Header Background Image",
		"desc" => "Here you can upload a background image for the header. Below the upload buttons you will see a preview of your background.",
		"id" => THEME_SLUG ."_header_bg",
		"type" => "upload",
		"tab" => "header"
	),
	array( "name" => "Header Background Video (MP4 File)",
		"desc" => "Here you can upload a background video MP4 file for the header.",
		"id" => THEME_SLUG ."_header_video",
		"type" => "upload_video",
		"tab" => "header",
		"preview" => false
	),
	array( "name" => "Header Background Video (OGV File)",
		"desc" => "Here you can upload a background video OGV file for the header.",
		"id" => THEME_SLUG ."_header_video_ogv",
		"type" => "upload_video",
		"tab" => "header",
		"preview" => false
	),
	array( "name" => "Header Background Video Poster (Image)",
		"desc" => "Here you can show the poster for a video which gets shown as a fallback if the video cannot be played.",
		"id" => THEME_SLUG ."_header_video_poster",
		"type" => "upload",
		"tab" => "header",
		"preview" => false
	),
	array( "name" => "Header Text",
		"desc" => "Specify the text that will be displayed in the header.",
		"id" => THEME_SLUG ."_header_text",
		"type" => "textarea",
		"tab" => "header"
	),
	array( "name" => "Header Button Text",
		"desc" => "Specify the text that will be displayed on the button in the header. This only works if you select the portfolio header.",
		"id" => THEME_SLUG ."_header_button_text",
		"type" => "text",
		"tab" => "header"
	),
	array( "name" => "Logo",
		"desc" => "Here you can upload your logo which will be shown in the header.",
		"id" => THEME_SLUG ."_logo",
		"type" => "upload",
		"tab" => "header"
	),
	array( "name" => "Logo Title",
		"desc" => "Here you can set the title for your logo.",
		"id" => THEME_SLUG ."_logotitle",
		"type" => "text",
		"tab" => "header"
	),
	array( "name" => "Enable Menu Contact Button?",
		"desc" => "Please select if you want to enable or disable the header contact button. If you select <b>'No'</b> the button won't be shown.",
		"id" => THEME_SLUG ."_header_contact",
		"type" => "checkbox",
		"tab" => "header"
	),
	array( "name" => "Menu Contact E-mail Address",
		"desc" => "Please provide your e-mail address which will be displayed in the Header Contact Button.",
		"id" => THEME_SLUG ."_email",
		"type" => "text",
		"tab" => "header"
	),
	/* Theme */
	array( "name" => "Enable Theme Notification Update? <span>(recommended)</span>",
		"desc" => "Please select if you want to enable or disable theme notification updates. If you enable this setting you will receive a notification when there is a new update available for  " . THEME_NAME . ". If you select <b>'No'</b> the theme notifications won't be shown. ",
		"id" => THEME_SLUG ."_update",
		"type" => "checkbox",
		"tab" => "theme",
	),
	// array( "name" => "Enable Responsive Design?",
	// 	"desc" => "Please select if you want to enable or disable responsive design. If you select 'No' your website won't be responsive and won't scale on devices like a smartphone or a tablet.",
	// 	"id" => THEME_SLUG ."_responsive_design",
	// 	"type" => "checkbox",
	// 	"tab" => "theme"
	// ),
	array( "name" => "Content Designer Options",
		"desc" => "Below you can find the Content Designer options.",
		"id" => THEME_SLUG ."_messagebox",
		"type" => "message_box",
		"tab" => "theme"
	),
	array( "name" => "Content Designer Row",
		"desc" => "Enable or disable the Content Designer row to be collapsed. If you enable this the row will be collapsed on default.",
		"id" => THEME_SLUG ."_contentdesigner_row",
		"type" => "checkbox",
		"tab" => "theme"
	),
	/* Sidebars */
	array( "name" => "Sidebars",
		"desc" => "On the left you see all the created sidebars. Please note that you can't remove the default sidebars; 'Footer Sidebar' & 'Normal Sidebar'.",
		"id" => THEME_SLUG ."_sidebar_list",
		"type" => "sidebar_list",
		"tab" => "sidebar"
	),
	array( "name" => "Add A Sidebar",
		"desc" => "Add a sidebar. Specify a name and click 'Add Sidebar'. Please don't forget to save to options!",
		"id" => THEME_SLUG ."_sidebar_add",
		"type" => "sidebar_add",
		"tab" => "sidebar"
	),

	/* Social Media */
	array( "name" => "Advanced Twitter API Settings",
		"desc" => "Specify your Twitter API Settings. Please check <a href='https://dev.twitter.com/apps'>https://dev.twitter.com/apps</a> for more information.",
		"id" => THEME_SLUG ."_messagebox",
		"type" => "message_box",
		"tab" => "socialmedia"
	),	
	array( "name" => "Twitter Consumer key",
		"desc" => "Specify your Twitter Consumer key",
		"id" => THEME_SLUG ."_twitter_api_cons_key",
		"type" => "text",
		"tab" => "socialmedia"
	),			
	array( "name" => "Twitter Consumer secret",
		"desc" => "Specify your Twitter Consumer secret",
		"id" => THEME_SLUG ."_twitter_api_cons_sec",
		"type" => "text",
		"tab" => "socialmedia"
	),	
	array( "name" => "Twitter Access token",
		"desc" => "Specify your Twitter Access token",
		"id" => THEME_SLUG ."_twitter_api_acc_token",
		"type" => "text",
		"tab" => "socialmedia"
	),
	array( "name" => "Twitter Access token secret",
		"desc" => "Specify your Twitter Access token secret",
		"id" => THEME_SLUG ."_twitter_api_acc_token_sec",
		"type" => "text",
		"tab" => "socialmedia"
	),


	array(
		"name" => "Apple <span class='moveright'>Display icons in</span>",
		"id" => "apple",
		"icon" => "e054",
		"type" => "socialmedia",
		"desc" => "Specify your Apple URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_apple_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_apple_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_apple_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Dribbble",
		"id" => "dribbble",
		"icon" => "e041",
		"type" => "socialmedia",
		"desc" => "Specify your Dribbble URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_dribbble_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_dribbble_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_dribbble_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Facebook",
		"id" => "facebook",
		"icon" => "e028",
		"type" => "socialmedia",
		"desc" => "Specify your Facebook URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_facebook_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_facebook_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_facebook_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Flickr",
		"id" => "flickr-2",
		"icon" => "e03b",
		"type" => "socialmedia",
		"desc" => "Specify your Flickr URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_flickr-2_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_flickr-2_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_flickr-2_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Forrst",
		"id" => "forrst",
		"icon" => "e044",
		"type" => "socialmedia",
		"desc" => "Specify your Forrst URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_forrst_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_forrst_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_forrst_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Github",
		"id" => "github",
		"icon" => "e032",
		"type" => "socialmedia",
		"desc" => "Specify your Github URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_github_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_github_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_github_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Google Drive",
		"id" => "google-drive",
		"icon" => "e027",
		"type" => "socialmedia",
		"desc" => "Specify your Google Drive URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_google-drive_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_google-drive_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_google-drive_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Google Plus",
		"id" => "google-plus",
		"icon" => "e032",
		"type" => "socialmedia",
		"desc" => "Specify your Google Plus URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_google-plus_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_google-plus_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_google-plus_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Instagram",
		"id" => "instagram",
		"icon" => "e02b",
		"type" => "socialmedia",
		"desc" => "Specify your Instagram URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_instagram_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_instagram_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_instagram_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Linkedin",
		"id" => "linkedin",
		"icon" => "e060",
		"type" => "socialmedia",
		"desc" => "Specify your Linkedin URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_linkedin_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_linkedin_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_linkedin_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Picasa",
		"id" => "picassa",
		"icon" => "e03e",
		"type" => "socialmedia",
		"desc" => "Specify your Picasa URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_picassa_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_picassa_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_picassa_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Pinterest",
		"id" => "pinterest",
		"icon" => "e06a",
		"type" => "socialmedia",
		"desc" => "Specify your Pinterest URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_pinterest_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_pinterest_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_pinterest_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "RSS",
		"id" => "feed-2",
		"icon" => "e02f",
		"type" => "socialmedia",
		"desc" => "Specify your RSS URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_feed-2_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_feed-2_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_feed-2_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Stackoverflow",
		"id" => "stackoverflow",
		"icon" => "e066",
		"type" => "socialmedia",
		"desc" => "Specify your Stackoverflow URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_stackoverflow_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_stackoverflow_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_stackoverflow_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Stumbleupon",
		"id" => "stumbleupon",
		"icon" => "e061",
		"type" => "socialmedia",
		"desc" => "Specify your Stumbleupon URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_stumbleupon_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_stumbleupon_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_stumbleupon_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Tumblr",
		"id" => "tumblr",
		"icon" => "e057",
		"type" => "socialmedia",
		"desc" => "Specify your Tumblr URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_tumblr_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_tumblr_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_tumblr_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Twitter",
		"id" => "twitter",
		"icon" => "e02c",
		"type" => "socialmedia",
		"desc" => "Specify your Twitter URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_twitter_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_twitter_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_twitter_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Vimeo",
		"id" => "vimeo",
		"icon" => "e034",
		"type" => "socialmedia",
		"desc" => "Specify your Vimeo URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_vimeo_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_vimeo_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_vimeo_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "WordPress",
		"id" => "wordpress",
		"icon" => "e05d",
		"type" => "socialmedia",
		"desc" => "Specify your WordPress URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_wordpress_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_wordpress_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_wordpress_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Yelp",
		"id" => "yelp",
		"icon" => "e03a",
		"type" => "socialmedia",
		"desc" => "Specify your Yelp URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_yelp_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_yelp_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_yelp_link",
				"type" => "socialmedia_text",
			)
		)
	),
	array(
		"name" => "Youtube",
		"id" => "youtube",
		"icon" => "e038",
		"type" => "socialmedia",
		"desc" => "Specify your Youtube URL.",
		"tab" => "socialmedia",
		"sub_options" => array( 
			array(
				"id" => THEME_SLUG ."_youtube_header",
				"type" => "socialmedia_checkbox",
				"desc" => "Menu",
			),
			array(
				"id" => THEME_SLUG ."_youtube_widgets",
				"type" => "socialmedia_checkbox",
				"desc" => "Widgets",
			),
			array(
				"id" => THEME_SLUG ."_youtube_link",
				"type" => "socialmedia_text",
			)
		)
	),
	// /* Blog */
	// array(
	// 	"name" => "Enable Blogpost Image Overlay?",
	// 	"id" => THEME_SLUG . "_blogpost_overlay",
	// 	"type" => "checkbox",
	// 	"desc" => "Please select if you want to enable or disable the blogpost image overlay which will show on hover. If you select <b>'No'</b> the blogpost image overlay won't be shown on hover.",
	// 	"tab" => "blog",
	// ),
	// array(
	// 	"name" => "Blog Page",
	// 	"id" => THEME_SLUG . "_blog_page",
	// 	"type" => "select_pages",
	// 	"desc" => "Please select your blogpage. This blog page is the same blog page you have selected as 'Posts Page' in your Reading Settings of WordPress.",
	// 	"tab" => "blog",
	// ),
	/* Tools */
	array(
		"name" => "Backup Theme Options",
		"id" => THEME_SLUG . "x_backup_options",
		"type" => "backup",
		"desc" => "Use these buttons to backup and restore your options. When you select 'Backup Options' a backup will be created from the options you have right at this moment. When you select 'Restore Options' you can choose to restore the options.",
		"tab" => "tools"
	),
	array(
		"name" => "Export Theme Options",
		"id" => "export",
		"type" => "export",
		"desc" => "The data in the field contains all the options you have at the moment. You can save this to a text file and insert it in the option below to import your options again.",
		"tab" => "tools"
	),
	array(
		"name" => "Import Theme Options",
		"id" => "import",
		"type" => "import",
		"desc" => "Paste the code you saved in a text file from the option above in this field. Press 'Save all changes' to import your options.",
		"tab" => "tools"
	),

	/* Custom CSS */
	array( "name" => "Advanced CSS Customizations",
		"desc" => "Paste your custom CSS Code below. Please do <strong>not</strong> include HTML tags or any other tags.",
		"id" => THEME_SLUG ."_messagebox",
		"type" => "message_box",
		"tab" => "customcss"
	),	
	array( "name" => "CSS Code",
		"desc" => "Please insert your custom CSS code in this field.",
		"id" => THEME_SLUG ."_custom_css",
		"type" => "textarea",
		"tab" => "customcss"
	),
	/* Footer */
	array( "name" => "Footer Widget Columns",
		"desc" => "Select how many colums you want in the footer. Each column can contain one widget.",
   		"id" => THEME_SLUG ."_footer_widget_width",
   		"type" => "radio_images",
   		"options" => array('column-2', 'column-3', 'column-4', 'column-6'),
		"tab" => "footer"
	),
	array( "name" => "Enable Footer Copyright?",
		"desc" => "Please select if you want to enable or disable the footer copyright message. If you select <b>'No'</b> the copyright message won't be shown.",
		"id" => THEME_SLUG ."_footer_copyright",
		"type" => "checkbox",
		"tab" => "footer"
	),	
	array( "name" => "Footer Copyright Text",
		"desc" => "If the above option is enabled. Please specify your copyright message in this field.",
		"id" => THEME_SLUG ."_footer_copyright_text",
		"type" => "textarea",
		"tab" => "footer"
	),
	/* Style */
	array( "name" => "Theme General Color",
		"desc" => "This is the general color for your website.",
		"id" => THEME_SLUG ."_style_general_color",
		"type" => "colorpicker",
		"tab" => "style"
	),
	array( "name" => "Theme Second Color",
		"desc" => "This is the second color for your website, it's used for borders etc.",
		"id" => THEME_SLUG ."_style_second_color",
		"type" => "colorpicker",
		"tab" => "style"
	),
	array( "name" => "Background Color Overlay (Parallax and Header)",
		"desc" => "Here you can pick an overlay color for your background image. This color overlay will affect the header background image and parallax background image.",
		"id" => THEME_SLUG ."_style_bg_overlay_color",
		"type" => "colorpicker",
		"tab" => "style"
	),
	array( "name" => "Background Color Opacity (Parallax and Header)",
		"desc" => "Fill in the opacity of the overlay color. For example: 0.2.",
		"id" => THEME_SLUG ."_style_bg_overlay_opacity",
		"type" => "text",
		"tab" => "style"
	),
	/* Fonts */
		array( "name" => "Heading & Button Font",
		"desc" => "Select the font for all the headings and buttons.",
		"id" => THEME_SLUG ."_heading_font",
		"type" => "font_selector",
		"tab" => "font",
		"preview" => true
	),
	array( "name" => "Body Font",
		"desc" => "Select the font for the body.",
		"id" => THEME_SLUG ."_body_font",
		"type" => "font_selector",
		"tab" => "font",
		"preview" => true
	),
	array( "name" => "Menu Font",
		"desc" => "Select the font for the menu.",
		"id" => THEME_SLUG ."_menu_font",
		"type" => "font_selector",
		"tab" => "font",
		"preview" => true
	),
	array( 
		"name" => "Body Font Size",
		"desc" => "Select the font size for the body.",
		"id" => THEME_SLUG ."_body_fontsize",
		"type" => "text",
		"tab" => 'font',
		"std" => '11'
	),
	array( 
		"name" => "H1 - Heading Font Size",
		"desc" => "Select the font size for a H1 Heading.",
		"id" => THEME_SLUG ."_h1_fontsize",
		"type" => "text",
		"tab" => 'font',
		"std" => '24'
	),
	array( 
		"name" => "H2 - Heading Font Size",
		"desc" => "Select the font size for a H2 Heading.",
		"id" => THEME_SLUG ."_h2_fontsize",
		"type" => "text",
		"tab" => 'font',
		"std" => '18'
	),
	array( 
		"name" => "H3 - Heading Font Size",
		"desc" => "Select the font size for a H3 Heading.",
		"id" => THEME_SLUG ."_h3_fontsize",
		"type" => "text",
		"tab" => 'font',
		"std" => '16'
	),
	array( 
		"name" => "H4 - Heading Font Size",
		"desc" => "Select the font size for a H4 Heading.",
		"id" => THEME_SLUG ."_h4_fontsize",
		"type" => "text",
		"tab" => 'font',
		"std" => '14'
	),
	array( 
		"name" => "H5 - Heading Font Size",
		"desc" => "Select the font size for a H5 Heading.",
		"id" => THEME_SLUG ."_h5_fontsize",
		"type" => "text",
		"tab" => 'font',
		"std" => '14'
	),
	array( 
		"name" => "H6 - Heading Font Size",
		"desc" => "Select the font size for a H6 Heading.",
		"id" => THEME_SLUG ."_h6_fontsize",
		"type" => "text",
		"tab" => 'font',
		"std" => '12'
	),
);

?>