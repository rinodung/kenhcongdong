<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php
/** Check if slider is enabled */
if('' == themify_get('setting-header_slider_enabled') || 'on' == themify_get('setting-header_slider_enabled')) { ?>

	<?php themify_slider_before(); //hook ?>
	<div id="header-slider" class="pagewidth slider">
    	<?php themify_slider_start(); //hook ?>
			
		<ul class="slides clearfix">

    		<?php
    		// Get image width and height or set default dimensions
			$img_width = themify_check('setting-header_slider_width')?	themify_get('setting-header_slider_width'): '220';
			$img_height = themify_check('setting-header_slider_height')? themify_get('setting-header_slider_height'): '160';
			
			if(themify_check('setting-header_slider_posts_category')){
				$cat = "&cat=".themify_get('setting-header_slider_posts_category');	
			} else {
				$cat = "";
			}
			if(themify_check('setting-header_slider_posts_slides')){
				$num_posts = "showposts=".themify_get('setting-header_slider_posts_slides')."&";
			} else {
				$num_posts = "showposts=7&";	
			}
			if(themify_check('setting-header_slider_display') && themify_get('setting-header_slider_display') == "images"){ 
        		
				$options = array('one','two','three','four','five','six','seven','eight','nine','ten');
				foreach($options as $option){
					$option = 'setting-header_slider_images_'.$option;
					if(themify_check($option.'_image')){
						echo '<li>';
							$title = themify_check($option.'_title') ? themify_get($option.'_title') : '';
							$image = themify_get($option.'_image');
							$alt = $title? $title : $image;
							if(themify_check($option.'_link')){ 
								$link = themify_get($option.'_link');
								$title_attr = $title? "title='$title'" : "title='$image'";
								echo "<div class='slide-feature-image'><a href='$link' $title_attr>" . themify_get_image("src=".$image."&ignore=true&w=$img_width&h=$img_height&alt=$alt&class=feature-img") . '</a></div>';
								echo $title? '<div class="slide-content-wrap"><h3 class="slide-post-title"><a href="'.$link.'" '.$title_attr.'>'.$title.'</a></h3></div>' : '';
							} else {
								echo "<div class='slide-feature-image'>" . themify_get_image("src=".$image."&ignore=true&w=$img_width&h=$img_height&alt=".$alt."&class=feature-img") . '</div>';
								echo $title? '<div class="slide-content-wrap"><h3 class="slide-post-title">'.$title.'</h3></div>' : '';
							}
						echo '</li>';
					}
				}
			} else { 

				query_posts($num_posts.$cat); 
				
				if( have_posts() ) {
					
					while ( have_posts() ) : the_post();
						?>
						<?php $post_format = $themify->get_format_template(); ?>
                    	<li class="format-<?php echo $post_format; ?>">
							
							<?php if($post_format == 'video'): ?>
							<!-- post-video -->
								<?php echo $themify->get_video_embed(themify_get('video_url')); ?>
							<!-- /post-video -->
							<?php else: ?>
							<div class='slide-feature-image'>
								<a href="<?php echo $themify->get_featured_image_link(); ?>" title="<?php the_title_attribute(); ?>">
									<?php themify_image($themify->auto_featured_image."ignore=true&w=$img_width&h=$img_height&class=feature-img&alt=".get_the_title()); ?>
								</a>
							</div>
							<!-- /.slide-feature-image -->
							<?php endif; ?>

							<div class="slide-content-wrap">

								<?php if(themify_get('setting-header_slider_hide_title') != 'yes'): ?>
									<h3 class="slide-post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<?php endif; ?>
								
								<?php // Load audio player
								if($post_format == 'audio'): ?>
									<?php echo $themify->get_audio_player(themify_get('audio_url'), $post->ID); ?>
								<?php endif; ?>
								
								<?php if(themify_get('setting-header_slider_default_display') == 'content'): ?>
									<div class="slide-excerpt <?php echo $post_format; ?>-content">
									<?php the_content(); ?>
									</div>
								<?php elseif( ! themify_get('setting-header_slider_default_display') || themify_get('setting-header_slider_default_display') == 'none'): ?>
										<?php //none ?>
								<?php else: ?>
									<div class="slide-excerpt <?php echo $post_format; ?>-content">
									<?php the_excerpt(); ?>
									</div>
								<?php endif; ?>
									
							</div>
							<!-- /.slide-content-wrap -->
						
							<?php if($post_format == 'quote'): ?>
								<?php echo $themify->get_quote_author(themify_get('quote_author'), themify_get('quote_author_link')); ?>
							<?php endif; ?>
						
                 		</li>
               			<?php 
					endwhile; 
				}
				
				wp_reset_query();
				
			} 
			?>
		</ul>
	  	
        <?php themify_slider_end(); //hook ?>
	</div>
	<!-- /#slider -->
    <?php themify_slider_after(); //hook ?>
    
<?php } ?>