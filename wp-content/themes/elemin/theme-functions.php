<?php

/*
To add custom PHP functions to the theme, create a new 'custom-functions.php' file in the theme folder. 
They will be added to the theme automatically.
*/

/* 	Enqueue Stylesheets and Scripts
/***************************************************************************/
add_action('wp_enqueue_scripts', 'themify_theme_enqueue_scripts');
function themify_theme_enqueue_scripts(){

	///////////////////
	//Enqueue styles
	///////////////////
	
	//Themify base styling
	wp_enqueue_style( 'theme-style', get_bloginfo('stylesheet_url'), array(), wp_get_theme()->display('Version'));
	
	//Themify Media Queries CSS
	wp_enqueue_style( 'themify-media-queries', get_template_directory_uri() . '/media-queries.css');
	
	//User stylesheet
	if(is_file(TEMPLATEPATH . "/custom_style.css"))
		wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/custom_style.css');
	
	//prettyPhoto styles
	wp_enqueue_style( 'pretty-photo', get_template_directory_uri() . '/prettyPhoto.css');
	
	//Google Web Fonts embedding
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=OFL+Sorts+Mill+Goudy+TT:regular,italic');

	///////////////////
	//Enqueue scripts
	///////////////////

	//audio-player
	wp_enqueue_script( 'audio-player', get_template_directory_uri() . '/js/audio-player.js', array('jquery'), false, false );
	
	//prettyPhoto, lightbox script
	wp_enqueue_script( 'pretty-photo', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), false, true );
	
    //Carousel script
    wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), false, true );
	
	//Themify internal scripts
	wp_enqueue_script( 'theme-script',	get_template_directory_uri() . '/js/themify.script.js', array('jquery'), false, true );
	
	//Inject variable values in gallery script
	wp_localize_script( 'theme-script', 'themifyScript', array(
			'overlayTheme' => apply_filters('themify_overlay_gallery_theme', 'pp_default')
		)
	);
	
	//WordPress internal script to move the comment box to the right place when replying to a user
	if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' );
	
}

/**
 * Add JavaScript files if IE version is lower than 9
 * @package themify
 */
function themify_ie_enhancements(){
	echo '
<!-- media-queries.js -->
<!--[if lt IE 9]>
	<script src="' . get_template_directory_uri() . '/js/respond.js"></script>
<![endif]-->

<!-- html5.js -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
';
}
add_action( 'wp_head', 'themify_ie_enhancements' );

/**
 * Add viewport tag for responsive layouts
 * @package themify
 */
function themify_viewport_tag(){
	echo "\n".'<meta name="viewport" content="width=100%, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">'."\n";
}
add_action( 'wp_head', 'themify_viewport_tag' );

/**
 * Make IE behave like a standards-compliant browser 
 */
function themify_ie_standards_compliant() {
	echo "\n".'<!--[if lt IE 9]>
	<script src="http://s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script> 
	<![endif]-->'."\n";
}
add_action('wp_head', 'themify_ie_standards_compliant');

/* Custom Write Panels
/***************************************************************************/

	///////////////////////////////////////
	// Setup Write Panel Options
	///////////////////////////////////////
	
	// Post Meta Box Options
	$post_meta_box_options = array(
		
		// Layout
		array(
			  "name" 		=> "layout",	
			  "title" 		=> __('Sidebar Option', 'themify'), 	
			  "description" => "", 				
			  "type" 		=> "layout",			
			  "meta"		=> array(
					array("value" => "default", "img" => "images/layout-icons/default.png", "selected" => true),
					array("value" => "sidebar1", "img" => "images/layout-icons/sidebar1.png"),
					array("value" => "sidebar1 sidebar-left", "img" => "images/layout-icons/sidebar1-left.png"),
					array("value" => "sidebar-none", "img" => "images/layout-icons/sidebar-none.png")
				)
			),
	   	// Post Image
		array(
			  "name" 		=> "post_image",
			  "title" 		=> __('Featured Image', 'themify'),
			  "description" => "",
			  "type" 		=> "image",
			  "meta"		=> array()
			),
		// Featured Image Size
	array(
		'name'	=>	'feature_size',
		'title'	=>	__('Image Size', 'themify'),
		'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="admin.php?page=regenerate-thumbnails">Regenerated</a>', 'themify'),
		'type'		 =>	'featimgdropdown'
		),
		// Image Width
		array(
			  "name" 		=> "image_width",	
			  "title" 		=> __('Image Width', 'themify'), 
			  "description" => "", 				
			  "type" 		=> "textbox",			
			  "meta"		=> array("size"=>"small")			
			),
		// Image Height
		array(
			  "name" 		=> "image_height",	
			  "title" 		=> __('Image Height', 'themify'), 
			  "description" => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'), 				
			  "type" 		=> "textbox",			
			  "meta"		=> array("size"=>"small")			
			),
	   	// Video URL
		array(
			  "name" 		=> "video_url",
			  "title" 		=> __('Video URL', 'themify'),
			  "description" => __('For video post format (eg. youtube, vimeo embed url, etc.)', 'themify'),
			  "type" 		=> "textbox",
			  "meta"		=> array()
			),
	   	// Audio URL
		array(
			  "name" 		=> "audio_url",
			  "title" 		=> __('Audio URL', 'themify'),
			  "description" => __('For audio post format (eg. mp3)', 'themify'),
			  "type" 		=> "textbox",
			  "meta"		=> array()
			),
	   	// Quote Author
		array(
			  "name" 		=> "quote_author",
			  "title" 		=> __('Quote Author', 'themify'),
			  "description" => __('For quote post format', 'themify'),
			  "type" 		=> "textbox",
			  "meta"		=> array()
			),
	   	// Quote Author Link
		array(
			  "name" 		=> "quote_author_link",
			  "title" 		=> __('Quote Author Link', 'themify'),
			  "description" => __('For quote post format', 'themify'),
			  "type" 		=> "textbox",
			  "meta"		=> array()
			),
		// Link URL
		array(
			  "name" 		=> "link_url",	
			  "title" 		=> __('Link URL', 'themify'), 	
			  "description" => __('For link post format', 'themify'), 				
			  "type" 		=> "textbox",			
			  "meta"		=> array()			
			),
		// Hide Post Title
		array(
			  "name" 		=> "hide_post_title",	
			  "title" 		=> __('Hide Post Title', 'themify'),
			  "description" => "", 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									array("value" => "yes", "name" => __('Yes', 'themify')),
									array("value" => "no",	"name" => __('No', 'themify'))
								)			
			),
		// Unlink Post Title
		array(
			  "name" 		=> "unlink_post_title",	
			  "title" 		=> __('Unlink Post Title', 'themify'), 	
			  "description" => __('Unlink post title (it will display the post title without link)', 'themify'), 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									array("value" => "yes", "name" => __('Yes', 'themify')),
									array("value" => "no",	"name" => __('No', 'themify'))
								)			
			),

		// Hide Post Meta
		array(
			  "name" 		=> "hide_post_meta",	
			  "title" 		=> __('Hide Post Meta', 'themify'), 	
			  "description" => "", 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									array("value" => "yes", "name" => __('Yes', 'themify')),
									array("value" => "no",	"name" => __('No', 'themify'))
								)			
			),
		// Hide Post Date
		array(
			  "name" 		=> "hide_post_date",	
			  "title" 		=> __('Hide Post Date', 'themify'), 	
			  "description" => "", 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),
									array("value" => "yes", "name" => __('Yes', 'themify')),
									array("value" => "no",	"name" => __('No', 'themify'))
								)			
			),
		// Hide Post Image
		array(
			  "name" 		=> "hide_post_image",	
			  "title" 		=> __('Hide Featured Image', 'themify'), 	
			  "description" => "", 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),

									 array("value" => "yes", "name" => __('Yes', 'themify')),
									 array("value" => "no",	"name" => __('No', 'themify'))
									 )			
			),
			// Unlink Post Image
		array(
			  "name" 		=> "unlink_post_image",	
			  "title" 		=> __('Unlink Featured Image', 'themify'), 	
			  "description" => __('Display the Featured Image without link', 'themify'), 				
			  "type" 		=> "dropdown",			
			  "meta"		=> array(
			  						array("value" => "default", "name" => "", "selected" => true),

									 array("value" => "yes", "name" => __('Yes', 'themify')),
									 array("value" => "no",	"name" => __('No', 'themify'))
									 )			
			),
		// External Link
		array(
			  "name" 		=> "external_link",	
			  "title" 		=> __('External Link', 'themify'), 	
			  "description" => __('Link Featured Image to external URL', 'themify'), 				
			  "type" 		=> "textbox",			
			  "meta"		=> array()			
			),
		// Lightbox Link
		array(
			  "name" 		=> "lightbox_link",	
			  "title" 		=> __('Lightbox Link', 'themify'), 	
			  "description" => __('Link Featured Image to lightbox image, video or external iframe (<a href="http://themify.me/docs/lightbox">learn more</a>)', 'themify'), 				
			  "type" 		=> "textbox",			
			  "meta"		=> array()			
			)

	);
									
	// Page Meta Box Options
	$page_meta_box_options = array(
  	// Page Layout
	array(
		  "name" 		=> "page_layout",
		  "title"		=> __('Sidebar Option', 'themify'),
		  "description"	=> "",
		  "type"		=> "layout",
		  "meta"		=> array(
		  						array("value" => "default", "img" => "images/layout-icons/default.png", "selected" => true),
								array("value" => "sidebar1", 	"img" => "images/layout-icons/sidebar1.png"),
								array("value" => "sidebar1 sidebar-left", 	"img" => "images/layout-icons/sidebar1-left.png"),
								array("value" => "sidebar-none",	 	"img" => "images/layout-icons/sidebar-none.png")
							)
		),
	// Hide page title
	array(
		  "name" 		=> "hide_page_title",
		  "title"		=> __('Hide Page Title', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								 array("value" => "yes", "name" => __('Yes', 'themify')),
								 array("value" => "no",	"name" => __('No', 'themify'))
								 )	
		),
   // Query Category
	array(
		  "name" 		=> "query_category",
		  "title"		=> __('Query Category', 'themify'),
		  "description"	=> __('Select a category or enter multiple category IDs (eg. 2,5,6). Enter 0 to display all category.', 'themify'),
		  "type"		=> "query_category",
		  "meta"		=> array()
		),
	// Section Categories
	array(
		  "name" 		=> "section_categories",	
		  "title" 		=> __('Section Categories', 'themify'), 	
		  "description" => __('Display multiple query categories separately', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								array("value" => "yes", "name" => __('Yes', 'themify')),
								array("value" => "no",	"name" => __('No', 'themify'))
							)			
		),
	// Post Layout
	array(
		  "name" 		=> "layout",
		  "title"		=> __('Query Post Layout', 'themify'),
		  "description"	=> "",
		  "type"		=> "layout",
		  "meta"		=> array(
								array("value" => "list-post", "img" => "images/layout-icons/list-post.png", "selected" => true),
								array("value" => "grid4", "img" => "images/layout-icons/grid4.png"),
								array("value" => "grid3", "img" => "images/layout-icons/grid3.png"),
								array("value" => "grid2", "img" => "images/layout-icons/grid2.png")
							)
		),
	// Posts Per Page
	array(
		  "name" 		=> "posts_per_page",
		  "title"		=> __('Posts per page', 'themify'),
		  "description"	=> "",
		  "type"		=> "textbox",
		  "meta"		=> array("size" => "small")
		),
	
	// Display Content
	array(
		  "name" 		=> "display_content",
		  "title"		=> __('Display Content', 'themify'),
		  "description"	=> "",
		  "type"		=> "dropdown",
		  "meta"		=> array(
								array("name" => __('Full Content', 'themify'), "value"=>"content", "selected"=>true),
		  						array("name" => __('Excerpt', 'themify'), "value"=>"excerpt"),
								array("name" => __('None', 'themify'), "value"=>"none")
							)
		),
	// Featured Image Size
	array(
		'name'	=>	'feature_size_page',
		'title'	=>	__('Image Size', 'themify'),
		'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="admin.php?page=regenerate-thumbnails">Regenerated</a>', 'themify'),
		'type'		 =>	'featimgdropdown'
		),
	// Image Width
	array(
		  "name" 		=> "image_width",	
		  "title" 		=> __('Image Width', 'themify'), 
		  "description" => "", 				
		  "type" 		=> "textbox",			
		  "meta"		=> array("size"=>"small")			
		),
	// Image Height
	array(
		  "name" 		=> "image_height",	
		  "title" 		=> __('Image Height', 'themify'), 
		  "description" => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'), 				
		  "type" 		=> "textbox",			
		  "meta"		=> array("size"=>"small")			
		),
	// Hide Title
	array(
		  "name" 		=> "hide_title",
		  "title"		=> __('Hide Post Title', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								array("value" => "yes", "name" => __('Yes', 'themify')),
								array("value" => "no",	"name" => __('No', 'themify'))
							)
		),
	// Unlink Post Title
	array(
		  "name" 		=> "unlink_title",	
		  "title" 		=> __('Unlink Post Title', 'themify'), 	
		  "description" => __('Unlink post title (it will display the post title without link)', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								array("value" => "yes", "name" => __('Yes', 'themify')),
								array("value" => "no",	"name" => __('No', 'themify'))
							)			
		),
	// Hide Post Date
	array(
		  "name" 		=> "hide_date",
		  "title"		=> __('Hide Post Date', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								array("value" => "yes", "name" => __('Yes', 'themify')),
								array("value" => "no",	"name" => __('No', 'themify'))
							)
		),
	// Hide Post Meta
	array(
		  "name" 		=> "hide_meta",
		  "title"		=> __('Hide Post Meta', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								array("value" => "yes", "name" => __('Yes', 'themify')),
								array("value" => "no",	"name" => __('No', 'themify'))
							)
		),
	// Hide Post Image
	array(
		  "name" 		=> "hide_image",	
		  "title" 		=> __('Hide Featured Image', 'themify'), 	
		  "description" => "", 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								array("value" => "yes", "name" => __('Yes', 'themify')),
								array("value" => "no",	"name" => __('No', 'themify'))
							)			
		),
	// Unlink Post Image
	array(
		  "name" 		=> "unlink_image",	
		  "title" 		=> __('Unlink Featured Image', 'themify'), 	
		  "description" => __('Display the Featured Image without link', 'themify'), 				
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								array("value" => "yes", "name" => __('Yes', 'themify')),
								array("value" => "no",	"name" => __('No', 'themify'))
							)			
		),
	// Page Navigation Visibility
	array(
		  "name" 		=> "hide_navigation",
		  "title"		=> __('Hide Page Navigation', 'themify'),
		  "description"	=> "",
		  "type" 		=> "dropdown",			
		  "meta"		=> array(
		  						array("value" => "default", "name" => "", "selected" => true),
								array("value" => "yes", "name" => __('Yes', 'themify')),
								array("value" => "no",	"name" => __('No', 'themify'))
							)
		)
	
	);
		
	
	///////////////////////////////////////
	// Build Write Panels
	///////////////////////////////////////
	themify_build_write_panels(array(
				array(
					 "name"		=> __('Post Options', 'themify'),
					 "options"	=> $post_meta_box_options,
					 "pages"	=> "post"	
					 ),
				array(
					 "name"		=> __('Page Options', 'themify'),	
					 "options"	=> $page_meta_box_options, 		
					 "pages"	=> "page"
					 )
				)
			);
	
	
/* 	Custom Functions
/***************************************************************************/
	
	///////////////////////////////////////
	// Enable WordPress feature image
	///////////////////////////////////////
	add_theme_support( 'post-thumbnails' );
	remove_post_type_support( 'page', 'thumbnail' );

	///////////////////////////////////////
	// Add WordPress post formats
	///////////////////////////////////////
	add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );
	
	///////////////////////////////////////////////////////
	// Adds rel="prettyPhoto" to all linked image files
	///////////////////////////////////////////////////////
	add_filter('the_content', 'themify_addlightboxrel_replace', 12);
	add_filter('the_excerpt', 'themify_addlightboxrel_replace');
	add_filter('widget_text', 'themify_addlightboxrel_replace');
	add_filter('get_comment_text', 'themify_addlightboxrel_replace');
	function themify_addlightboxrel_replace ($content){
		global $post;
		$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
		$replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto['.$post->ID.']"$6>$7</a>';
		$content = preg_replace($pattern, $replacement, $content);
		return $content;
	}
	
	///////////////////////////////////////
	// Add wmode transparent and post-video container for responsive purpose
	///////////////////////////////////////	
	function themify_add_video_wmode_transparent($html, $url, $attr) {
		$services = array(
			'youtube.com',
			'youtu.be',
			'blip.tv',
			'vimeo.com',
			'dailymotion.com',
			'hulu.com',
			'viddler.com',
			'qik.com',
			'revision3.com',
			'wordpress.tv',
			'wordpress.com',
			'funnyordie.com'
		);
		$video_embed = false;
		foreach( $services as $service ){
			if(stripos($html, $service)){
				$video_embed = true;
				break;
			}
		}
		if( $video_embed ){
			$html = '<div class="post-video">' . $html . '</div>';
			if (strpos($html, "<embed src=" ) !== false) {
				$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
				return $html;
			}
			else {
				if(strpos($html, "wmode=transparent") == false){
					if(strpos($html, "?fs=" ) !== false){
						$search = array('?fs=1', '?fs=0');
						$replace = array('?fs=1&wmode=transparent', '?fs=0&wmode=transparent');
						$html = str_replace($search, $replace, $html);
						return $html;
					}
					else{
						$youtube_embed_code = $html;
						$patterns[] = '/youtube.com\/embed\/([a-zA-Z0-9._-]+)/';
						$replacements[] = 'youtube.com/embed/$1?wmode=transparent';
						return preg_replace($patterns, $replacements, $html);
					}
				}
				else{
					return $html;
				}
			}
		} else {
			return '<div class="post-embed">' . $html . '</div>';
		}
	}
	add_filter('embed_oembed_html', 'themify_add_video_wmode_transparent');

	///////////////////////////////////////
	// Filter RSS Feed to include Custom Fields
	///////////////////////////////////////
	add_filter('the_content', 'themify_post_format_custom_fields');
		
	function themify_post_format_custom_fields( $content ) {
	
		global $post, $id, $themify_check;
		if(!is_feed() || $themify_check == true){
			return $content;
		}
		$post_format = themify_get('post_format');
		
		if(has_post_format( 'image' ) && themify_check('post_image')) { 
			$content = "<img src='".themify_get('post_image')."'><br>".$content;
		} elseif(has_post_format( 'quote' ) && themify_check('quote_author')) {
			$content = '"'.$content.'" '.themify_get('quote_author')." - <a href='".themify_get('quote_author_link')."'>".themify_get('quote_author_link')."</a>";
		} elseif(has_post_format( 'link' ) && themify_check('link_url')) {
			$content .= "<a href='".themify_get('link_url')."'>".themify_get('link_url')."</a>";
		} elseif(has_post_format( 'audio' ) && themify_check('audio_url')) {
			$content = "<p><img src='".themify_get('post_image')."'></p><br>".$content;
			$content .= themify_get('audio_url');
		} elseif(has_post_format( 'video' ) && themify_check('video_url')) {
			$themify_check = true;
			$content = apply_filters('the_content', themify_get('video_url')) . $content;
		}
		$themify_check = false;
		return $content;
	}
		
	///////////////////////////////////////
	// Register Custom Menu Function
	///////////////////////////////////////
	function themify_register_custom_nav() {
		if (function_exists('register_nav_menus')) {
			register_nav_menus( array(
				'main-nav' => __( 'Main Navigation', 'themify' ),
				'footer-nav' => __( 'Footer Navigation', 'themify' ),
			) );
		}
	}
	
	// Register Custom Menu Function - Action
	add_action('init', 'themify_register_custom_nav');
	
	///////////////////////////////////////
	// Default Main Nav Function
	///////////////////////////////////////
	function themify_default_main_nav() {
		echo '<ul id="main-nav" class="main-nav">';
		wp_list_pages('title_li=');
		echo '</ul>';
	}

	///////////////////////////////////////
	// Register Sidebars
	///////////////////////////////////////
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => __('Sidebar 1', 'themify'),
			'id' => 'sidebar-main',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Sidebar 2A', 'themify'),
			'id' => 'sidebar-main-2a',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Sidebar 2B', 'themify'),
			'id' => 'sidebar-main-2b',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Sidebar 3', 'themify'),
			'id' => 'sidebar-main-3',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name' => __('Social Widget', 'themify'),
			'id' => 'social-widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<strong class="widgettitle">',
			'after_title' => '</strong>',
		));
	}

	///////////////////////////////////////
	// Footer Sidebars
	///////////////////////////////////////
	if ( function_exists('register_sidebar') ) {
		$data = themify_get_data();
		$columns = array('footerwidget-4col' 			=> 4,
						 'footerwidget-3col'			=> 3,
						 'footerwidget-2col' 			=> 2,
						 'footerwidget-1col' 			=> 1,
						 'none'			 			=> 0, );
		$option = ($data['setting-footer_widgets'] == "" || !isset($data['setting-footer_widgets'])) ?  "footerwidget-3col" : $data['setting-footer_widgets'];
		for($x=1;$x<=$columns[$option];$x++){
			register_sidebar(array(
				'name' => __('Footer Widget', 'themify') . ' ' .$x,
				'id' => 'footer-widget-'.$x,
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h4 class="widgettitle">',
				'after_title' => '</h4>',
			));			
		}
	}

	///////////////////////////////////////
	// Custom Theme Comment
	///////////////////////////////////////
	function themify_theme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; 
	   ?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<p class="comment-author">
				<?php echo get_avatar($comment,$size='68'); ?>
				<?php printf( '<cite>%s</cite>', get_comment_author_link()) ?><br />
				<time datetime="<?php comment_date('o-m-d'); ?>T<?php comment_time('H:i'); ?>" class="comment-time"><?php comment_date('M d, Y'); ?> @ <?php comment_time('H:i'); ?><?php edit_comment_link( __('Edit', 'themify'),' [',']') ?></time>
			</p>
			<div class="commententry">
				<?php if ($comment->comment_approved == '0') : ?>
				<p><em><?php _e('Your comment is awaiting moderation.', 'themify') ?></em></p>
				<?php endif; ?>
			
				<?php comment_text() ?>
			</div>
			<p class="reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'reply_text' => __( 'Reply' , 'themify' ), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
		<?php
	}
	
	// Themify Theme Key
	add_filter('themify_theme_key', create_function('$k', "return 'dvu44t2lkwixsn9axcdhqkv8j5oe4n5gu';"));
	
?>