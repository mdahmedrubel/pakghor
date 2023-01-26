<?php
/**
 * Pakghor Feature One Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */
if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_feature_style_one extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'         			=> '',
			'subtitle'					=> '',
            'section_image'             => '',
			'section_image_width'		=> '',
			'feature_item_left' 		=> '',
			'feature_item_right' 		=> '',
			'section_bg_image_left'		=> '',
			'lbg_size'                  => '23%',
            'lbg_position'              => 'top left',
            'section_bg_image_right'    => '',
            'rbg_size'                  => '23%',
            'rbg_position'              => 'top right',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();

		$feature_item_left 	= ( array ) vc_param_group_parse_atts( $feature_item_left );
		$feature_item_right = ( array ) vc_param_group_parse_atts( $feature_item_right );

		pakghor_feature_style_one( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $section_image, $section_image_width, $feature_item_left, $feature_item_right, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class );
		return ob_get_clean();
	}
}

vc_map( array(
	"name"			=> esc_html__( "Pakghor Feature Style One", "pakghor" ),
	"base"			=> "pakghor_feature_style_one",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(
        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Feature Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Feature Section Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Feature Section Title", "pakghor" ),
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
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Feature Image", "pakghor" ),
            "param_name"	=> "section_image",
            "description"	=> esc_html__("The main image of your Focus","pakghor"),
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__( "Feature Image Width", "pakghor" ),
            "param_name"    => "section_image_width",
            "description"   => esc_html__('Use the Width in pixel, like: 200px','pakghor'),
            "group"         => esc_html__( "General", "pakghor" ),
        ),
	    array(
	        "type"			=> "param_group",
	        "heading"		=> esc_html__( "Feature Item left Column", "pakghor" ),
	        "param_name"	=> "feature_item_left",
	        "group"			=> esc_html__( "General", "pakghor" ),
	        "params"		=> array(
        		array(
        			"type"			=> "textfield",
        			"heading"		=> esc_html__( "Feature Title", "pakghor" ),
        			"param_name"	=> "feature_item_left_title",
        			"group"			=> esc_html__( "General", "pakghor" ),
        		),
        		array(
        			"type"			=> "iconpicker",
        			"heading"		=> esc_html__( "Feature Icon", "pakghor" ),
        			"param_name"	=> "feature_item_left_icon",
        			"group"			=> esc_html__( "General", "pakghor" ),
        		),
        		array(
        			"type"			=> "attach_image",
        			"heading"		=> esc_html__( "Feature Image", "pakghor" ),
        			"param_name"	=> "feature_item_left_img",
        			"group"			=> esc_html__( "General", "pakghor" ),
        		),
        		array(
        			"type"			=> "textarea",
        			"heading"		=> esc_html__( "Feature Content", "pakghor" ),
        			"param_name"	=> "feature_item_left_content",
        			"group"			=> esc_html__( "General", "pakghor" ),
        		),
	        ),
    	),
		array(
            "type"			=> "param_group",
            "heading"		=> esc_html__( "Feature Item Right Column", "pakghor" ),
            "param_name"	=> "feature_item_right",
            "group"			=> esc_html__( "General", "pakghor" ),
            "params"		=> array(
        		array(
        			"type"			=> "textfield",
        			"heading"		=> esc_html__( "Feature Title", "pakghor" ),
        			"param_name"	=> "feature_item_right_title",
        			"group"			=> esc_html__( "General", "pakghor" ),
        		),
        		array(
        			"type"			=> "iconpicker",
        			"heading"		=> esc_html__( "Feature Icon", "pakghor" ),
        			"param_name"	=> "feature_item_right_icon",
        			"group"			=> esc_html__( "General", "pakghor" ),
        		),
        		array(
        			"type"			=> "attach_image",
        			"heading"		=> esc_html__( "Feature Image", "pakghor" ),
        			"param_name"	=> "feature_item_right_img",
        			"group"			=> esc_html__( "General", "pakghor" ),
        		),
        		array(
        			"type"			=> "textarea",
        			"heading"		=> esc_html__( "Feature Content", "pakghor" ),
        			"param_name"	=> "feature_item_right_content",
        			"group"			=> esc_html__( "General", "pakghor" ),
        		),
            ),
    	),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Section Background Image Left", "pakghor" ),
            "param_name"	=> "section_bg_image_left",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
         array(
             "type"          => "textfield",
            "heading"       => esc_html__("Left Background Size", "pakghor"),
            "param_name"    => "lbg_size",
            "description"   => esc_html__("Give your Left Background Image Size, Default is: 23%", 'pakghor' ),
            'std'           => '23%',
            'group'         => esc_html__( 'General', 'pakghor' )
        ),
        array(
             "type"          => "textfield",
            "heading"       => esc_html__("Left Background Position", "pakghor"),
            "param_name"    => "lbg_position",
            "std"           => "top left",
            "description"   => esc_html__("Give your Left Background Image Position, Default is: top left", 'pakghor' ),
            'group'         => esc_html__( 'General', 'pakghor' )
        ),
        array(
            "type"          => "attach_image",
            "heading"       => esc_html__( "Section Background Image Right", "pakghor" ),
            "param_name"    => "section_bg_image_right",
            "group"         => esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Right Background Size", "pakghor"),
            "param_name"    => "rbg_size",
            "std"           => '23%',
            "description"   => esc_html__("Give your Right Background Image Size, Default is: 23%", 'pakghor' ),
            "group"         => esc_html__( 'General', 'pakghor' )
        ),
        array(
             "type"          => "textfield",
            "heading"       => esc_html__("Right Background Position", "pakghor"),
            "param_name"    => "rbg_position",
            "description"   => esc_html__("Give your Right Background Image Position, Default is: top right", 'pakghor' ),
            "std"       => 'top right',
            "group"         => esc_html__( 'General', 'pakghor' )
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

function pakghor_feature_style_one($section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $section_image, $section_image_width, $feature_item_left, $feature_item_right, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class) {
    // WOW Animation
    $animation_class = array(
            'wow',
            'slideInUp'
        );
    $animation_classes = implode( ' ', $animation_class);
    $left_item_class = array(
        'service-items-left'
    );
    $left_item_animation = array(
        'wow',
        'slideInLeft'
    );
    $left_item_animations = implode( ' ', $left_item_animation );

    $right_item_class = array(
        'service-items-right'
    );
    $right_item_animation = array(
        'wow',
        'slideInRight'
    );
    $right_item_animations = implode( ' ', $right_item_animation );
    // Top Icon
    $top_icon_class = array();
    if( ! empty( $section_top_icon ) ){
        $top_icon_class[] = $section_top_icon;
    }
    // Feature img
    $feature_img_class = array(
            'service-img'
        );
    $top_img_class = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $left_item_class[] = $left_item_animations;
            $right_item_class[] = $right_item_animations;
            $top_icon_class[] = $animation_classes;
            $top_img_class[] = $animation_classes;
            $feature_img_class[] = $animation_classes;
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
    // Left Item Animation
    $left_item_classes = implode( ' ', $left_item_class );
    $left_item_attr = '';
    $left_item_attr = 'class="'. esc_attr( $left_item_classes ) .'"';
    // Right Item Animation
    $right_item_classes = implode( ' ',  $right_item_class );
    $right_item_attr = '';
    $right_item_attr = 'class="'. esc_attr(  $right_item_classes ) .'"';
    // Feature Img animation
    $feature_img_classes =  implode( ' ', $feature_img_class);
    $feature_img_attr = '';
    $feature_img_attr = 'class="'. esc_attr( $feature_img_classes ) . '"';

	// Section Css Classes
    $sec_classes = array(
            'service'
        );
    if( !empty($fc_class) ) {
        $sec_classes[] = $fc_class;
    }
    $sec_class 	= implode(' ', $sec_classes);
    $section_attr = array();
    $section_attr[] = 'class="'. esc_attr($sec_class) .'"';
    if( !empty($section_bg_image_left) || !empty($section_bg_image_right)  ){
     	$section_bg_image_left 	= wp_get_attachment_image_src( $section_bg_image_left, 'full');
		$section_bg_image_right = wp_get_attachment_image_src( $section_bg_image_right, 'full');
    	$section_attr[] ='style="background: url( ' .esc_url( $section_bg_image_left['0'] ). ' ) no-repeat, url('.esc_url($section_bg_image_right['0']).') no-repeat;
        background-size: '.esc_attr($lbg_size).', '.esc_attr($rbg_size).'; 
        background-position: '.esc_attr($lbg_position).','.esc_attr($rbg_position).' "';
    }
    global $top_icon_attr;
?>
	<!-- service section-->
	<section <?php echo implode(' ', $section_attr); ?>>
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
				<div class="col-md-4">
					<?php if( !empty($feature_item_left ) ) : ?>
					<div <?php echo wp_kses_post($left_item_attr); ?>>
					<?php foreach ( $feature_item_left as $feature_item_left_single ) : ?>
					<?php 
						$feature_item_left_title 	= isset( $feature_item_left_single['feature_item_left_title'] ) ? $feature_item_left_single['feature_item_left_title'] :'';
						$feature_item_left_icon 	= isset( $feature_item_left_single['feature_item_left_icon'] ) ? $feature_item_left_single['feature_item_left_icon']:'';
						$feature_item_left_img 		= isset( $feature_item_left_single['feature_item_left_img'] ) ? $feature_item_left_single['feature_item_left_img']:'';

						$feature_item_left_img_src 	= wp_get_attachment_image_src($feature_item_left_img, 'full' );

						$feature_item_left_img_alt = get_post_meta( $feature_item_left_img, '_wp_attachment_image_alt', true );

						$feature_item_left_content 	= isset( $feature_item_left_single['feature_item_left_content'] ) ? $feature_item_left_single['feature_item_left_content'] :''; 
					?>
						<div class="service-item">
							<?php if( !empty($feature_item_left_img ) || !empty($feature_item_left_icon) ): ?>
							<div class="service-item-icon pull-right">
								<?php
									if( $feature_item_left_icon ) :

										echo '<i class="'.esc_attr( $feature_item_left_icon ).'"></i>';
									else:
										echo '<img src="'. esc_url( $feature_item_left_img_src[0] ) .'" alt="' . esc_attr( $feature_item_left_img_alt ) . '">';
									endif;
								?>
							</div>
							<?php endif; ?>
							<?php if( !empty( $feature_item_left_title ) || !empty( $feature_item_left_content) ) : ?>
							<div class="service-item-des pull-left">
								<h2><?php echo esc_html($feature_item_left_title); ?></h2>
								<p><?php echo wp_kses_post($feature_item_left_content); ?></p>
							</div>
							<?php endif; ?>
						</div><!-- service item --> 
					<?php endforeach; ?>
					</div><!-- service item left -->
					<?php endif; ?>
				</div>
				<div class="col-md-4">
					<?php 
						$section_image_src = wp_get_attachment_image_src( $section_image, 'full' );
						$section_image_alt = get_post_meta( $section_image, '_wp_attachment_image_alt', true );
					if( !empty( $section_image_src ) ) : ?>
					<div <?php echo wp_kses_post( $feature_img_attr ); ?>>
						<img <?php if($section_image_width): ?> style="width:<?php echo esc_attr($section_image_width); ?>" <?php endif; ?> src="<?php echo esc_url($section_image_src[0]); ?>" alt="<?php echo esc_attr( $section_image_alt ) ?>">
					</div><!-- service img -->
					<?php endif; ?>
				</div>
				<div class="col-md-4">
					<div <?php echo wp_kses_post($right_item_attr); ?>>
					<?php 
					if($feature_item_right):
					foreach ( $feature_item_right as $feature_item_right_single ) :
						$feature_item_right_title 		= isset( $feature_item_right_single['feature_item_right_title'] ) ? $feature_item_right_single['feature_item_right_title'] :'';
						$feature_item_right_icon 		= isset( $feature_item_right_single['feature_item_right_icon'] ) ? $feature_item_right_single['feature_item_right_icon']:'';
						$feature_item_right_img 		= isset( $feature_item_right_single['feature_item_right_img'] ) ? $feature_item_right_single['feature_item_right_img']:'';
						$feature_item_right_img_src 	= wp_get_attachment_image_src($feature_item_right_img, 'full' );

						$feature_item_right_img_alt = get_post_meta( $feature_item_right_img, '_wp_attachment_image_alt', true );
						$feature_item_right_content 	= isset( $feature_item_right_single['feature_item_right_content'] ) ? $feature_item_right_single['feature_item_right_content'] :'';
					?>
						<div class="service-item">
							<?php if( !empty( $feature_item_right_img ) || !empty( $feature_item_right_icon ) ) : ?>
							<div class="service-item-icon pull-left">
								<?php
									if( $feature_item_right_icon ) :
										echo '<i class="'.esc_attr( $feature_item_right_icon ).'"></i>';
									else:
										echo '<img src="'. esc_url( $feature_item_right_img_src[0] ) .'" alt="' . esc_attr( $feature_item_right_img_alt ) . '">';
									endif;
								?>
							</div>
							<?php endif; ?>
							<div class="service-item-des pull-right">
								<h2><?php echo esc_html( $feature_item_right_title ); ?></h2>
								<p><?php echo wp_kses_post( $feature_item_right_content ); ?></p>
							</div>
						</div><!-- service item -->
					<?php endforeach; endif; ?>
					</div>
				</div>
			</div>
		</div> <!-- container -->
	</section><!-- service section end -->
<!-- end achievement-section -->
<?php }