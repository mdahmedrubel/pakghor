<?php
global $event_post_query;
/*
	Template Name: Event Template
*/
get_header();
	$event_per_page = 5;
	if (function_exists('cs_get_option')) {
		$event_per_page = cs_get_option('event_per_page');
		$event_per_page = isset($event_per_page) ? $event_per_page : 5;
	}
	$args_event = array(
		'post_type'		=> 'pakghor_event',
		'post_status'	=> 'publish',
		'posts_per_page'	=> $event_per_page,
	);
?>
	<!-- event-page section-->
	<section id="event-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div id="main-content">
						<?php 
							$event_post_query 	= new WP_Query($args_event);
							if( $event_post_query -> have_posts() ):
								while ($event_post_query -> have_posts() ) : $event_post_query -> the_post();
									get_template_part( 'template-parts/content', 'event' );
								endwhile; wp_reset_postdata(); ?>
						<div class="post-pagination-area">
							<ul class="post-pagination">
								<?php pakghor_custom_pagination( $event_post_query ); ?>
							</ul>
							<!--post pagination-->
						</div><!--post pagination area-->
						<?php endif; ?>
					</div><!-- main-content -->
				</div>
				<div  class="col-md-4">
					<?php get_sidebar(); ?>
					<!-- sidebar -->
				</div>
			</div>
		</div><!-- container -->
	</section><!-- event-page section end-->
<?php get_footer();