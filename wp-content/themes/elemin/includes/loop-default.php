<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php
if( $post_image = themify_get_image($themify->auto_featured_image . $themify->image_setting . "w=".$themify->width."&h=".$themify->height) ){
	if($themify->hide_image != 'yes'): ?>
		<?php themify_before_post_image(); // Hook ?>
		<figure class="post-image <?php echo $themify->image_align; ?>">
			<?php if( 'yes' == $themify->unlink_image): ?>
				<?php echo $post_image; ?>
			<?php else: ?>
				<a href="<?php echo $themify->get_featured_image_link(); ?>"><?php echo $post_image; ?></a>
			<?php endif; ?>
		</figure>
		<?php themify_after_post_image(); // Hook ?>
	<?php endif; //post image
} ?>
<!-- /post-image -->

<!-- post-content -->
<div class="post-content">
	<?php if($themify->display_content == 'excerpt'): ?>
	
		<?php the_excerpt(); ?>
	
	<?php elseif($themify->display_content == 'none'): ?>
	
	<?php else: ?>
	
		<?php the_content(themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify')); ?>
	
	<?php endif; ?>
</div>
<!-- /post-content -->