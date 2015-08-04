<?php
/**
 * Main Themify class
 * @package themify
 */
class Themify {
	/** Default sidebar layout
	 * @var string */
	public $layout;
	/** Default posts layout
	 * @var string */
	public $post_layout;
	
	public $hide_title;
	public $hide_meta;
	public $hide_date;
	public $hide_image;
	
	public $unlink_title;
	public $unlink_image;
	
	public $display_content = '';
	public $auto_featured_image;
	
	public $width = '';
	public $height = '';
	
	public $avatar_size = 96;
	public $page_navigation;
	public $posts_per_page;
	
	public $image_align = '';
	public $image_setting = '';
	
	public $query_category = '';
	public $paged = '';
	
	/////////////////////////////////////////////
	// Set Default Image Sizes 					
	/////////////////////////////////////////////
	
	// Default Index Layout
	static $content_width = 990;
	static $sidebar1_content_width = 600;
	
	// Default Single Post Layout
	static $single_content_width = 990;
	static $single_sidebar1_content_width = 600;
	
	// Default Single Image Size
	static $single_image_width = 905;
	static $single_image_height = 400;
	
	// Grid4
	static $grid4_width = 225;
	static $grid4_height = 140;
	
	// Grid3
	static $grid3_width = 310;
	static $grid3_height = 180;
	
	// Grid2
	static $grid2_width = 480;
	static $grid2_height = 250;
	
	// List Large
	static $list_large_image_width = 680;
	static $list_large_image_height = 390;
	 
	// List Thumb
	static $list_thumb_image_width = 230;
	static $list_thumb_image_height = 200;
	
	// List Grid2 Thumb
	static $grid2_thumb_width = 120;
	static $grid2_thumb_height = 100;
	
	// List Post
	static $list_post_width = 905;
	static $list_post_height = 400;
	
	// Sorting Parameters
	public $order = 'DESC';
	public $orderby = 'date';

	function __construct() {
		
		///////////////////////////////////////////
		//Global options setup
		///////////////////////////////////////////
		$this->layout = themify_get('setting-default_layout');
		if($this->layout == '' ) $this->layout = 'sidebar1'; 
		
		$this->post_layout = themify_get('setting-default_post_layout');
		if($this->post_layout == '') $this->post_layout = 'list-post'; 
		
		$this->page_title = themify_get('setting-hide_page_title');
		$this->hide_title = themify_get('setting-default_post_title');
		$this->unlink_title = themify_get('setting-default_unlink_post_title');
		
		$this->hide_image = themify_get('setting-default_post_image');
		$this->unlink_image = themify_get('setting-default_unlink_post_image');
		$this->auto_featured_image = !themify_check('setting-auto_featured_image')? 'field_name=post_image, image, wp_thumb&' : '';
		
		$this->hide_meta = themify_get('setting-default_post_meta');
		$this->hide_date = themify_get('setting-default_post_date');
		
		$this->display_content = themify_get('setting-default_layout_display');
		$this->avatar_size = apply_filters('themify_author_box_avatar_size', 96);
		
		add_action('template_redirect', array(&$this, 'template_redirect'));
	}

	function template_redirect() {
		
		$post_image_width = themify_get('image_width');
		$post_image_height = themify_get('image_height');
		
		if( is_page() ) {
			$this->post_layout = (themify_get('layout') != "default" && themify_check('layout')) ?
									themify_get('layout') : themify_get('setting-default_post_layout');
			// set default post layout
			if($this->post_layout == '')
				$this->post_layout = 'list-post';
		}
		
		///////////////////////////////////////////
		// Setting image width, height
		///////////////////////////////////////////
		if($this->post_layout == 'grid4'):
		
			$this->width = self::$grid4_width;
			$this->height = self::$grid4_height;
		
		elseif($this->post_layout == 'grid3'):
		
			$this->width = self::$grid3_width;
			$this->height = self::$grid3_height;
		
		elseif($this->post_layout == 'grid2'):
		
			$this->width = self::$grid2_width;
			$this->height = self::$grid2_height;
			
		elseif($this->post_layout == 'list-large-image'):
		
			$this->width = self::$list_large_image_width;
			$this->height = self::$list_large_image_height;
		
		elseif($this->post_layout == 'list-thumb-image'):
		
			$this->width = self::$list_thumb_image_width;
			$this->height = self::$list_thumb_image_height;
		
		elseif($this->post_layout == 'grid2-thumb'):
		
			$this->width = self::$grid2_thumb_width;
			$this->height = self::$grid2_thumb_height;
			
		elseif($this->post_layout == 'list-post'):
		
			$this->width = self::$list_post_width;
			$this->height = self::$list_post_height;
		
		else:
					
			$this->width = self::$list_post_width;
			$this->height = self::$list_post_height;
			
		endif;
		
		if( is_page() ) {
			if(get_query_var('paged')):
				$this->paged = get_query_var('paged');
			elseif(get_query_var('page')):
				$this->paged = get_query_var('page');
			else:
				$this->paged = 1;
			endif;
			$this->query_category = themify_get('query_category');
			
			$this->layout = (themify_get('page_layout') != 'default' && themify_check('page_layout')) ? themify_get('page_layout') : themify_get('setting-default_page_layout');
			if($this->layout == '')
				$this->layout = 'sidebar1'; 
			
			$this->post_layout = (themify_get('layout') != 'default' && themify_check('layout')) ? themify_get('layout') : themify_get('setting-default_post_layout');
			if($this->post_layout == '')
				$this->post_layout = 'list-post';
			
			$this->page_title = (themify_get('hide_page_title') != 'default' && themify_check('hide_page_title')) ? themify_get('hide_page_title') : themify_get('setting-hide_page_title'); 
			$this->hide_title = themify_get('hide_title'); 
			$this->unlink_title = themify_get('unlink_title'); 
			$this->hide_image = themify_get('hide_image'); 
		    $this->unlink_image = themify_get('unlink_image'); 
			$this->hide_meta = themify_get('hide_meta'); 
			$this->hide_date = themify_get('hide_date'); 
			$this->display_content = themify_get('display_content');
			$this->post_image_width = themify_get('image_width'); 
			$this->post_image_height = themify_get('image_height'); 
			$this->page_navigation = themify_get('hide_navigation'); 
			$this->posts_per_page = themify_get('posts_per_page');
			
			if( '' != $post_image_height && '' != $post_image_width) {
				$this->width = $post_image_width;
				$this->height = $post_image_height;
			}
			
		}

		if( is_single() ) {
			$this->hide_title = (themify_get('hide_post_title') != 'default' && themify_check('hide_post_title')) ? themify_get('hide_post_title') : themify_get('setting-default_page_post_title');
			$this->unlink_title = (themify_get('unlink_post_title') != 'default' && themify_check('unlink_post_title')) ? themify_get('unlink_post_title') : themify_get('setting-default_page_unlink_post_title');
			$this->hide_date = (themify_get('hide_post_date') != 'default' && themify_check('hide_post_date')) ? themify_get('hide_post_date') : themify_get('setting-default_page_post_date');
			$this->hide_meta = (themify_get('hide_post_meta') != 'default' && themify_check('hide_post_meta')) ? themify_get('hide_post_meta') : themify_get('setting-default_page_post_meta');
			$this->hide_image = (themify_get('hide_post_image') != 'default' && themify_check('hide_post_image')) ? themify_get('hide_post_image') : themify_get('setting-default_page_post_image');
			$this->unlink_image = (themify_get('unlink_post_image') != 'default' && themify_check('unlink_post_image')) ? themify_get('unlink_post_image') : themify_get('setting-default_page_unlink_post_image');
			
			$this->layout = (themify_get('layout') == 'sidebar-none'
							|| themify_get('layout') == 'sidebar1'
							|| themify_get('layout') == 'sidebar1 sidebar-left'
							|| themify_get('layout') == 'sidebar2') ?
								themify_get('layout') : themify_get('setting-default_page_post_layout');
			 // set default layout
			 if($this->layout == '')
			 	$this->layout = 'sidebar1';
			
			$this->display_content = '';
			
			$this->post_image_width = themify_get('image_width');
			$this->post_image_height = themify_get('image_height');
			
			// Set Default Image Sizes for Single
			self::$content_width = self::$single_content_width;
			self::$sidebar1_content_width = self::$single_sidebar1_content_width;
			
			if( '' == $post_image_height && '' == $post_image_width){
				$this->width  = self::$single_image_width;
				$this->height = self::$single_image_height;
			} else {
				$this->width  = $post_image_width;
				$this->height = $post_image_height;
			}
		}
		$this->height = ('' == $this->height)? 0: $this->height;
		if($this->layout == 'sidebar1' || $this->layout == 'sidebar1 sidebar-left') {
			$ratio = $this->width / self::$content_width;
			$aspect = $this->height / $this->width;
			$this->width = round($ratio * self::$sidebar1_content_width);
			if($this->height != '' && $this->height != 0)
				$this->height = round($this->width * $aspect);
		}
		
		if(is_single() && $this->hide_image != 'yes') {
			$this->image_align = themify_get('setting-image_post_single_align');
			$this->image_setting = 'setting=image_post_single&';
		} elseif($this->query_category != '' && $this->hide_image != 'yes') {
			$this->image_align = '';
			$this->image_setting = '';
		} else {
			$this->image_align = themify_get('setting-image_post_align');
			$this->image_setting = 'setting=image_post&';
		}
		
	}
	
	/**
	 * Returns post category IDs concatenated in a string
	 * @param number Post ID
	 * @return string Category IDs
	 */
	public function get_categories_as_classes($post_id){
		$categories = wp_get_post_categories($post_id);
		$class = '';
		foreach($categories as $cat)
			$class .= ' cat-'.$cat;
		return $class;
	}
	 
	/**
	 * Returns escaped URL for featured image link
	 * @return string 
	 */
	public function get_featured_image_link(){
		if ( themify_get('external_link') != ''):
			$link = esc_url(themify_get('external_link'));
		elseif ( themify_get('lightbox_link') != ''):
			$link = esc_url(themify_get('lightbox_link')) . '" class="lightbox" rel="prettyPhoto[post]';
		else:
			$link = get_permalink();
		endif;
		return $link;
	}
	 
	 /**
	  * Returns category description
	  * @return string
	  */
	function get_category_description(){
	 	$category_description = category_description();
		if ( !empty( $category_description ) ){
			return '<div class="category-description">' . $category_description . '</div>';
		}
	}
	 
	 /**
	  * Returns logo image
	  * @param string
	  * @return string
	  */
	function logo_image($location = 'site_logo'){
		$html = '<a href="'.home_url().'" title="'.get_bloginfo('name').'">';
			$html .= themify_get_image("src=" . themify_get('setting-'.$location.'_image_value') . "&w=" . themify_get('setting-'.$location.'_width') . "&h=" . themify_get('setting-'.$location.'_height') . "&alt=" . urlencode(get_bloginfo('name')));
		$html .= '</a>';
		return apply_filters('themify_'.$location.'_image', $html);
	}

	/**
	 * Returns URL in link field for Link Post Format
	 * @param string
	 * @return string
	 */
	function link_post_format($meta = 'link_url'){
		$link = themify_get($meta);
		if ($link == '')
			$link = get_permalink();
		return $link;
	}
	
	/**
	 * Returns post format or 'default'
	 * @return string
	 */
	function get_format_template(){
		$post_format = themify_get('post_format');
		
		if($post_format == 'quote' || has_post_format( 'quote' )) {
			return 'quote';
		} elseif($post_format == 'audio' || has_post_format( 'audio' )) {
			return 'audio';
		} elseif($post_format == 'video' || has_post_format( 'video' )) {
			return 'video';
		} else {
			return 'default';
		}
	}

	function get_video_embed($src){
		if( $src != '') {
			global $wp_embed;
			return $wp_embed->run_shortcode('[embed]' . $src . '[/embed]');
		}
	}

	function get_audio_player($src, $post_id){
		$fallbackpl = '<a href="'.$src.'" title="' . __('Click to open', 'themify') . '" id="f-'.$post_id.'" style="display:none;">' . __('Audio MP3', 'themify') . '</a><script type="text/javascript">AudioPlayer.embed("f-'.$post_id.'", {soundFile: "'.$src.'"});</script>';
										
		if(strpos(strtolower($src),'.wav')) $format = 'wav';
		if(strpos(strtolower($src),'.m4a')) $format = 'm4a';
		if(strpos(strtolower($src),'.ogg')) $format = 'ogg';
		if(strpos(strtolower($src),'.oga')) $format = 'oga';
		if(strpos(strtolower($src),'.mp3')) $format = 'mp3';
		
		if(strpos($format, 'og')) $html5incompl = false; else $html5incompl = true;
		
		$output = '<div class="audio_wrap html5audio">';
		if ($html5incompl) $output .= '<div style="display:none;">'.$fallbackpl.'</div>';
		$output .= '<audio controls id="' . $post_id . '" class="html5audio">';
		
		if ($format == 'wav') $output .= '<source src="'.$src.'" type="audio/wav" />';
		if ($format == 'm4a') $output .= '<source src="'.$src.'" type="audio/mp4" />';
		if ($format == 'oga') $output .= '<source src="'.$src.'" type="audio/ogg" />';
		if ($format == 'ogg') $output .= '<source src="'.$src.'" type="audio/ogg" />';
		if ($format == 'mp3') $output .= '<source src="'.$src.'" type="audio/mpeg" />';
		
		$output .= $fallbackpl . '</audio></div>';
		
		if ($html5incompl)
			$output .= '<script type="text/javascript">if (jQuery.browser.mozilla) { tempaud=document.getElementsByTagName("audio")[0]; jQuery(tempaud).remove(); jQuery("div.audio_wrap div").show()
} else jQuery("div.audio_wrap div *").remove();</script>';
		return $output;
	}

	function get_quote_author($author, $link){
		$out = '<!-- quote-author -->';
		$out .= '<p class="quote-author">&#8212; ';
			 if($link != '') {	$out .= '<a href="'.$link.'">'; } $out .= $author; if($link != '') { $out .= '</a>'; }
		$out .= '</p>';
		$out .= '<!-- /quote-author -->';
		return $out;
	}
}

/**
 * Initializes Themify class
 */
function themify_global_options(){
	/**
	 * Themify initialization class
	 */
	global $themify;
	$themify = new Themify();
}
add_action( 'init','themify_global_options' );

?>