<?php 
/** Themify Default Variables
 *  @var object */
global $themify;
?>

<!-- post-video -->
<?php echo $themify->get_video_embed(themify_get('video_url')); ?>
<!-- /post-video -->

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