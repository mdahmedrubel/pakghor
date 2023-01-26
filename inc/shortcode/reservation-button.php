<?php
/**
 * Pakghor Reservation Button Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */

if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_reservation_button extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title'         			=> '',
			'subtitle'					=> '',
			'reservation_button_text'	=> '',
			'reservation_button_url'	=> '',
			'section_bg_image'			=> '',
			'bg_size'                   => 'cover',
            'bg_repeat'                 => 'no-repeat',
            'bg_position'               => 'center',
            'section_overlay'           => '',
            'fc_class'                  => '',
		), $atts ) );
		ob_start();

		pakghor_reservation_button( $title, $subtitle, $reservation_button_text, $reservation_button_url, $section_bg_image, $bg_size, $bg_repeat, $bg_position, $section_overlay, $fc_class );
		return ob_get_clean();
	}
}

vc_map( array(
	"name"			=> esc_html__( "Pakghor Reservation Button", "pakghor" ),
	"base"			=> "pakghor_reservation_button",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(

        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Reservation Button Section Title", "pakghor" ),
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
            "heading"		=> esc_html__( "Button text", "pakghor" ),
            "param_name"	=> "reservation_button_text",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Button Url", "pakghor" ),
            "param_name"	=> "reservation_button_url",
            "group"			=> esc_html__( "General", "pakghor" ),
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
			"param_name"	=> "fc_class",
			"description"	=> esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pakghor" ),
			"group"			=> esc_html__( "Custom Style", "pakghor" )
		)
	)
) );
endif;

function pakghor_reservation_button ($title, $subtitle, $reservation_button_text, $reservation_button_url, $section_bg_image, $bg_size, $bg_repeat, $bg_position, $section_overlay, $fc_class ) {
	$section_bg_image = wp_get_attachment_image_src( $section_bg_image, 'full' );

    $animation_class = array(
            'wow',
            'slideInUp'
        );
    $animation_classes = implode( ' ', $animation_class);
    $wrapper_class = array('reservation-btn reserves') ;

    $top_img_class = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $wrapper_class[] = $animation_classes;
        }
    }
    $wrapper_classes = implode(  ' ', $wrapper_class );
    $wrapper_attr = 'class="' .esc_attr($wrapper_classes). '"';



    //Section Class
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
					<?php if( !empty($title) || !empty($subtitle) ): ?>
					<div class="section-head">
						<?php if( !empty($title) ) : ?>
                            <h2 <?php echo implode(' ', $animation_attr ); ?>><?php echo esc_html($title); ?></h2>
                        <?php endif;
                        if( !empty($subtitle) ) : ?>
                            <p <?php echo implode(' ', $animation_attr ); ?>><?php echo wp_kses_post($subtitle); ?></p>
                        <?php endif; ?>
					</div><!-- section-head -->
					<?php endif; ?>
					<?php if ( !empty( $reservation_button_text ) || !empty( $reservation_button_url ) ) : ?> 
					<div <?php echo wp_kses_post($wrapper_attr); ?>>
						<a href="<?php echo esc_url( $reservation_button_url ); ?>" class="button"><?php echo esc_html( $reservation_button_text ); ?></a>
					</div>
					<?php  endif; ?>
				</div>
			</div> <!-- container -->
		</div>
	</section><!-- Reservation Section end -->

<?php }