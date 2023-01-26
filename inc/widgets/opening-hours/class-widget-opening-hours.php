<?php
/**
 * Duplicated and tweaked WP core widget class
 */
class Widget_Opening_Hours extends Pakghor_Widget {

    public function __construct()
    {
        parent::__construct( 'Pakghor_Opening_Hour_Widget', esc_html__( 'Pakghor :: Opening Hours', 'pakghor' ), array('description'	=> esc_html__('Add Opening Hour Widget','pakghor')) );
    }

    public function widget($args, $instance )
    {
        echo wp_kses_post($args['before_widget']);
        echo wp_kses_post($args['before_title']). apply_filters( 'widget_title', $instance['title'] ) .$args['after_title'];
            
        ?>

	        <div class="widget-content">
				<ul class="w-catagory open-hour">
					
					<?php if( !empty($instance['monday']) ) : ?>
					<li>
						<i class="fa fa-clock-o"></i><?php esc_html_e('Monday','pakghor') ?> <span><?php echo esc_html($instance['monday']); ?></span>
					</li>
					<?php endif; ?>

					<?php if( !empty($instance['tuesday']) ) : ?>
					<li>
						<i class="fa fa-clock-o"></i><?php esc_html_e('Tuesday','pakghor') ?><span><?php echo esc_html($instance['tuesday']); ?></span>
					</li>
					<?php endif; ?>

					<?php if( !empty($instance['wednesday']) ) : ?>
					<li>
						<i class="fa fa-clock-o"></i><?php esc_html_e('Wednesday','pakghor') ?> <span><?php echo esc_html($instance['wednesday']); ?></span>
					</li>
					<?php endif; ?>

					<?php if( !empty($instance['thursday']) ) : ?>
					<li>
						<i class="fa fa-clock-o"></i><?php esc_html_e('Thursday','pakghor') ?> <span><?php echo esc_html($instance['thursday']); ?></span>
					</li>
					<?php endif; ?>

					<?php if( !empty($instance['friday']) ) : ?>
					<li>
						<i class="fa fa-clock-o"></i><?php esc_html_e('Friday','pakghor') ?> <span><?php echo esc_html($instance['friday']); ?></span>
					</li>
					<?php endif; ?>

					<?php if( !empty($instance['saturday']) ) : ?>
					<li>
						<i class="fa fa-clock-o"></i><?php esc_html_e('Saturday','pakghor') ?> <span><?php echo esc_html($instance['saturday']); ?></span>
					</li>
					<?php endif; ?>

					<?php if( !empty($instance['sunday']) ) : ?>
					<li>
						<i class="fa fa-clock-o"></i><?php esc_html_e('Sunday','pakghor') ?> <span><?php echo esc_html($instance['sunday']); ?></span>
					</li>
					<?php endif; ?>

				</ul><!-- w-catagory -->
			</div><!-- widget-content -->
	             
<?php    echo wp_kses_post($args['after_widget']);

    }


    function get_options(){
        return array(

            array(
                'id'        => 'title',
                'type'      => 'text',
                'title'     => esc_html__('Title','pakghor'),
                'default'   => esc_html__('Opening Hours','pakghor')
            ),
            array(
                'id'        => 'monday',
                'type'      => 'text',
                'title'     => esc_html__('Monday','pakghor'),
                'default'   => esc_html__('9:30 am - 6:30 pm','pakghor')
            ),
            array(
                'id'        => 'tuesday',
                'type'      => 'text',
                'title'     => esc_html__('Tuesday','pakghor'),
                'default'   => esc_html__('9:30 am - 6:30 pm','pakghor')
            ),
            array(
                'id'        => 'wednesday',
                'type'      => 'text',
                'title'     => esc_html__('Wednesday','pakghor'),
                'default'   => esc_html__('9:30 am - 6:30 pm','pakghor')
            ),
            array(
                'id'        => 'thursday',
                'type'      => 'text',
                'title'     => esc_html__('Thursday','pakghor'),
                'default'   => esc_html__('9:30 am - 6:30 pm','pakghor')
            ),
            array(
                'id'        => 'friday',
                'type'      => 'text',
                'title'     => esc_html__('Friday','pakghor'),
                'default'   => esc_html__('9:30 am - 6:30 pm','pakghor')
            ),
            array(
                'id'        => 'saturday',
                'type'      => 'text',
                'title'     => esc_html__('Saturday','pakghor'),
                'default'   => esc_html__('9:30 am - 6:30 pm','pakghor')
            ),
            array(
                'id'        => 'sunday',
                'type'      => 'text',
                'title'     => esc_html__('Sunday','pakghor'),
                'default'   => esc_html__('Off day','pakghor')
            ),

        );
    }

}
