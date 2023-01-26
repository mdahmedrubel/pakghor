<?php
/**
 * Pakghor About  Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */
if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_about extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'about_style'				=> '',
			'title'         			=> '',
			'about_content'				=> '',
			'about_img'					=> '',
			'about_img_width'			=> '',
			'button_text'				=> '',
			'button_url'				=> '',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();
			pakghor_about( $about_style, $title, $about_content, $about_img, $about_img_width, $button_text, $button_url, $fc_class );
		return ob_get_clean();
	}
}

vc_map( array(
	"name"		=> esc_html__( "Pakghor About", "pakghor" ),
	"base"		=> "pakghor_about",
	"icon"          => "fa fa-cutlery",
	"category"	=> esc_html__( "Pakghor", "pakghor" ),
	"params"	=> array(
		array(
	    	"type"        => "dropdown",
	    	"heading"     => esc_html__("Select About Style", "pakghor"),
	    	"param_name"  => "about_style",
	    	"admin_label" => true,
	    	"value"       => array(
	        	esc_html__( "About Style One", "pakghor" )  	=> "one",
	        	esc_html__( "About Style Two", "pakghor" )  	=> "two",
	        ),
	      	"std"         	=> "one", // Your default value
	      	"description" 	=> esc_html__( "About Section Style","pakghor" ),
            "group"			=> esc_html__( "About Options", "pakghor" ),
	    ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "About Section Title", "pakghor" ),
            "param_name"	=> "title",
            "admin_label"   => true,
            "group"			=> esc_html__( "About Options", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "About Image", "pakghor" ),
            "param_name"	=> "about_img",
            "group"			=> esc_html__( "About Options", "pakghor" ),
        ),
        array(
        	"type"			=> "textfield",
        	"heading"		=> esc_html__("About Image Width", "pakghor"),
        	"param_name"	=> "about_img_width",
            "group"			=> esc_html__( "About Options", "pakghor" ),
            "description"	=> esc_html__("Use Image width. like- 40%", "pakghor"),
        ),
        array(
            "type"			=> "textarea",
            "heading"		=> esc_html__( "About Content", "pakghor" ),
            "param_name"	=> "about_content",
            "group"			=> esc_html__( "About Options", "pakghor" ),
            "description"	=> esc_html__( "HTML tag allowed here", "pakghor" )
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Button text", "pakghor" ),
            "param_name"	=> "button_text",
            "group"			=> esc_html__( "About Options", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Button Url", "pakghor" ),
            "param_name"	=> "button_url",
            "group"			=> esc_html__( "About Options", "pakghor" ),
        ),
		array(
			"type"			=> "textfield",
			"heading"		=> esc_html__( "Extra Class", "pakghor" ),
			"param_name"	=> "fc_class",
			"description"	=> esc_html__( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "pakghor" ),
			"group"			=> esc_html__( "Custom Style", "pakghor" ),
		),
	)
) );
endif;

function pakghor_about( $about_style, $title, $about_content, $about_img, $about_img_width, $button_text, $button_url, $fc_class ) { 

    $about_content_class = array(
        'about-resturent-content'
    );
    $about_content_animation = array(
        'wow',
        'slideInLeft'
    );
    if( $about_style == 'two'){
    	$about_content_animation = array(
	        'wow',
	        'slideInRight'
	    );
	}
    $about_left_animations = implode( ' ', $about_content_animation );
    $about_right_class = array();
    $about_right_animation = array(
        'wow',
        'slideInRight'
    );
 	if( $about_style == 'two'){
	    	$about_right_animation = array(
	        'wow',
	        'slideInLeft'
    	);
	}
    $about_right_animations = implode(  ' ', $about_right_animation );
	$about_img_attr = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $about_content_class[] = $about_left_animations;
            $about_right_class[] = $about_right_animations;
        }
    }
    $about_content_classes = implode( ' ', $about_content_class);
    $about_content_attr = '';
    $about_content_attr = 'class="' .esc_attr( $about_content_classes  ) . '"';
	$about_right_classes = implode(  ' ', $about_right_class );
    if( ! empty( $about_img ) ){
    	$about_img_src	= wp_get_attachment_image_src( $about_img, 'full' );
        $about_img_alt 	= get_post_meta( $about_img, '_wp_attachment_image_alt', true );
        $about_img_attr[] = 'src="'. esc_url(  $about_img_src[0]  ) . '"';
        $about_img_attr[] = 'alt="'. esc_attr( $about_img_alt) . '"';
    }
    if( !empty( $about_img_width ) ){
        $about_img_attr[] = 'style="width:' .esc_attr( $about_img_width ) . '"';
    }
    $about_img_attr[] = 'class="'. esc_attr( $about_right_classes ) .'"';
    $about_img_attrs = implode( ' ', $about_img_attr );

	// Css Classes
  	$sec_classes = array('about-resturent');
  	// About style
	if( $about_style == 'two'){
		$sec_classes[] = 'style-3';
	}
    if( !empty($fc_class) ) {
        $sec_classes[] = $fc_class;
    }
    $sec_class = implode(' ', $sec_classes);
    $section_attr = array();
    $section_attr[] = 'class="'. esc_attr($sec_class) .'"';
 ?>
	<!-- About resturent Section-->
	<section <?php echo implode(' ', $section_attr); ?>>
		<div class="container">
			<div class="row">
				<?php if( !empty( $title ) || !empty( $about_content ) || !empty( $about_img_src ) ) : ?>
				<div class="about-resturent-content-wrapper">
					<div <?php echo wp_kses_post( $about_content_attr); ?>>
						<?php if( !empty( $title ) ) :?>
							<h2><?php echo esc_html( $title ); ?></h2>
						<?php  endif ?>
						<?php  if( !empty( $about_content ) ) : ?>
							<p><?php echo wp_kses_post( $about_content ); ?></p>
						<?php endif; ?>
						<?php if( !empty( $button_text ) || !empty( $button_url ) ) : ?>
						<div class="pak-about">
							<a href="<?php  echo esc_url( $button_url ); ?>" class="button"><?php  echo esc_html($button_text); ?></a>
						</div>
						<?php endif; ?>
					</div>
					<?php if( !empty( $about_img ) ) : ?>
					<img <?php echo wp_kses_post($about_img_attrs); ?>>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div> <!-- row-->
		</div> <!-- Container-->
	</section><!-- About resturent Section end-->
<?php }