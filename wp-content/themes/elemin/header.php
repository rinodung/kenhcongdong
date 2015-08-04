<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<?php
/** Themify Default Variables
 @var object */
	global $themify; ?>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>

<?php
/**
 *  Stylesheets and Javascript files are enqueued in theme-functions.php
 */
?>

<!-- wp_header -->
<?php wp_head(); ?>

<script type="text/javascript">
	AudioPlayer.setup("<?php echo get_template_directory_uri(); ?>/player.swf", {
		width: '90%',
		transparentpagebg: 'yes'
	});
</script>

</head>

<body <?php body_class(); ?>>

<?php themify_body_start(); //hook ?>
<div id="pagewrap">
    <div id="headerwrap">
    
    	<?php themify_header_before(); //hook ?>
        <header id="header">
        	<?php themify_header_start(); //hook ?>
    
            <hgroup>
                <?php if(themify_get('setting-site_logo') == 'image' && themify_check('setting-site_logo_image_value')){ ?>
                   <?php echo $themify->logo_image(); ?>
                <?php } else { ?>
                     <h1 id="site-logo"><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
                <?php } ?>
    
                <h2 id="site-description"><?php bloginfo('description'); ?></h2>
            </hgroup>
    
            <!-- social-widget --> 
            <div class="social-widget">
    
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('social-widget') ) ?>
    
                <?php if(!themify_check('setting-exclude_rss')): ?>
                    <div class="rss"><a href="<?php if(themify_get('setting-custom_feed_url') != ""){ echo themify_get('setting-custom_feed_url'); } else { echo bloginfo('rss2_url'); } ?>">RSS</a></div>
                <?php endif ?>
    
            </div>
            <!-- /social-widget --> 
    
            <div id="main-nav-wrap">
                <div id="menu-icon" class="mobile-button"></div>
                <nav>
                    <?php if (function_exists('wp_nav_menu')) {
                        wp_nav_menu(array('theme_location' => 'main-nav' , 'fallback_cb' => 'themify_default_main_nav' , 'container'  => '' , 'menu_id' => 'main-nav' , 'menu_class' => 'main-nav'));
                    } else {
                        themify_default_main_nav();
                    } ?>
                </nav>
                <!-- /main-nav -->
            </div>
            <!-- /#main-nav-wrap -->
        
            <div id="searchform-wrap">
                <div id="search-icon" class="mobile-button"></div>
				<?php if(!themify_check('setting-exclude_search_form')): ?>
                    <?php get_search_form(); ?>
                <?php endif ?>
            </div>
            <!-- /#searchform-wrap -->
            
			<?php themify_header_end(); //hook ?>
        </header>
        <!-- /header -->
        <?php themify_header_after(); //hook ?>
        
    </div>
    <!-- /headerwrap -->
	
	<div id="body" class="clearfix">
    <?php themify_layout_before(); //hook ?>
