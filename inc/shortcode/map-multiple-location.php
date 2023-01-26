<?php
/**
 * Pakghor Mutiple Location Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */
if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_map_multilocation extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'	        => '',
			'section_top_image'	        => '',
            'section_top_image_width'   => '', 
			'title'         	        => '',
			'subtitle'			        => '',
			'ml_left_lists'             => '',
            'ml_right_lists'            => '',
            'ml_title'                  => '',
            'ml_left_img'               => '',
            'ml_left_name'              => '',
            'ml_right_img'              => '',
            'ml_right_name'             => '',
            'ml_more_button'            => '',
            'ml_more_button_url'        => '',
			'fc_class'			        => '',
		), $atts ) );
		ob_start();

        $ml_left_lists = ( array ) vc_param_group_parse_atts( $ml_left_lists );
        $ml_right_lists = ( array ) vc_param_group_parse_atts( $ml_right_lists );

		pakghor_map_multilocation( $section_top_icon, $section_top_image,  $section_top_image_width,  $title, $subtitle, $ml_left_lists, $ml_right_lists, $ml_title, $ml_left_img, $ml_left_name, $ml_right_img, $ml_right_name, $ml_more_button, $ml_more_button_url, $fc_class );
		return ob_get_clean();
	}
}

vc_map( array(
	"name"			=> esc_html__( "Pakghor Google Map Multiple Locations", "pakghor" ),
	"base"			=> "pakghor_map_multilocation",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(
        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Section Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Section Title", "pakghor" ),
            "param_name"	=> "title",
            "admin_label"   => true,
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Subtitle", "pakghor" ),
            "param_name"	=> "subtitle",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__( "Mutiple Location Title", "pakghor" ),
            "param_name"    => "ml_title",
            "group"         => esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "param_group",
            "heading"       => esc_html__( "Mutiple Location List One", "pakghor" ),
            "param_name"    => "ml_left_lists",
            "group"         => esc_html__( "General", "pakghor" ),
            "params"        => array(
                array(
                    "type"          => "attach_image",
                    "heading"       => esc_html__( "Location Image", "pakghor" ),
                    "param_name"    => "ml_left_img",
                    "description"   => esc_html__( "Use small image or flag", "pakghor" ),
                    "group"         => esc_html__( "General", "pakghor" ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__( "Location Name", "pakghor" ),
                    "param_name"    => "ml_left_name",
                    "group"         => esc_html__( "General", "pakghor" ),
                ),
            ),
        ),
        array(
            "type"          => "param_group",
            "heading"       => esc_html__( "Mutiple Location List Two", "pakghor" ),
            "param_name"    => "ml_right_lists",
            "group"         => esc_html__( "General", "pakghor" ),
            "params"        => array(
                array(
                    "type"          => "attach_image",
                    "heading"       => esc_html__( "Location Image", "pakghor" ),
                    "param_name"    => "ml_right_img",
                    "description"   => esc_html__( "Use small image or flag", "pakghor" ),
                    "group"         => esc_html__( "General", "pakghor" ),
                ),
                array(
                    "type"          => "textfield",
                    "heading"       => esc_html__( "Location Name", "pakghor" ),
                    "param_name"    => "ml_right_name",
                    "group"         => esc_html__( "General", "pakghor" ),
                ),
            ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__( "More Button Text", "pakghor" ),
            "param_name"    => "ml_more_button",
            "group"         => esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__( "More Button Url", "pakghor" ),
            "param_name"    => "ml_more_button_url",
            "group"         => esc_html__( "General", "pakghor" ),
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

function pakghor_map_multilocation( $section_top_icon, $section_top_image,  $section_top_image_width,  $title, $subtitle, $ml_left_lists, $ml_right_lists, $ml_title, $ml_left_img, $ml_left_name, $ml_right_img, $ml_right_name, $ml_more_button, $ml_more_button_url, $fc_class ) {

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
    $wrapper_class = array('branches-location') ;
    $map_class = array('g-map-multi-locator');
    $top_img_class = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $top_icon_class[] = $animation_classes;
            $top_img_class[] = $animation_classes;
            $wrapper_class[] = $animation_classes;
            $map_class[] = $animation_classes;
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
    $wrapper_classes = implode(  ' ', $wrapper_class );
    $wrapper_attr = 'class="' .esc_attr($wrapper_classes). '"';
    $map_classes = implode(' ', $map_class);
    $map_attr = 'class="' .esc_attr($map_classes). '"';

     // Css Classes
    $sec_classes = array(
            'branches',
            'section-padding'
        );
    if( !empty($fc_class) ) {
        $sec_classes[] = $fc_class;
    }
    $sec_class = implode(' ', $sec_classes);
    $section_attr = array();
    $section_attr[] = 'class="'. esc_attr($sec_class) .'"';
?>
	<!-- Google Map Mutiple Location -->
	<section <?php echo implode(' ', $section_attr) ?>>
        <div class="container">
    	<?php if(!empty( $section_top_icon ) || ! empty($section_top_image) || !empty($title) || !empty($subtitle) ): ?>
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
            <div <?php echo wp_kses_post($map_attr); ?>>
                <div class="row">
                    <div class="col-lg-5 col-md-6 pak-ml">
                        <?php if(!empty($ml_title)) : ?>
                        <div class="heading-block mt-md-3 mt-0">
                            <h3 class="nott ls0"><?php echo esc_html($ml_title); ?></h3>
                        </div>
                        <?php endif; ?>
                        <?php if( !empty( $ml_left_lists) || !empty($ml_right_lists) ): ?>
                        <div class="ml-location-list">
                            <?php if( !empty( $ml_left_lists) ): ?>
                            <div class="ml-left-row">
                                <ul class="iconlist ml-0 ml-left">
                                    <?php foreach ($ml_left_lists as $ml_left_list ) :
                                       $ml_left_img = isset( $ml_left_list['ml_left_img'] ) ? $ml_left_list['ml_left_img'] :'';
                                       $ml_left_name = isset( $ml_left_list['ml_left_name'] ) ? $ml_left_list['ml_left_name'] :'';
                                        $ml_left_img = $ml_left_list['ml_left_img'];
                                        $ml_left_name =  $ml_left_list['ml_left_name'];
                                        $ml_left_img = wp_get_attachment_image_url($ml_left_img);
                                        $ml_left_img_alt = get_post_meta( $ml_left_img, '_wp_attachment_image_alt', true );
                                    ?>
                                    <li><img src="<?php echo esc_url($ml_left_img); ?>" alt="<?php echo esc_attr($ml_left_img_alt); ?>"><?php echo esc_html($ml_left_name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <?php if( !empty( $ml_right_lists ) ): ?>
                            <div class="ml-right-row">
                                <ul class="iconlist ml-right ml-0">
                                <?php foreach ($ml_right_lists as $ml_right_list ) :

                                 $ml_right_img = isset( $ml_left_list['ml_right_img'] ) ? $ml_left_list['ml_right_img'] :'';
                                       $ml_right_name = isset( $ml_left_list['ml_right_name'] ) ? $ml_left_list['ml_right_name'] :'';
                                    $ml_right_img = $ml_right_list['ml_right_img'];
                                    $ml_right_name =  $ml_right_list['ml_right_name'];
                                    $ml_right_img = wp_get_attachment_image_url($ml_right_img);
                                    $ml_right_img_alt = get_post_meta( $ml_right_img, '_wp_attachment_image_alt', true ); ?>
                                    <li><img src="<?php echo esc_url($ml_right_img); ?>" alt="<?php echo esc_attr($ml_right_img_alt); ?>"><?php echo esc_html($ml_right_name ); ?></li>
                                <?php endforeach; ?>
                                <?php if(!empty( $ml_more_button )) : ?>
                                    <li><a href="<?php echo esc_url($ml_more_button_url); ?>"><?php echo esc_html( $ml_more_button ); ?></a></li>
                                <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div id="hotspot-img" class="hotspot-img mt-2 responsive-hotspot-wrap">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/multi-map.png" class="img-responsive" alt="map">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- Mutiple Location section-->
<?php }