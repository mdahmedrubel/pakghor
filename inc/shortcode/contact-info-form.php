<?php
/**
 * Pakghor Contact Info & Form Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */

if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_contact_info_form extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'contact_info'      		=> '',
			'contact_icon'      		=> '',
			'contact_info_image'		=> '',
			'contact_info_img_width'	=> '',
			'contact_title'      		=> '',
			'contact_details'			=> '',
			'contact_form_shortcode'	=> '',
			'fc_class'					=> '',
		), $atts ) );
		$contact_info 	= ( array ) vc_param_group_parse_atts( $contact_info );
		ob_start();
		pakghor_contact_info_form( $contact_info, $contact_icon, $contact_info_image, $contact_info_img_width, $contact_title, $contact_details, $contact_form_shortcode, $fc_class );
		return ob_get_clean();
	}
}

vc_map( array(
	"name"			=> esc_html__( "Pakghor Contact info and Form", "pakghor" ),
	"base"			=> "pakghor_contact_info_form",
	"class"			=> "",
	"icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(
		array(
            "type"			=> "param_group",
            "heading"		=> esc_html__( "Pakghor Contact info", "pakghor" ),
            "param_name"	=> "contact_info",
            "group"			=> esc_html__( "Contact Options", "pakghor" ),
            "params"		=> array(
            		array(
            			"type"			=> "iconpicker",
            			"heading"		=> esc_html__( "Contact info Icon", "pakghor" ),
            			"param_name"	=> "contact_icon",
            		),
            		array(
			            "type"			=> "attach_image",
			            "heading"		=> esc_html__( "Contact Info Image", "pakghor" ),
			            "param_name"	=> "contact_info_image",
			            "description"	=> esc_html__("The Image refers to the Info, You can use image insted of Icon.","pakghor"),
			            "group"			=> esc_html__( "General", "pakghor" ),
				    ),
				    array(
			            "type"          => "textfield",
			            "heading"       => esc_html__( "Image Width", "pakghor" ),
			            "param_name"    => "contact_info_img_width",
			            "description"   => esc_html__('Use the Width in pixel, like: 200px','pakghor'),
			            "group"         => esc_html__( "General", "pakghor" ),
			        ),
			        array(
            			"type"			=> "textfield",
            			"heading"		=> esc_html__( "Contact Title", "pakghor" ),
            			"param_name"	=> "contact_title",
            		),
            		array(
            			"type"			=> "textarea",
            			"heading"		=> esc_html__( "Contact Details", "pakghor" ),
            			"param_name"	=> "contact_details",
            		),
            	),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Contact Form 7 Shortcode", "pakghor" ),
            "param_name"	=> "contact_form_shortcode",
            "description"	=> esc_html__( 'Create a Form in Contact Form 7, and past the Shortcode here', 'pakghor' ),
            "group"			=> esc_html__( "Contact Options", "pakghor" ),
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

function pakghor_contact_info_form( $contact_info, $contact_icon, $contact_info_image, $contact_info_img_width, $contact_title, $contact_details, $contact_form_shortcode, $fc_class) { 

   $animation_class = array(
        'wow',
        'slideInUp'
    );
    $animation_classes = implode( ' ', $animation_class);
    $wrapper_class = array('contact-item');
    $form_class = array('pak-contact-page-form');
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $wrapper_class[] = $animation_classes;
            $form_class[] = $animation_classes;
        }
    }
    $wrapper_classes = implode(  ' ', $wrapper_class );
    $wrapper_attr = 'class="' .esc_attr($wrapper_classes). '"';
    $form_classes = implode(  ' ', $wrapper_class);
    $form_attr = 'class="' .esc_attr($form_classes). '"';

	// Css Classes
    $css_classes = array('contact');
    if( !empty($fc_class) ) {
        $css_classes[] = $fc_class;
    }
?>
	<section class="<?php echo esc_attr( implode(' ', $css_classes ) ); ?>">
		<div class="container">
			<div class="row">
				<?php if( !empty( $contact_info ) || !empty( $contact_form_shortcode ) ) : ?>
				<div class="contact-wrapper">
					<?php if( !empty( $contact_info ) ) : 
						foreach ( $contact_info as $contact_info_item ) : 
						$info_icon 			= isset( $contact_info_item['contact_icon'] ) ? $contact_info_item['contact_icon'] : ''; 
						$contact_info_image = isset($contact_info_item['contact_info_image']) ? $contact_info_item['contact_info_image'] : '';
						$contact_info_img_width = isset($contact_info_item['contact_info_img_width']) ? $contact_info_item['contact_info_img_width'] : '';
						$contact_title 		= isset( $contact_info_item['contact_title'] ) ? $contact_info_item['contact_title'] : ''; 
						$contact_details 	= isset( $contact_info_item['contact_details'] ) ? $contact_info_item['contact_details'] : '';
						?>
					<div class="col-md-4 col-sm-4">
					    <div <?php echo wp_kses_post($wrapper_attr); ?>>
					    	<?php if(!empty($contact_info_image)) :
					    		$contact_info_image_src = wp_get_attachment_image_src($contact_info_image, 'full');

					    		$contact_info_image_alt = get_post_meta( $contact_info_image, '_wp_attachment_image_alt', true );
					    	 ?>
					    	<img  <?php if($contact_info_img_width): ?> style="width:<?php echo esc_attr($contact_info_img_width); ?>" <?php endif; ?> src="<?php echo esc_url($contact_info_image_src[0]); ?>" alt="<?php echo esc_attr($contact_info_image_alt); ?>">
					    <?php else: 
					    	echo '<i class="' . esc_attr( $info_icon ) . '"></i>'; 
					    	endif;?>
					    <?php 
					    	echo '<h2>' . esc_html( $contact_title ) . '</h2>'; 
					    	echo '<p>' . wp_kses_post( $contact_details ) . '</p>';
					    ?>
					    </div><!-- contact-item -->
					</div>
					<?php endforeach; ?>
					<div class="clearfix"></div>
					<?php endif; ?>
					<?php if( !empty( $contact_form_shortcode ) ) : ?>
					<!-- Contact Form-->
					<div <?php echo wp_kses_post($form_attr); ?>>
					<?php echo do_shortcode( $contact_form_shortcode ); ?>
					</div>
					<!-- contact-form -->
					<?php endif; ?>
				</div><!-- contact-info-wrapper -->
				<?php endif; ?>
			</div>
		</div><!-- continer -->
	</section><!-- contact section end-->

<?php }