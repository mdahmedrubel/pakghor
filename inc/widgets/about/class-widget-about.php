<?php 

class Widget_About extends Pakghor_Widget
{
	public function __construct()
	{
		parent::__construct('Custom_About_Widget', esc_html__( 'Pakghor :: About & Payment Logo', 'pakghor' ) ,['description' => esc_html__( 'Add About on widget', 'pakghor')]);
	}

	public function widget($args, $instance)
	{ 

        echo wp_kses_post($args['before_widget']); 

			echo wp_kses_post($args['before_title'] ). apply_filters( 'widget_title',  $instance['about_title'] ) . $args['after_title']; 

            if ( !empty( $instance['about_content'] ) ) : ?>
                <div class="excerpt">
                    <?php echo wp_kses_post( $instance['about_content'] ); ?>
                </div>
            <?php endif; ?>
            
            <?php if ( !empty( $instance['button_text']) ): ?>
                <h2 class="footer-btn">
                    <a href="<?php echo esc_url($instance['button_url']); ?>"><?php echo esc_html($instance['button_text']) ?> <i class="fa fa-angle-double-right"></i></a>
                </h2>
            <?php endif; ?>
        
            <?php if( !empty($instance['payment_title']) || !empty($instance['payment_images']) ) : ?>
            <div class="payment-method">
                <?php if( !empty($instance['payment_title']) ) : ?>
                <h2><?php  echo esc_html($instance['payment_title']); ?></h2>
                <?php endif; ?>

                <?php if( !empty($instance['payment_images']) ) : ?>
                <ul>
            <?php   $img_ids = explode( ',', $instance['payment_images']);
                    $img_src = ''; 
                    $img_alt = '';
                    foreach ( $img_ids as $img_id ) :
                        $img_src = wp_get_attachment_image_src( $img_id, 'full' ); 
                        $img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
                    ?>
                        <li><img src="<?php echo esc_url($img_src['0']); ?>" alt="<?php echo (!empty($img_alt)) ? esc_attr($img_alt) : ''; ?>"></li>
            <?php   endforeach; ?>
                </ul>
                <?php endif; ?>
            </div><!-- payment-method -->
            <?php endif; ?>
<?php   echo wp_kses_post($args['after_widget']); 

	}

    	function get_options(){
            return array(

                array(
                    'id'        => 'about_title',
                    'type'      => 'text',
                    'title'     => esc_html__('About Title','pakghor'),
                    'default'   => esc_html__('About Us','pakghor')
                ),
                array(
                    'id'        => 'about_content',
                    'type'      => 'textarea',
                    'title'     => esc_html__('About Content','pakghor'),
                    'default'   => esc_html__('Efficiently atrix unique ecommerce ently enhance pallel results serdom anerment Proactvey incubate Authatively leverage existing effetive methodologies through client awesome theme.','pakghor'),
                    'desc'      => esc_html__('HTML tag allowed here.', 'pakghor'),

                ),
                array(
                    'id'        => 'button_text',
                    'type'      => 'text',
                    'title'     => esc_html__('Button Text','pakghor'),
                    'default'   => esc_html__('Read More','pakghor'),
                    'desc'      => esc_html__('If you do not want to show this field leave blank.','pakghor'),
                ),
                array(
                    'id'        => 'button_url',
                    'type'      => 'text',
                    'title'     => esc_html__('Button Url','pakghor'),
                    'default'   => esc_url('https://www.codexcoder.com/'),
                    'desc'      => esc_html__('If you do not want to show this field leave blank.','pakghor'),
                ),
                array(
                    'id'        => 'payment_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Payment Image Title','pakghor'),
                    'default'   => esc_html__('Payment Method','pakghor'),
                    'desc'      => esc_html__('If you do not want to show this field leave blank.','pakghor'),
                ),
                array(
                    'id'            => 'payment_images',
                    'type'          => 'gallery',
                    'title'         => esc_html__('Payment Images','pakghor'),
                    'add_title'     => esc_html__('Add Images', 'pakghor'),
                    'edit_title'    => esc_html__('Edit Images', 'pakghor'),
                    'clear_title'   => esc_html__('Remove Images', 'pakghor'),
                ),
            );
        }

}