<?php get_header(); ?>
	<!-- event single page section-->
	<section id="event-single-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div id="main-content">
					<?php
						while ( have_posts() ) : the_post(); 

							get_template_part('template-parts/content', 'services' );

						endwhile; 
					?>
					</div><!-- main-content -->
				</div>
				<div  class="col-md-4">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div><!-- container -->
	</section><!-- event single page section end-->
	<!-- Footer -->
<?php  get_footer();