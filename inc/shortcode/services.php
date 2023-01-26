<?php
/**
 * Pakghor Services Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */

if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_services extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'						=> '',
			'subtitle'					=> '',
			'item_count'         		=> 3,
			'service_excerpt_word'		=> 20,
			'order'         			=> '',
            'category_options'          => '',
			'orderby'         			=> '',
			'category'					=> '',
			'tag'						=> '',
			'postid'					=> '',
			'offset'					=> 0,	
			'section_bg_image_left'		=> '',
			'lbg_size'                  => 'auto',
            'lbg_position'              => '113% 0',
            'section_bg_image_right'    => '',
            'rbg_size'                  => 'auto',
            'rbg_position'              => '-24% 150%',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();
		pakghor_services( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $item_count, $service_excerpt_word, $order, $orderby, $category_options, $category, $tag, $postid, $offset, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class );
		return ob_get_clean();
	}
}

// Taxonomy query for this post type
if( ! function_exists('pakghor_services_taxonomy') ) {
    function pakghor_services_taxonomy() {
        $categories = get_terms(
                array(
                    'taxonmy'       =>'services_category', 
                    'hide_empty'    => true
                )
            );
        if($categories){
            foreach($categories as $category){
                $data[$category->term_id] = $category->name;
            }
        }
        return $data;
    }
}
if( ! function_exists('pakghor_services_category') ) {
    function pakghor_services_category($taxonomy){
        global $wpdb;
        $query  = 'SELECT DISTINCT 
                t.name,t.term_id,t.slug 
                FROM
                    '.$wpdb->prefix.'terms t 
                INNER JOIN 
                    '.$wpdb->prefix.'term_taxonomy tax 
                ON 
                    tax.term_id = t.term_id
                WHERE 
                    ( tax.taxonomy = \'' . $taxonomy . '\')';                     
        $result =  $wpdb->get_results($query , ARRAY_A);
        return $result;
    }
}
$terms = pakghor_services_category('services_category');
$data = array(
    esc_html__('All Categories', 'pakghor') => 'p-all-cats'
    );
if($terms){
    foreach($terms as $term){
    $data[$term['name']] = $term['term_id'];
    }
}

vc_map( array(
	"name"			=> esc_html__( "Pakghor Services", "pakghor" ),
	"base"			=> "pakghor_services",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(
        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Services Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Services Section Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Services Section Title", "pakghor" ),
            "param_name"	=> "title",
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
            "heading"		=> esc_html__( "Services Count", "pakghor" ),
            "param_name"	=> "item_count",
            "std"			=> 3,
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "How many Testimonials want to display? Default is 4", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Service Excerpt Word Limit", "pakghor" ),
            "param_name"	=> "service_excerpt_word",
            "admin_label"	=> true,
            "std"			=> 20,
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "The limit of Service Excerpt word limit ,Default is 20", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Select Service Category", "pakghor" ),
            "param_name"    => "category_options",
            "admin_label"   => true,
            "value"         => $data, // From Post type query
            "group"         => esc_html__( "Post Query", "pakghor" )
        ),
        array(
            "type" 			=> "textfield",
            "heading"       => esc_html__("Filter by category slug:", "pakghor"),
            "param_name"    => "category",
            "description"   => esc_html__("To filter by category, enter category slugs here separated by comma (ex: cat1,cat2,cat3). Leave the field empty if you want to display the recent events", 'pakghor' ),
            'group'			=> esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Filter by tag slug:", "pakghor"),
            "param_name"    => "tag",
            "description"   => esc_html__("To filter by tag, enter tag slugs here separated by comma (ex: tag1,tag2,tag3). Leave the field empty if you want to display the recent post", "pakghor"),
            'group'			=> esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Filter by post id:", "pakghor"),
            "param_name"    => "postid",
            "description"   => esc_html__("To filter by specific post id, enter post ids here separated by comma (ex: 1,15,101). Leave the field empty if you want to display the recent post", "pakghor"),
            'group'         => esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"      	=>  "dropdown",
            "heading"   	=>  esc_html__("Order", "pakghor"),
            "param_name"	=>  "order",
            "admin_label"	=> true,
            "value"     	=> array(
                esc_html__( "Select Services Order","pakghor")   => "",
                esc_html__( "DESC","pakghor")    => "DESC",
                esc_html__( "ASC", "pakghor" )   => "ASC",
              ),
            "std"  			=> "DESC",
            "group"     	=>  esc_html__("Post Query", "pakghor"),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Services Order By", "pakghor" ),
            "group" => esc_html__("Post Query", "pakghor"),
            "param_name"    => "orderby",
            "value"     => array(
                esc_html__( "Select Services order by","pakghor") => "",
                esc_html__( "Date", "pakghor" )      => "date",
                esc_html__( "Name", "pakghor" )      => "name",
                esc_html__( "Modified", "pakghor" )  => "modified",
                esc_html__( "Author", "pakghor" )    => "author",
                esc_html__( "Random", "pakghor" )    => "random",
            ),
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__( 'Offset', 'pakghor' ),
            'param_name'    => 'offset',
            'std'           => 0,
            'group'         => esc_html__( 'Post Query', 'pakghor' )
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
            "description"   => esc_html__("Give your Left Background Image Size, Default is: auto", 'pakghor' ),
            'std'           => 'auto',
            'group'         => esc_html__( 'General', 'pakghor' )
        ),
        array(
             "type"          => "textfield",
            "heading"       => esc_html__("Left Background Position", "pakghor"),
            "param_name"    => "lbg_position",
            "std"           => "113% 0",
            "description"   => esc_html__("Give your Left Background Image Position, Default is: 113% 0", 'pakghor' ),
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
            "std"           => 'auto',
            "description"   => esc_html__("Give your Right Background Image Size, Default is: auto", 'pakghor' ),
            "group"         => esc_html__( 'General', 'pakghor' )
        ),
        array(
             "type"          => "textfield",
            "heading"       => esc_html__("Right Background Position", "pakghor"),
            "param_name"    => "rbg_position",
            "description"   => esc_html__("Give your Right Background Image Position, Default is: -24% 150%", 'pakghor' ),
            "std"       => '-24% 150%',
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

function pakghor_services( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $item_count, $service_excerpt_word, $order, $orderby, $category_options, $category, $tag, $postid, $offset, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class ) {
	$section_bg_image_left 	= wp_get_attachment_image_src( $section_bg_image_left, 'full' );
	$section_bg_image_right = wp_get_attachment_image_src( $section_bg_image_right, 'full' );

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
    $wrapper_class = array('service-3-item-wrapper') ;

    $top_img_class = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $top_icon_class[] = $animation_classes;
            $top_img_class[] = $animation_classes;
            $wrapper_class[] = $animation_classes;
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


	// Css Classes
    $sec_classes = array(
            'service-3',
            'section-padding'
        );
    if( !empty($fc_class) ) {
        $sec_classes[] = $fc_class;
    }
    $sec_class = implode(' ', $sec_classes);
    $section_attr = array();
    $section_attr[] = 'class="'. esc_attr($sec_class) .'"';
    if( !empty($section_bg_image_left) || !empty($section_bg_image_right ) ){
        $section_attr[] ='style="background: url( ' .esc_url( $section_bg_image_right['0'] ). ' ) no-repeat, url('.esc_url($section_bg_image_left['0']).') no-repeat;  
        background-size: '.esc_attr($lbg_size).', '.esc_attr($rbg_size).'; 
        background-position: '.esc_attr($lbg_position).','.esc_attr($rbg_position).' "';
    }
    $categories = explode(',', $category);
    $tags 		= explode(',', $tag);
    $postids 	= explode(',', $postid);

?>
	<!-- Pricing section -->
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
				<div <?php echo wp_kses_post($wrapper_attr); ?>>
				<?php

                    if( $category_options ) :
                        $pakghor_service = new WP_Query( array(
                                'post_type'             => 'pakghor_services',
                                'posts_per_page'        => $item_count,
                                'ignore_sticky_post'    => true,
                                'post_status'           => 'publish',
                                'order'                 => $order,
                                'orderby'               => $orderby,
                                'offset'                => $offset,
                                'tax_query' => array(
                                        array (
                                            'taxonomy' => 'services_category',
                                            'field' => 'term_id',
                                            'terms' => $category_options ,
                                        )
                                    ),
                                ) 
                            );  
					elseif(!empty($postid)):
		                $pakghor_service = new WP_Query( array(
		                    'post_type'             => 'pakghor_services',
		                    'post__in'              => $postids,
		                    'posts_per_page'        => $item_count,
		                    'ignore_sticky_post'    => true,
		                    'post_status'           => 'publish',
		                    'order'                 => $order,
		                    'orderby'               => $orderby,
		                    'offset'                => $offset                       
		                	) 
		            	);           
	            	elseif(!empty($tag)):
		                $pakghor_service = new WP_Query( array(
		                    'post_type'				=> 'pakghor_services',
		                    'posts_per_page'		=> $item_count,
		                    'ignore_sticky_post'	=> true,
		                    'post_status'           => 'publish',
		                    'order'                 => $order,
		                    'orderby'               => $orderby,
		                    'offset'                => $offset,
		                    'tax_query' => array(
			                        array (
			                            'taxonomy' => 'services_tag',
			                            'field' => 'slug',
			                            'terms' => $tags,
			                        )
		                    	),
		                	) 
	            		);  
					elseif( !empty($category) ) :
						$pakghor_service = new WP_Query( array(
							'post_type'			=> 'pakghor_services',
							'post_status'		=> 'publish',
							'posts_per_page'	=> $item_count,
							'order'            	=> $order,
		                    'orderby'         	=> $orderby,
		                    'offset'            => $offset,
		                    'ignore_sticky_post'   => true,
		                    'tax_query'			=> array(
		                    		array(
		                    			'taxonomy' 	=> 'services_category',
			                            'field' 	=> 'slug',
			                            'terms' 	=> $categories,
		                    		),

		                    	),
							) 
						);
					else:
						$pakghor_service = new WP_Query( array(
							'post_type'			=> 'pakghor_services',
							'post_status'		=> 'publish',
							'posts_per_page'	=> $item_count,
							'order'            	=> $order,
		                    'orderby'         	=> $orderby,
		                    'offset'            => $offset,
		                    'ignore_sticky_post'   =>  true
		                    )
		                );
					endif;
					$pakghor_services_options = $pakghor_services_icon = $pakghor_services_image = '';
					if( $pakghor_service -> have_posts() )  : 
						while ( $pakghor_service -> have_posts() ) : $pakghor_service -> the_post();
						if( function_exists( 'cs_get_option' ) ){
							$pakghor_services_options 	= get_post_meta( get_the_ID(), '_pakghor_services_page_options', true );
							$pakghor_services_icon 	= isset( $pakghor_services_options['pakghor_services_icon'] ) ? $pakghor_services_options['pakghor_services_icon'] : '';
                            $pakghor_services_image = isset( $pakghor_services_options['pakghor_services_image'] ) ? $pakghor_services_options['pakghor_services_image'] : '';

                            $pakghor_services_image_src = wp_get_attachment_image_src($pakghor_services_image, 'full');
                            $pakghor_services_image_alt =  get_post_meta( $pakghor_services_image, '_wp_attachment_image_alt', true );
						}
				?>
					<div class="col-md-4 col-sm-6">
						<div class="service3-item">
							<?php if( !empty( $pakghor_services_image ) ) : ?>
                            <div class="service-item-icon">
								<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($pakghor_services_image_src[0]); ?>" alt="<?php echo esc_attr($pakghor_services_image_alt); ?>"></a>
                            </div>
							<?php  else: ?>
							<div class="service-item-icon">
								<i class="<?php echo esc_attr( $pakghor_services_icon ); ?>"></i>
							</div>
							<?php  endif; ?>
							<div class="service-item-des">
								<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
					        	<?php if(!empty($service_excerpt_word)): ?>
					        		<p><?php echo wp_trim_words(get_the_content(), $service_excerpt_word,''); ?></p>
					        	<?php endif; ?>
								<a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e( 'Read More', 'pakghor' ) ?></a>
							</div><!-- service-item-des -->
						</div><!-- service3-item -->
					</div>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
				</div>
			</div>
		</div> <!-- container -->
	</section><!-- Pricing section end-->

<?php }