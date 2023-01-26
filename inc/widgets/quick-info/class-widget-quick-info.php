<?php 
//Pakghor_Quick_Info
/**
 * Duplicated and tweaked WP core widget class
 */
class Widget_Quick_Info extends Pakghor_Widget {

    public function __construct()
    {
        parent::__construct( 'Pakghor_Quick_Info', esc_html__( 'Pakghor :: Quick Info', 'pakghor' ), array('description'	=> esc_html__('Add Quick Info Widget','pakghor')) );
    }

    public function widget($args, $instance )
    {
        echo wp_kses_post($args['before_widget']);
        echo wp_kses_post($args['before_title']). apply_filters( 'widget_title', $instance['title'] ) .$args['after_title'];
       
            $map_icon_image = wp_get_attachment_image_src($instance['map_icon_image'], 'full');

        ?>

	        <div class="widget-content">

	        	<div id="map" data-map-latitute="<?php echo esc_html( $instance['latitude'] ); ?>" data-map-longitude="<?php echo esc_html( $instance['longitude'] ); ?>" data-map-zoom="<?php echo esc_html( $instance['map_zoom'] ); ?>" data-map-icon="<?php echo esc_attr($map_icon_image['0']); ?>">
							</div>

				
				<?php if(! empty($instance['address']) || $instance['phone'] || $instance['email']): ?>
				<ul class="widget-contact-info">
					
					<?php if(! empty( $instance['address'] )): ?>
					<li><p><i class="fa fa-home"></i><?php echo esc_html__('Address','pakghor') ?></p><span>: <?php echo esc_html($instance['address']); ?></span></li>
					<?php endif; ?>

					<?php if(! empty( $instance['phone'] )): ?>
					<li><p><i class="fa fa-phone"></i><?php echo esc_html__('Phone','pakghor') ?></p><span>: <?php echo esc_html($instance['phone']); ?></span></li>
					<?php endif; ?>
					
					<?php if(! empty( $instance['email'] )): ?>
					<li><p><i class="fa fa-paper-plane"></i><?php echo esc_html__('Email','pakghor') ?></p><span>: <?php echo esc_html($instance['email']); ?></span></li>
					<?php endif; ?>

				</ul>
			<?php endif; ?>
			</div>
	             
<?php    echo wp_kses_post($args['after_widget']);

    }

    function get_options(){
            return array(

                array(
                    'id'        => 'title',
                    'type'      => 'text',
                    'title'     => esc_html__('Title','pakghor'),
                    'default'   => esc_html__('Our Quick Info','pakghor')
                ),
                array(
                    'id'        => 'address',
                    'type'      => 'textarea',
                    'title'     => esc_html__('Address','pakghor'),
                    'default'   => esc_html__('218 Shahera Topical Santar','pakghor')
                ),
                array(
                    'id'        => 'phone',
                    'type'      => 'text',
                    'title'     => esc_html__('Phone','pakghor'),
                    'default'   => esc_html__('+880 1923970212 - Office','pakghor')
                ),
                array(
                    'id'        => 'email',
                    'type'      => 'text',
                    'title'     => esc_html__('Email','pakghor'),
                    'default'   => esc_html__('support@example','pakghor')
                ),
                array(
                    'id'        =>'map_info',
                    'type'      => 'heading',
                    'content'   => esc_html__('Google Map Info', 'pakghor'),
                ),
                array(
                    'id'        => 'latitude',
                    'type'      => 'text',
                    'title'     => esc_html__('Google Map Latitude','pakghor'),
                    'default'   => esc_html__('23.7392846','pakghor')
                ),
                array(
                    'id'        => 'longitude',
                    'type'      => 'text',
                    'title'     => esc_html__('Google Map Longitude','pakghor'),
                    'default'   => esc_html__('90.3870695','pakghor')
                ),
                array(
                    'id'        => 'map_zoom',
                    'type'      => 'text',
                    'title'     => esc_html__('Map Zoom','pakghor'),
                    'default'   => 15,
                ),
                array(
                    'id'        => 'map_icon_image',
                    'type'      => 'image',
                    'title'     => esc_html__('Map Icon','pakghor')
                ),

            );
        }

}
