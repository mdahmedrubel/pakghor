<?php
/**
 * Duplicated and tweaked WP core widget class
 */
class Widget_Latest_Product extends Pakghor_Widget {

    public function __construct()
    {
        parent::__construct( 'custom_pakghor_latest_product', esc_html__( 'Pakghor :: Latest Product', 'pakghor' ), array('description'	=> esc_html__('Add Latest Product Widget','pakghor')) );
    }

    public function widget( $args, $instance )
    {
        echo wp_kses_post($args['before_widget']);
        echo wp_kses_post($args['before_title']). apply_filters( 'widget_title', $instance['title'] ) .$args['after_title']; 
       
        				$categories = explode(',', $instance['category'] );
						$tags 		= explode(',', $instance['tag'] );
						if( !empty($instance['tag']) ) {
							$pakghor_latest_product_query  = new WP_Query( array(

									'post_type'			=> 'product',
									'post_status'		=> 'publish',
									'posts_per_page'	=> $instance['post_count'],
									'order'            	=> $instance['order'],
			                        'orderby'         	=> $instance['orderby'],
			                        'ignore_sticky_post'   =>  true,
			                        'tax_query'			=> array(
			                        		array(
			                        			'taxonomy' 	=> 'product_tag',
					                            'field' 	=> 'slug',
					                            'terms' 	=> $tags,
			                        		),

			                        	),
									) 
								);
						}elseif( !empty($instance['category']) ) {
							$pakghor_latest_product_query  = new WP_Query( array(
									'post_type'			=> 'product',
									'post_status'		=> 'publish',
									'posts_per_page'	=> $instance['post_count'],
									'order'            	=> $instance['order'],
			                        'orderby'         	=> $instance['orderby'],
			                        'ignore_sticky_post'   =>  true,
			                        'tax_query'			=> array(
			                        		array(
			                        			'taxonomy' 	=> 'product_cat',
					                            'field' 	=> 'slug',
					                            'terms' 	=> $categories,
			                        		),
			                        	),
									) 
								);
						}else{
							$pakghor_latest_product_query  = new WP_Query( array(
								'post_type'			=> 'product',
								'post_status'		=> 'publish',
								'posts_per_page'	=> $instance['post_count'],
								'order'            	=> $instance['order'],
		                        'orderby'         	=> $instance['orderby'],
		                        'ignore_sticky_post'   =>  true,
								) 
							);
						}
					?>
				<div class="widget-content">
						<ul class="widget-food-list">
				<?php if( $pakghor_latest_product_query -> have_posts() ) :
						while ( $pakghor_latest_product_query -> have_posts() ) : $pakghor_latest_product_query -> the_post();
							?>
							<li class="food-item">
								<?php if(has_post_thumbnail()) : ?>
								<div class="food-item-img">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail() ?></a>
								</div>
								<?php endif; ?>
								<div class="food-item-details">
									<div class="dotted-title">
										<div class="dotted-name">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</div>
										<div class="dotted-dot"></div>
										<div class="dotted-price">
                                			<span><?php  global $product; ?>
                                    	<?php  $price = $product->get_price_html(); echo wp_kses_post( $price ); ?></span>
                            			</div>
									</div><!-- dotted title -->
									<p><?php echo wp_trim_words( get_the_content(), isset($instance['pakghor_woocommerce_excerpt']) ? $instance['pakghor_woocommerce_excerpt'] : 5, '' ); ?></p>
									<?php 
	                                    global $product;
	                                    $woo_rating = $product->get_average_rating();
	                                if( $woo_rating > 0 ) :
	                                 ?>
	                                <div class="rating-star"><?php pakghor_review($woo_rating); ?>
	                                </div>
	                            	<?php endif; ?>
								</div><!-- food item details -->
							</li><!-- food-item -->
			<?php 	endwhile; wp_reset_postdata(); ?>
		<?php  endif; ?>
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
                    'title'     => esc_html__('Latest Product Title','pakghor'),
                    'default'	=> esc_html__('Latest Product', 'pakghor'),
                ),
               	array(
               		'id'			=> 'post_count',
		            'type'			=> 'number',
		            'title'			=> esc_html__( 'Latest Product Count', 'pakghor' ),
		            'default'		=> 4,
		            'desc'   		=> esc_html__( 'How many Posts want to display? Default is 4', 'pakghor' ),
	        	),
	        	array(
               		'id'			=> 'pakghor_woocommerce_excerpt',
		            'type'			=> 'number',
		            'title'			=> esc_html__( 'Product Short description word limit', 'pakghor' ),
		            'default'		=> 5,
		            'desc'   		=> esc_html__( 'The Word limit of Short description of the product, Default is 5', 'pakghor' ),
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
		            'title'   	=>  esc_html__('Product Order', 'pakghor' ),
		            'options'   => array(
		                'DESC' 		=> esc_html__( 'DESC','pakghor'),
						'ASC' 		=> esc_html__( 'ASC', 'pakghor' ),
		            ),
		            'default'  	=> 'DESC',
        		),
		        array(
		        	'id'			=> 'orderby',
		            'type'          => 'select',
		            'title'       	=> esc_html__( 'Product Order By', 'pakghor' ),
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