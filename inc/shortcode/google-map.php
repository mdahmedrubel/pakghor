<?php
/**
 * Pakghor Google Map Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */

if( function_exists( 'vc_map' ) ) :
	class WPBakeryShortcode_pakghor_google_map extends WPBakeryShortcode {
		protected function content( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'map_latitude'      	=> '',
				'map_longitude'      	=> '',
				'map_zoom'      		=> 17,
				'map_icon'				=> '',
				'fc_class'				=> '',
			), $atts ) );
			ob_start();
				pakghor_google_map( $map_latitude, $map_longitude, $map_zoom, $map_icon, $fc_class );
			return ob_get_clean();
		}
	}
	vc_map( array(
		"name"			=> esc_html__( "Pakghor Google Map", "pakghor" ),
		"base"			=> "pakghor_google_map",
		"class"			=> "",
		"icon"          => "fa fa-cutlery",
		"category"		=> esc_html__( "Pakghor", "pakghor" ),
		"params"		=> array(
	        array(
	            "type"			=> "textfield",
	            "heading"		=> esc_html__( "Google Map latitude", "pakghor" ),
	            "param_name"	=> "map_latitude",
	            "group"			=> esc_html__( "Map Options", "pakghor" ),
	        ),
	        array(
	            "type"			=> "textfield",
	            "heading"		=> esc_html__( "Google Map longitude", "pakghor" ),
	            "param_name"	=> "map_longitude",
	            "group"			=> esc_html__( "Map Options", "pakghor" ),
	        ),
	        array(
	            "type"			=> "textfield",
	            "heading"		=> esc_html__( "Google Zoom", "pakghor" ),
	            "param_name"	=> "map_zoom",
	            "group"			=> esc_html__( "Map Options", "pakghor" ),
	            "value"			=> 17,
	        ),
	        array(
	            "type"			=> "attach_image",
	            "heading"		=> esc_html__( "Upoad Map Marker Icon", "pakghor" ),
	            "param_name"	=> "map_icon",
	            "group"			=> esc_html__( "Map Options", "pakghor" ),
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

	function pakghor_google_map( $map_latitude, $map_longitude, $map_zoom, $map_icon, $fc_class ) { 
		$map_icon_image = wp_get_attachment_image_src( $map_icon, 'full');

   	$animation_class = array(
            'wow',
            'slideInUp'
        );
    $css_classes = array(
            'contact-page-map'
        );
    if( !empty($fc_class) ) {
        $css_classes[] = $fc_class;
    }
    $animation_classes = implode( ' ', $animation_class);
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $css_classes[]  = $animation_classes;
        }
    }
	if( !empty( $map_latitude ) || !empty( $map_longitude ) ) :?>
	<div class="<?php echo esc_attr( implode(' ', $css_classes ) ) ?>">
		<div id="map" data-map-latitute="<?php echo esc_attr( $map_latitude ); ?>" data-map-longitude="<?php echo  esc_attr( $map_longitude ); ?>" data-map-zoom="<?php echo esc_attr( $map_zoom ); ?>" data-map-icon="<?php echo esc_url( $map_icon_image[0] ); ?>">
		</div>
	</div>
	<?php endif;
}