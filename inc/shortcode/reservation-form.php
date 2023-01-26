<?php
/**
 * Pakghor Reservation form Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */

if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_reservation_form extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'         			=> '',
			'subtitle'					=> '',
			'contact_form_shortcode'	=> '',
			'section_bg_image'			=> '',
            'bg_size'                   => 'cover',
            'bg_repeat'                 => 'no-repeat',
            'bg_position'               => 'center',
			'section_overlay'			=> '',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();

			pakghor_reservation_form( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $contact_form_shortcode, $section_bg_image, $bg_size, $bg_repeat, $bg_position, $section_overlay, $fc_class );
		return ob_get_clean();
	}
}

vc_map( array(
	"name"			=> esc_html__( "Pakghor Reservation Form One", "pakghor" ),
	"base"			=> "pakghor_reservation_form",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(

        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Reservation Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Reservation Section Top Image", "pakghor" ),
            "param_name"	=> "section_top_image",
            "description"	=> esc_html__( "You can use Image instade of Icon", "pakghor" ),
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__( "Image Width", "pakghor" ),
            "param_name"    => "section_top_image_width",
            "description"   => esc_html__('Use the Width in pixel, like: 200px','pakghor'),
            "group"         => esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Reservation Section Title", "pakghor" ),
            "param_name"	=> "title",
            "admin_label"	=> true,
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Subtitle", "pakghor" ),
            "param_name"	=> "subtitle",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Contact Form 7 Shortcode", "pakghor" ),
            "param_name"	=> "contact_form_shortcode",
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"	=> esc_html__( "GIve here Contact form Shortcode.", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Section Background Image", "pakghor" ),
            "param_name"	=> "section_bg_image",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Background Position", "pakghor"),
            "param_name"    => "bg_position",
            "std"           => "center",
            "description"   => esc_html__("Give your Background Image Position, Default is center", 'pakghor' ),
            'group'         => esc_html__( 'General', 'pakghor' )
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Background Repeat", "pakghor"),
            "param_name"    => "bg_repeat",
            "std"           => "no-repeat",
            "value"     => array(
                esc_html__( "No-repeat","pakghor")   => "no-repeat",
                esc_html__( "Repeat", "pakghor" )    => "repeat",
                esc_html__( "Repeat-x", "pakghor" )  => "repeat-x",
                esc_html__( "Repeat-y", "pakghor" )  => "repeat-y",
            ),
            "description"   => esc_html__("Background Repeat, Default is no-repeat", 'pakghor' ),
            'group'         => esc_html__( 'General', 'pakghor' )
        ),
        array(
             "type"          => "dropdown",
            "heading"       => esc_html__("Background Size", "pakghor"),
            "param_name"    => "bg_size",
            "std"           => "cover",
            "value"     => array(
                esc_html__( "Cover","pakghor")      => "cover",
                esc_html__( "Auto", "pakghor" )     => "auto",
                esc_html__( "Contain", "pakghor" )  => "contain",
            ),
            "description"   => esc_html__("Background Image Size, Default is cover", 'pakghor' ),
            'group'         => esc_html__( 'General', 'pakghor' )
        ),
        array(
            "type"			=> "colorpicker",
            "heading"		=> esc_html__( "Background Overlay Color", "pakghor" ),
            "param_name"	=> "section_overlay",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
		array(
			"type"			=> "textfield",
			"heading"		=> esc_html__( "Extra Class", "pakghor" ),
			"param_name"	=> "pl_class",
			"description"	=> esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pakghor" ),
			'group'			=> esc_html__( 'Custom Style', "pakghor" )
		)
	)
) );
endif;

function pakghor_reservation_form( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $contact_form_shortcode, $section_bg_image, $bg_size, $bg_repeat, $bg_position, $section_overlay, $fc_class ) {
	$section_bg_image = wp_get_attachment_image_src( $section_bg_image, 'full' );

    $animation_class = array(
            'wow',
            'slideInUp'
        );
    $animation_classes = implode( ' ', $animation_class);

    // Top Icon
    $top_icon_class = array();
    if( ! empty( $section_top_icon ) ){
        $top_icon_class[] = $section_top_icon;
    }
    $form_wrapper_class = array( 'reservation-form', 'fcc' );
    $top_img_class = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $top_icon_class[] = $animation_classes;
            $top_img_class[] = $animation_classes;
            $form_wrapper_class[] = $animation_classes;
        }
    }
    // Icon Animation
    $top_icon_classes = implode( ' ', $top_icon_class );
    $top_icon_attr = '';
    $top_icon_attr = 'class="'. esc_attr( $top_icon_classes ) .'"';
    // Top Image Animation
    $top_img_attr = array();
    if( ! empty($section_top_image ) ){
        $section_top_image_src = wp_get_attachment_image_src($section_top_image , 'full');
        $section_top_img_alt = get_post_meta( $section_top_image, '_wp_attachment_image_alt', true );
        $top_img_attr[] = 'src="'. esc_url( $section_top_image_src['0'] ) . '"';
        $top_img_attr[] = 'alt="'. esc_attr( $section_top_img_alt ) . '"';
    }
    if( !empty( $section_top_image_width ) ){
        $top_img_attr[] = 'style="width:' .esc_attr( $section_top_image_width ) . '"';
    }
    $top_img_classes = implode( ' ', $top_img_class );
    $top_img_attr[] = 'class="'. esc_attr( $top_img_classes ) .'"';
    $top_img_attrs = implode( ' ', $top_img_attr );

    $form_wrapper_classes = implode(  ' ', $form_wrapper_class);
    $form_wrapper_attr = 'class="' .esc_attr($form_wrapper_classes). '"';

	// Css Classes
   $sec_classes = array(
            'reservation'
        );
    if( !empty($fc_class) ) {
        $sec_classes[] = $fc_class;
    }
    $sec_class = implode(' ', $sec_classes);
    $section_attr = array();
    $section_attr[] = 'class="'. esc_attr($sec_class) .'"';
    if( !empty($section_bg_image ) ){
        $section_attr[] = 'style="background: url( ' .esc_url( $section_bg_image[0] ). ' );
        background-repeat: '. esc_attr($bg_repeat) .'; 
        background-size: '. esc_attr($bg_size) .'; 
        background-position: '. esc_attr($bg_position) .'"';
    }
    // Overlay Class
    $overlay_classess = array(
            'section-overlay',
            'section-padding'
        );
    $overlay_class = implode( ' ', $overlay_classess );
    $overlay_attr = array();
    $overlay_attr[] = 'class="'.esc_attr($overlay_class).'"';
    if( !empty($section_overlay) ){
        $overlay_attr[] = 'style="background-color:'. esc_attr( $section_overlay ) .'"';
    }
?>
	<!-- Reservation Form section-->
	<section <?php echo implode( ' ', $section_attr ); ?>>
		<div <?php echo implode( ' ', $overlay_attr ); ?>>
			<div class="container">
				<div class="row">
				<?php 
                    if(!empty( $section_top_icon ) || ! empty($section_top_image) || !empty($title) || !empty($subtitle) ): ?>
                    <div class="section-head">
                        <?php
                            if( ! empty( $section_top_icon) ) : ?>
                              <i <?php echo wp_kses_post( $top_icon_attr ); ?>></i>
                        <?php else: ?>
                                <img <?php echo wp_kses_post( $top_img_attrs ); ?>>
                        <?php endif; 

                        if( !empty($title) ) : ?>
                            <h2 <?php echo implode(' ', $animation_attr ); ?>><?php echo esc_html($title); ?></h2>
                        <?php endif;
                        if( !empty($subtitle) ) : ?>
                            <p <?php echo implode(' ', $animation_attr ); ?>><?php echo wp_kses_post($subtitle); ?></p>
                        <?php endif;
                        ?>
                    </div><!-- section-head -->
                    <?php endif; ?>
					<?php if( !empty($contact_form_shortcode) ) : ?>
					<div <?php echo wp_kses_post($form_wrapper_attr); ?>>
						<?php echo do_shortcode($contact_form_shortcode); ?>
					</div><!-- reservation form -->
					<?php endif; ?>
				</div>
			</div> <!-- container -->
		</div>
	</section><!-- Reservation Section end -->

<?php }