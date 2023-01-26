<?php
/**
 * Duplicated and tweaked WP core widget class
 */
class Widget_Product_Category extends Pakghor_Widget {

    public function __construct()
    {
        parent::__construct( 'custom_pakghor_product_category', esc_html__( 'Pakghor :: Product Category', 'pakghor' ), array('description'	=> esc_html__('Add Product Category Widget','pakghor')) );
    }

    public function widget( $args, $instance )
    {
        echo wp_kses_post($args['before_widget']);
        echo wp_kses_post($args['before_title']). apply_filters( 'widget_title', $instance['title'] ) .$args['after_title']; 
	?>
							
							<div class="widget-content">
								<ul class="w-catagory">
									<?php $categories = get_terms( 'product_cat', array(
				                            'orderby'       => 'name',
				                            'hide_empty'    => true,
				                         ));
								if($categories) :
									foreach ($categories as $categorie):
				                $categorie_link = get_term_link( $categorie, $categorie->slug );
				                ?>
									<li>
										<a href="<?php echo esc_url($categorie_link) ?>"><?php echo esc_html($categorie->name) ?></a><span><?php echo esc_html($categorie->count) ?></span>
									</li>
								<?php endforeach; ?>
								<?php endif; ?>
								</ul><!-- w-catagory -->
							</div><!-- widget-content -->

<?php				

		echo wp_kses_post($args['after_widget']); 
    }

      	function get_options(){
            return array(

                array(
                    'id'        => 'title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Title', 'pakghor' ),
                    'default'	=> esc_html__( 'Food Category', 'pakghor' ),
                ),
		      
            );
        }
   
}
