<?php 
	// Event Single Template
	get_header();
?>
<?php
	$pakghor_event_speaker_title = $pakghor_event_speaker_name = $pakghor_event_speaker_image = $_pakghor_event_page_options = $pakghor_event_rating = '';
	if( function_exists('cs_get_option') ){
		$_pakghor_event_page_options		= get_post_meta( get_the_ID(), '_pakghor_event_page_options', true );
		$pakghor_event_speaker_title 		= isset( $_pakghor_event_page_options['pakghor_event_speaker_title']) ? $_pakghor_event_page_options['pakghor_event_speaker_title'] : '';
		$pakghor_event_speaker_name 		= isset( $_pakghor_event_page_options['pakghor_event_speaker_name']) ? $_pakghor_event_page_options['pakghor_event_speaker_name'] : '';
		$pakghor_event_speaker_image 		= isset( $_pakghor_event_page_options['pakghor_event_speaker_image']) ? $_pakghor_event_page_options['pakghor_event_speaker_image'] : '';
		$pakghor_event_speaker_image_src 		= wp_get_attachment_image_src( $pakghor_event_speaker_image, 'full' );
		$pakghor_event_speaker_image_alt   = get_post_meta( $pakghor_event_speaker_image, '_wp_attachment_image_alt', true );
		$pakghor_event_rating 			= isset( $_pakghor_event_page_options['pakghor_event_rating']) ? $_pakghor_event_page_options['pakghor_event_rating'] : '';
	}
?>
	<!-- event single page section-->
	<section id="event-single-page">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<?php while(have_posts()): the_post(); ?>
					<div class="main-content">
						<div class="post-single">
							<?php if( has_post_thumbnail() ) : ?>
							<div class="post-thumb">
								<a href="<?php the_permalink();?>"><?php the_post_thumbnail('pakghor-blog-770-370') ?></a>
							</div>
							<?php endif; ?>
							<div class="post-single-content">
								<h2 class="title"><?php the_title(); ?></h2>

								<?php if( !empty($pakghor_event_speaker_title) || !empty($pakghor_event_speaker_name) || !empty($pakghor_event_speaker_image_src) ) : ?>
								<div class="meta-post style-3">
									<ul>
										<?php if(!empty($pakghor_event_speaker_title) || !empty($pakghor_event_speaker_name) || !empty($pakghor_event_speaker_image_src) ) : ?>
										<li class="speaker">
											<?php if(!empty($pakghor_event_speaker_image_src)) : ?>
											<div class="speaker-img">
												<img src="<?php echo esc_url($pakghor_event_speaker_image_src[0]); ?>" alt="<?php echo esc_attr($pakghor_event_speaker_image_alt); ?>">
											</div>
											<?php endif ?>
											<?php if(!empty($pakghor_event_speaker_title) || !empty($pakghor_event_speaker_name) ) : ?>
											<div class="speaker-name">
												<?php if(!empty($pakghor_event_speaker_title)): ?>
												<h4><?php echo esc_html($pakghor_event_speaker_title); ?></h4>
												<?php endif; ?>
												<?php if(! empty($pakghor_event_speaker_name)) : ?>
												<h3><?php echo esc_html($pakghor_event_speaker_name); ?></h3>
												<?php endif; ?>
											</div>
											<?php endif; ?>
										</li>
										<?php endif; ?>
										<?php
										$event_category = wp_get_post_terms( get_the_ID(), 'event_category', array('hide_empty' => true) );
										if(! empty($event_category) ):
										?>
										<li class="post-catagory">
											<h4><?php echo esc_html__('Categories','pakghor'); ?></h4>
											<?php foreach ($event_category as $event_category_single ) : 
											$cat_link = get_term_link($event_category_single, $event_category_single->name );
											?>
											<h3><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($event_category_single->name); ?></a></h3>
											<?php endforeach ?>
										</li>
										<?php endif; ?>
										<?php if( !empty($pakghor_event_rating) ) : ?>
										<li class="post-rating">
											<h4><?php echo esc_html__('Review', 'pakghor') ?></h4>
											<div class="rating-star">
						            			<?php pakghor_review($pakghor_event_rating); // healper.php file; ?>
						            		</div><!-- rating star -->
										</li>
										<?php endif; ?>
									</ul>
								</div><!-- meta post -->
								<?php endif; ?>
								<?php the_content(); ?>
							</div>
						</div><!-- post-single -->
							<div class="tagandshare">
								<?php 
									$terms = wp_get_post_terms( get_the_ID(), 'event_tag', array('hide_empty' => true) );
							if($terms): ?>
							<div class="tags">
								<ul class="event-tag">
									<li class="ev-tag-title"><?php esc_html_e('Tags:', 'pakghor'); ?></li>
									<?php  foreach ($terms as $term ) : 
										$tag_link = get_term_link($term, $term->name );
									?>
										<li><a href="<?php echo esc_url($tag_link); ?>"><?php echo esc_html($term->name); ?></a></li>
									<?php endforeach; ?>
								</ul>
							</div><!-- tags -->
							<?php endif; ?>
							<?php if(function_exists('pakghor_event_social_share')): ?>
							<div class="social-profiles">
								<?php pakghor_event_social_share(); ?>
							</div>
							<?php endif; ?>
						</div><!-- tagandshare -->
					</div>
					<?php 
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; ?>
				</div>
				<div class="col-md-4">
					<?php get_sidebar(); ?> 
				</div> <!-- Sidebar -->
			</div>
		</div><!-- container -->
	</section><!-- event single page section end-->
<?php get_footer();