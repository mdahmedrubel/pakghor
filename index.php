<?php get_header(); ?>
	<!-- blog-page section-->
	<section id="blog-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div id="main-content">
						<?php
							if ( have_posts() ) :

								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									 * Include the Post-Type-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'blogsidebar' );

								endwhile;

							else :
								get_template_part( 'template-parts/content', 'none' );

							endif;

							?>
						<?php 
							$args = array(
						    'prev_text' => '<i class="fa fa-angle-left"></i>',
						    'next_text' => '<i class="fa fa-angle-right"></i>',
						    'screen_reader_text'	=> ' ',
						    'type'			=> 'list'
						); 
					?>
						<div class="post-pagination-area">
							<ul class="post-pagination">
								<?php the_posts_pagination( $args ); ?>
							</ul>
						 </div>
					</div><!-- main-content -->
				</div>
				<div  class="col-md-4">
					<?php get_sidebar(); ?>
					<!-- sidebar -->
				</div>
			</div>
		</div><!-- container -->
	</section><!-- blog-page section end-->
<?php get_footer();