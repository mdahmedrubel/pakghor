<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakghor
 */

?>
<div class="post-single">
	<?php if( has_post_thumbnail() ) : ?>
	<div class="post-thumb">
		<?php the_post_thumbnail();  ?>
	</div>
	<?php endif; ?>
	<div class="post-single-content">
		<h2 class="title"><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
</div><!-- post-single -->