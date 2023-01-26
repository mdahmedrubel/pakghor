<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakghor
 */

?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
		<?php if( has_post_thumbnail() ) : ?>
		<div class="post-thumb">
			<?php pakghor_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<div class="post-content">
			<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
			<div class="meta-post style-2">
				<ul>
					<?php pakghor_posted_on();
					if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
						echo '<li class="post-comments"><i class="fa fa-commenting-o"></i>';
						comments_popup_link(
							sprintf(
								wp_kses(
									/* translators: %s: post title */
									__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'pakghor' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							)
						);
						echo '</li>';
					}
					?>
				</ul>
			</div><!-- meta post -->
	        <div class="excerpt">
	        	<?php the_excerpt(); ?>
	        </div>
			<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html__('Read More', 'pakghor'); ?></a>
		</div><!-- post content -->
	</div><!-- post item -->