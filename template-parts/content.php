<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakghor
 */
?>
<div id="main-content">
	<div id="post-<?php the_ID(); ?>" <?php post_class('post-single'); ?>>
		<div class="post-single-content">
			<?php if( has_post_thumbnail() ) : ?>
			<div class="post-thumb">
				<?php pakghor_post_thumbnail(); ?>
			</div>
			<?php endif; ?>
			<div class="pak-single-post-cont">
			<?php
			if ( 'post' === get_post_type() ) :
				?>
			<div class="meta-post style-2">
				<ul>
					<?php 
						pakghor_posted_by();
						pakghor_posted_on(); 

					if (! post_password_required() && ( comments_open() || get_comments_number() ) ) {
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
			<?php endif; ?>
			<div class="pakghor-single-post-content">
			<?php
			if ( is_singular() ) :
				the_title( '<h2 class="entry-title">', '</h2>' );
			else :
				the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
			<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pakghor' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pakghor' ),
					'after'  => '</div>',
				) );
			?>
			</div>
		</div>
			<!-- .entry-content -->
		</div>
	<?php 	
		$tags_list = get_the_tag_list(); 
		if( $tags_list  || function_exists( 'pakghor_blog_social_share' ) ) :
	?>
		<div class="tagandshare">
			<?php if($tags_list) : ?>
			<div class="tags">
				<?php pakghor_entry_single_footer(); ?>
			</div>
		<?php endif; ?>
			<?php if(function_exists('pakghor_blog_social_share')): ?>
			<div class="social-profiles">
				<?php pakghor_blog_social_share() ?>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if( is_user_logged_in() ) : ?>
		<div class="tagandshare-edit">
		<?php 
			if( is_single() ){
					pakghor_edit_post_link();
				}
			?>
		</div>
		<?php endif; ?>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->