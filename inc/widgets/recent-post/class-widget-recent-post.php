<?php
/**
 * Duplicated and tweaked WP core widget class
 */
class Widget_Recent_Post extends Pakghor_Widget {

    public function __construct()
    {
        parent::__construct( 'custom_pakghor_recent_post', esc_html__( 'Pakghor :: Recent Post', 'pakghor' ), array('description'	=> esc_html__('Add Recent Posts Widget','pakghor')) );
    }

    public function widget( $args, $instance )
    {
        echo wp_kses_post($args['before_widget']);
        echo wp_kses_post($args['before_title']). apply_filters( 'widget_title', $instance['title'] ) .$args['after_title']; ?>

        		<div class="widget-content pakghor-recent">
					<ul>
        		<?php	$categories = explode(',', $instance['category'] );
						$tags 		= explode(',', $instance['tag'] );

						if( !empty($instance['tag']) ) {

							$pakghor_recent_post_query  = new WP_Query( array(

									'post_type'			=> 'post',
									'post_status'		=> 'publish',
									'posts_per_page'	=> $instance['post_count'],
									'order'            	=> $instance['order'],
			                        'orderby'         	=> $instance['orderby'],
			                        'ignore_sticky_post'   =>  true,
			                        'tax_query'			=> array(
			                        		array(
			                        			'taxonomy' 	=> 'post_tag',
					                            'field' 	=> 'slug',
					                            'terms' 	=> $tags,
			                        		),

			                        	),
									) 
								);

						}elseif( !empty($instance['category']) ) {

							$pakghor_recent_post_query  = new WP_Query( array(

									'post_type'			=> 'post',
									'post_status'		=> 'publish',
									'posts_per_page'	=> $instance['post_count'],
									'order'            	=> $instance['order'],
			                        'orderby'         	=> $instance['orderby'],
			                        'ignore_sticky_post'   =>  true,
			                        'tax_query'			=> array(
			                        		array(
			                        			'taxonomy' 	=> 'category',
					                            'field' 	=> 'slug',
					                            'terms' 	=> $categories,
			                        		),

			                        	),
									) 
								);
						}else{

							$pakghor_recent_post_query  = new WP_Query( array(
								'post_type'			=> 'post',
								'post_status'		=> 'publish',
								'posts_per_page'	=> $instance['post_count'],
								'order'            	=> $instance['order'],
		                        'orderby'         	=> $instance['orderby'],
		                        'ignore_sticky_post'   =>  true,
								) 
							);
						}

						if( $pakghor_recent_post_query -> have_posts() ) :
						while ( $pakghor_recent_post_query -> have_posts() ) : $pakghor_recent_post_query -> the_post(); ?>
						<li class="post-item style-2">
							<?php if(has_post_thumbnail()) : ?>
							<div class="post-thumb">
								<a href="<?php the_permalink(); ?>">
      								<?php the_post_thumbnail(); ?>
      							</a>
							</div>
							<?php endif; ?>
							<div class="post-content">
								<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<div class="meta-post">
									<ul>
										<li class="post-comments">
											<a href="<?php echo esc_url(the_permalink()) ?>">
											<?php $pakghor_comment_count = get_comments_number();
												if ( '1' === $pakghor_comment_count ) {
													printf(
														/* translators: 1: title. */
														esc_html__( 'One Comment', 'pakghor' ),
														'<span>' . get_the_title() . '</span>'
													);
												} elseif('0' === $pakghor_comment_count){

													printf(
														/* translators: 1: title. */
														esc_html__( '0 Comment', 'pakghor' ),
														'<span>' . get_the_title() . '</span>'
													);

												} else {
													printf( // WPCS: XSS OK.
														/* translators: 1: comment count number, 2: title. */
														esc_html( _nx( '%1$s Comment', '%1$s Comments', $pakghor_comment_count, 'comments title', 'pakghor' ) ),
														number_format_i18n( $pakghor_comment_count ),
														'<span>' . get_the_title() . '</span>'
													);
												} ?>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</li><!-- post-item -->
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
					</ul>
				</div>
<?php
		echo wp_kses_post($args['after_widget']); 
    }

      function get_options(){
            return array(

                array(
                    'id'        => 'title',
                    'type'      => 'text',
                    'title'     => esc_html__('Recent Post Title','pakghor'),
                    'default'	=> esc_html__('Recent Post', 'pakghor'),
                ),
               	array(
               		'id'			=> 'post_count',
		            'type'			=> 'text',
		            'title'			=> esc_html__( 'Recent Post Count', 'pakghor' ),
		            'default'		=> 4,
		            'desc'   		=> esc_html__( 'How many Posts want to display? Default is 4', 'pakghor' ),
	        	),
		        array(
		        	'id'			=> 'category',
		            'type' 			=> 'text',
		            'title'       	=> esc_html__('Filter by Category slug:', 'pakghor'),
		            'desc'   		=> esc_html__('To filter by Category, enter category slugs here separated by comma (ex: cat1,cat2,cat3). Leave the field empty if you want to display the recent events', 'pakghor' ),
		        ),
		        array(
		        	'id'			=> 'tag',
		            'type' 			=> 'text',
		            'title'       	=> esc_html__('Filter by Tags slug:', 'pakghor'),
		            'desc'   		=> esc_html__('To filter by Tags, enter Tag slugs here separated by comma (ex: tag1,tag2,tag3). Leave the field empty if you want to display the recent events', 'pakghor' ),
		        ),
			    array(
				    'id'		=> 'order',
		            'type'      => 'select',
		            'title'   	=>  esc_html__('Post Order', 'pakghor' ),
		            'options'   => array(
		                'DESC' 		=> esc_html__( 'DESC','pakghor'),
						'ASC' 		=> esc_html__( 'ASC', 'pakghor' ),
		            ),
		            'default'  	=> 'DESC',
        		),
		        array(
		        	'id'			=> 'orderby',
		            'type'          => 'select',
		            'title'       	=> esc_html__( 'Post Order By', 'pakghor' ),
		            'options'      	=> array(
		                '' 				=> esc_html__( 'Select Latest Post Order by','pakghor' ),
		                'date'			=> esc_html__( 'Date', 'pakghor' ),
		                'name'			=> esc_html__( 'Name', 'pakghor' ),
		                'modified'		=> esc_html__( 'Modified', 'pakghor' ),
		                'author'		=> esc_html__( 'Author', 'pakghor' ),
		                'rand'			=> esc_html__( 'Random', 'pakghor' ),
		                'comment_count'	=> esc_html__( 'Comment Count', 'pakghor' ),

		            ),
		            'default'		=> 'date',
		        ),
		      
            );
        }
   
}
