<?php
//Pakghor Contact Info
/**
 * Duplicated and tweaked WP core widget class
 */
class Widget_Contact_Info extends Pakghor_Widget {

    public function __construct()
    {
        parent::__construct( 'Pakghor_Contact_Info', esc_html__( 'Pakghor :: Contact Info', 'pakghor' ), array('description'	=> esc_html__('Add Contact Info Widget','pakghor')) );
    }

    public function widget($args, $instance )
    {
        echo wp_kses_post($args['before_widget']);
        echo wp_kses_post($args['before_title']). apply_filters( 'widget_title', $instance['title'] ) .$args['after_title'];
        ?>
			
		<ul>
            <?php if(! empty( $instance ['address_details'] )): ?>
			<li class="contact-item">
				<div class="contact-item-left">
					<span><?php echo esc_html($instance['address_title']); ?></span>
				</div>
				<div class="contact-item-right">
					<span><?php echo esc_html($instance['address_details']); ?></span>
				</div>
			</li><!-- contact-item -->
            <?php endif; ?>

            <?php if(! empty( $instance['phone_details'] )): ?>
			<li class="contact-item">
				<div class="contact-item-left">
					<span><?php echo esc_html($instance['phone_title']) ?></span>
				</div>
				<div class="contact-item-right">
					<span><?php echo esc_html($instance['phone_details']); ?></span>
				</div>
			</li><!-- contact-item -->
            <?php endif; ?>

            <?php if(! empty( $instance['email_details'] )): ?>
			<li class="contact-item">
				<div class="contact-item-left">
					<span><?php echo esc_html($instance['email_title']); ?></span>
				</div>
				<div class="contact-item-right">
					<span><?php echo esc_html($instance['email_details']); ?></span>
				</div>
			</li><!-- contact-item -->
            <?php endif; ?>
            
            
			<li class="contact-item">
                <?php if(!empty($instance['social_title'])): ?>
				<div class="contact-item-left">
					<span><?php echo esc_html($instance['social_title']); ?></span>
				</div>
                 <?php endif; ?>

                 <?php if(!empty($instance['facebook_link'])  || !empty($instance['google_plus_link']) || !empty($instance['twitter_link']) || !empty($instance['youtube_link']) || !empty($instance['pinterest_link']) || !empty($instance['linkedin_link']) || !empty($instance['rss_link']) || !empty($instance['instagram_link']) || !empty($instance['skyp_link']) || !empty($instance['vk_link']) || !empty($instance['xing_link']) || !empty($instance['tumblr_link'])|| !empty($instance['reddit_link'])|| !empty($instance['vimeo_link'])|| !empty($instance['telegram_link'])|| !empty($instance['yelp_link']) || !empty($instance['flickr_link']) || !empty($instance['whatsapp_link'])): 
                ?>

				<div class="social-profiles">
					<ul>
                        <?php if(!empty($instance['facebook_link'])): ?>
						<li><a href="<?php echo esc_url($instance['facebook_link']); ?>"><i class="fa fa-facebook"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['twitter_link'])): ?>
						<li><a href="<?php echo esc_url($instance['twitter_link']); ?>"><i class="fa fa-twitter"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['linkedin_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['linkedin_link']); ?>"><i class="fa fa-linkedin"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['google_plus_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['google_plus_link']); ?>"><i class="fa fa-google-plus"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['pinterest_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['pinterest_link']); ?>"><i class="fa fa-pinterest"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['youtube_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['youtube_link']); ?>"><i class="fa fa-youtube"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['rss_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['rss_link']); ?>"><i class="fa fa-rss"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['instagram_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['instagram_link']); ?>"><i class="fa fa-instagram"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['skyp_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['skyp_link']); ?>"><i class="fa fa-skype"></i></a></li>
                        <?php endif; ?>
                         <?php if(!empty($instance['vk_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['vk_link']); ?>"><i class="fa fa-vk"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['xing_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['xing_link']); ?>"><i class="fa fa-xing-square"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['tumblr_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['tumblr_link']); ?>"><i class="fa fa-tumblr"></i></a></li>
                        <?php endif; ?>
                         <?php if(!empty($instance['reddit_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['reddit_link']); ?>"><i class="fa fa-reddit-square"></i></a></li>
                        <?php endif; ?>
                        <?php if(!empty($instance['vimeo_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['vimeo_link']); ?>"><i class="fa fa-vimeo"></i></a></li>
                        <?php endif; ?>
                         <?php if(!empty($instance['telegram_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['telegram_link']); ?>"><i class="fa fa-telegram"></i></a></li>
                        <?php endif; ?>
                         <?php if(!empty($instance['yelp_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['yelp_link']); ?>"><i class="fa fa-yelp"></i></a></li>
                        <?php endif; ?>
                         <?php if(!empty($instance['flickr_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['flickr_link']); ?>"><i class="fa fa-flickr"></i></a></li>
                        <?php endif; ?>
                         <?php if(!empty($instance['whatsapp_link'])): ?>
                        <li><a href="<?php echo esc_url($instance['whatsapp_link']); ?>"><i class="fa fa-whatsapp"></i></a></li>
                        <?php endif; ?>
					</ul>
				</div><!-- Social profiles -->
                <?php endif; ?>
			</li><!-- contact-item -->
            
		</ul>

<?php    echo wp_kses_post($args['after_widget']);

    }

    function get_options(){
        return array(

            array(
                'id'        => 'title',
                'type'      => 'text',
                'title'     => esc_html__('Title','pakghor'),
                'default'   => esc_html__('Get In Touch','pakghor')
            ),
            array(
                'id'        => 'address_title',
                'type'      => 'text',
                'title'     => esc_html__( 'Address Title', 'pakghor' ),
                'default'   => esc_html__( 'Office Address', 'pakghor' )
            ),
            array(
                'id'        => 'address_details',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Address', 'pakghor' ),
                'default'   => esc_html__( 'Suite 02, Level 12, Sahera Tropical Center 218 New Elephant Road, Dhaka', 'pakghor')
            ),
            array(
                'id'        => 'phone_title',
                'type'      => 'text',
                'title'     => esc_html__( 'Phone Title', 'pakghor' ),
                'default'   => esc_html__( 'Phone Number', 'pakghor' )
            ),
            array(
                'id'        => 'phone_details',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Phone Number', 'pakghor' ),
                'default'   => esc_html__( 'Number +8801111111111 - Mobile 02-1234567- Calephone', 'pakghor')
            ),
            array(
                'id'        => 'email_title',
                'type'      => 'text',
                'title'     => esc_html__( 'Email Title', 'pakghor' ),
                'default'   => esc_html__( 'Email Address', 'pakghor' )
            ),
            array(
                'id'        => 'email_details',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Email', 'pakghor' ),
                'default'   => esc_html__( 'http://example.com support@example.com', 'pakghor')
            ),
            array(
                'id'        => 'section_heading',
                'type'      => 'heading',
                'content'   => esc_html__('Social Media Links', 'pakghor'),
            ),
            array(
                'id'        => 'social_title',
                'type'      => 'text',
                'title'     => esc_html__('Follow Us Title','pakghor'),
                'default'   => esc_html__('Follow Us','pakghor')
            ),
            array(
                'id'                => 'facebook_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Facebook:', 'pakghor' ),
                'default'           => '#'
            ),
            array(
                'id'                => 'twitter_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Twitter:', 'pakghor' ),
                'default'           => '#'
            ),
            array(
                'id'                => 'linkedin_link',
                'type'              => 'text',
                'title'             => esc_html__( 'LinkedIn:', 'pakghor' ),
                'default'           => '#'
            ),
            array(
                'id'                => 'google_plus_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Google Plus:', 'pakghor' ),
                'default'           => '#'
            ),
            array(
                'id'                => 'pinterest_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Pinterest:', 'pakghor' ),
                'default'           => '#'
            ),
            array(
                'id'                => 'youtube_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Youtube:', 'pakghor' ),
                'default'           => '#'
            ),
            array(
                'id'                => 'rss_link',
                'type'              => 'text',
                'title'             => esc_html__( 'RSS:', 'pakghor' ),
            ),
            array(
                'id'                => 'instagram_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Instagram:', 'pakghor' ),
            ),
            array(
                'id'                => 'skyp_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Skype:', 'pakghor' ),
            ),
            array(
                'id'                => 'vk_link',
                'type'              => 'text',
                'title'             => esc_html__( 'VK:', 'pakghor' ),
            ),
            array(
                'id'                => 'xing_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Xing:', 'pakghor' ),
            ),
            array(
                'id'                => 'tumblr_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Tumblr:', 'pakghor' ),
            ),
            array(
                'id'                => 'reddit_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Reddit:', 'pakghor' ),
            ),
            array(
                'id'                => 'vimeo_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Vimeo:', 'pakghor' ),
            ),
            array(
                'id'                => 'telegram_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Telegram:', 'pakghor' ),
            ),
            array(
                'id'                => 'yelp_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Yelp:', 'pakghor' ),
            ),
            array(
                'id'                => 'flickr_link',
                'type'              => 'text',
                'title'             => esc_html__( 'Flickr:', 'pakghor' ),
            ),
            array(
                'id'                => 'whatsapp_link',
                'type'              => 'text',
                'title'             => esc_html__( 'WhatsApp:', 'pakghor' ),
            ),
        );
    }

}
