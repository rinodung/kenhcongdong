<?php if(!is_single()) { global $more; $more = 0; } //enable more link ?>
<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php themify_post_before(); //hook ?>

<!-- post -->
<article id="post-<?php the_ID(); ?>" <?php post_class("post clearfix " . $themify->get_categories_as_classes(get_the_ID())); ?>>
	
	<?php themify_post_start(); //hook ?>
	
	<span class="post-icon"></span><!-- /post-icon -->

	<!-- post-title -->
	<?php if($themify->hide_title != "yes"): ?>
		<?php themify_before_post_title(); // Hook ?>
		<?php if($themify->unlink_title == "yes"): ?>
			<h1 class="post-title"><?php the_title(); ?></h1>
		<?php else: ?>
			<h1 class="post-title"><a href="<?php echo $themify->link_post_format(); ?>"><?php the_title(); ?></a></h1>
		<?php endif; //unlink post title ?>
		<?php themify_after_post_title(); // Hook ?>
	<?php endif; //post title ?>    
	<!-- /post-title -->

	<!-- post-meta -->
	<p class="post-meta">
		<?php if($themify->hide_date != "yes"): ?>
			<time datetime="<?php the_time('o-m-d') ?>" class="post-date" pubdate><?php the_time(apply_filters('themify_loop_date', 'M j, Y')) ?></time>
		<?php endif; ?>

		<?php if($themify->hide_meta != 'yes'): ?>
				<span class="post-author"><em><?php _e( 'By', 'themify' ); ?></em> <?php the_author_posts_link(); ?></span>
				<span class="post-category"><em><?php _e( 'in', 'themify' ); ?></em> <?php the_category(', ') ?></span>
				<?php  if( !themify_get('setting-comments_posts') && comments_open() ) : ?>
					<span class="post-comment"><?php comments_popup_link(__('No Comments','themify'), __('1 Comment','themify'), __('% Comments','themify')); ?></span>
				<?php endif; //post comment ?>
				<?php the_tags(__(' <span class="post-tag"><em>Tags:</em> ','themify'), ', ', '</span>'); ?>
		<?php endif; ?>    
	</p>
	<!-- /post-meta -->
	
	<?php get_template_part('includes/loop-' . $themify->get_format_template()); ?>
	
	<?php edit_post_link(__('Edit', 'themify'), '[', ']'); ?>
	
    <?php themify_post_end(); //hook ?>
</article>
<!-- /post -->
<?php themify_post_after(); //hook ?>