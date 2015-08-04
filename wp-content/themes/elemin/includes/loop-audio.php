<?php 
/** Themify Default Variables
 *  @var object */
global $themify;
?>

<?php themify_image("field_name=post_image, image, wp_thumb&w=100&h=100&before=<p class='audio-image'><a href='".get_permalink()."'>&after=</a></p>"); ?>

<!-- audio-player -->
<div class="audio-player">
	<?php // Load audio player
	echo $themify->get_audio_player(themify_get('audio_url'), $post->ID); ?>
</div>
<!-- /audio-player -->

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