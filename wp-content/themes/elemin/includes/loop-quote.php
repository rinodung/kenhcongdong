<?php 
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<!-- quote-content -->
<div class="quote-content">
	
	<?php if($themify->display_content == 'excerpt'): ?>
	
		<?php the_excerpt(); ?>
	
	<?php elseif($themify->display_content == 'none'): ?>
	
	<?php else: ?>
	
		<?php the_content(themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify')); ?>
	
	<?php endif; ?>
</div>
<!-- /quote-content -->

<?php echo $themify->get_quote_author(themify_get('quote_author'), themify_get('quote_author_link')); ?>