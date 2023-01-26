<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package pakghor
 */

 get_header(); ?>
	<!-- blog-page section-->
	<section id="blog-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div id="main-content">
						<header class="page-header">
							<h1 class="page-title">
							<?php
							if ( have_posts() ) :
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'pakghor' ),get_search_query()); ?>
							</h1>
						</header><!-- .page-header -->
						<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );
							endwhile;
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;

							$args = array(
						    'prev_text' => '<i class="fa fa-angle-left"></i>Prev',
						    'next_text' => '<i class="fa fa-angle-right"></i>Next',
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
