<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakghor
 */

?>
<div class="element-item  <?php pakghor_get_terms_link('gallery-category') ?>">
	<?php if( has_post_thumbnail() ) : ?>
	<div class="gallery-img">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
		<div class="gallery-item-overlay"></div>
		<div class="gallery-overlay-content">
			<div class="gallery-overlay-btn1">
				<?php 
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				 ?>
				<a href="<?php echo esc_url( $image[0] ); ?>" data-lightbox="foods"><i class="fa fa-search"></i></a>
			</div>
		</div><!-- gallery-overlay-content -->
	</div>
	<?php endif; ?>
</div>