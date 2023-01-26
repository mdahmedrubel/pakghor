<?php
/**
 * Pakghor Testimonial Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */

if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_testimonial extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'         			=> '',
			'subtitle'					=> '',
			'item_count'				=> 4,
			'testimonial_excerpt_word'	=> 24,
			'order'						=> '',
			'orderby'					=> '',
            'category_options'          => '',
			'category'					=> '',
			'tag'						=> '',
			'offset'					=> 0,
			'section_bg_image'			=> '',
			'bg_size'                   => 'cover',
            'bg_repeat'                 => 'no-repeat',
            'bg_position'               => 'center',
			'section_overlay'		    => 'rgba(0,0,0,0.9)',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();

			pakghor_testimonial( $section_top_icon, $section_top_image, $section_top_image_width, $title, $subtitle, $item_count, $testimonial_excerpt_word, $order, $orderby, $category_options, $category, $tag, $offset, $section_bg_image, $bg_size, $bg_repeat, $bg_position, $section_overlay, $fc_class );
		return ob_get_clean();
	}
}

// Taxonomy query for this post type
if( ! function_exists('pakghor_testimonial_taxonomy') ) {
    function pakghor_testimonial_taxonomy() {
        $categories = get_terms(
                array(
                    'taxonmy'       =>'testimonial_category', 
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
if( ! function_exists('pakghor_testimonial_category') ) {
    function pakghor_testimonial_category($taxonomy){
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
$terms = pakghor_testimonial_category('testimonial_category');
$data = array(
    esc_html__('All Categories', 'pakghor') => 'p-all-cats'
    );
if($terms){
    foreach($terms as $term){
    $data[$term['name']] = $term['term_id'];
    }
}
vc_map( array(
	"name"			=> esc_html__( "Pakghor Testimonial", "pakghor" ),
	"base"			=> "pakghor_testimonial",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(

        array(
            "type"			=> "iconpicker",
            "heading"		=>  esc_html__( "Testimonial Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Testimonial Section Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Testimonial Section Title", "pakghor" ),
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
            "heading"		=> esc_html__( "Testimonial Count", "pakghor" ),
            "param_name"	=> "item_count",
            "std"			=> 4,
            "admin_label"	=> true,
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "How many Testimonials want to display? Default is 4", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Testimonial Excerpt Word Limit", "pakghor" ),
            "param_name"	=> "testimonial_excerpt_word",
            "admin_label"	=> true,
            "std"			=> 24,
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "The limit of Testimonial Excerpt word limit ,Default is 18", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Select Testimonial Category", "pakghor" ),
            "param_name"    => "category_options",
            "admin_label"   => true,
            "value"         => $data, // From Post type query
            "group"         => esc_html__( "Post Query", "pakghor" )
        ),
        array(
            "type" => "textfield",
            "heading"       => esc_html__("Filter by Category slug:", "pakghor"),
            "param_name"    => "category",
            "description"   => esc_html__("To filter by category, enter category slugs here separated by comma (ex: cat1,cat2,cat3). Leave the field empty if you want to display the recent events", 'pakghor' ),
            'group'			=> esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type" => "textfield",
            "heading"       => esc_html__("Filter by tag slug:", "pakghor"),
            "param_name"    => "tag",
            "description"   => esc_html__("To filter by tag, enter tag slugs here separated by comma (ex: tag1,tag2,tag3). Leave the field empty if you want to display the recent post", "pakghor"),
            'group'         => esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type" => "textfield",
            "heading"       => esc_html__("Filter by post id:", "pakghor"),
            "param_name"    => "postid",
            "description"   => esc_html__("To filter by specific post id, enter post ids here separated by comma (ex: 1,15,101). Leave the field empty if you want to display the recent post", "pakghor"),
            'group'         => esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"      =>  "dropdown",
            "heading"   =>  esc_html__("Order", "pakghor" ),
            "param_name"=>  "order",
            "admin_label"=> true,
            "value"     => array(
                esc_html__( "Select Testimonial Order", "pakghor" )   => "",
                esc_html__( "DESC","pakghor")    => "DESC",
                esc_html__( "ASC", "pakghor" )   => "ASC",
              ),
            "std"  => "DESC",
            "group"     =>  esc_html__("Post Query", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Testimonial Order By", "pakghor" ),
            "group"         => esc_html__( "Post Query", "pakghor" ),
            "param_name"    => "orderby",
            "admin_label"   => true,
            "value"         => array(
                esc_html__( "Select Testimonial Order by","pakghor" ) 	=> "",
                esc_html__( "Date", "pakghor" )      		=> "date",
                esc_html__( "Name", "pakghor" )      		=> "name",
                esc_html__( "Modified", "pakghor" )  		=> "modified",
                esc_html__( "Author", "pakghor" )    		=> "author",
                esc_html__( "Random", "pakghor" )    		=> "random",
                esc_html__( "Comment Count", "pakghor" )   => "comment_count",
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
            "heading"		=> esc_html__( "Section Background Overlay", "pakghor" ),
            "param_name"	=> "section_overlay",
            "std"           => "rgba(0,0,0,0.9)",
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


function pakghor_testimonial( $section_top_icon, $section_top_image, $section_top_image_width, $title, $subtitle, $item_count, $testimonial_excerpt_word, $order, $orderby,$category_options, $category, $tag, $offset, $section_bg_image, $bg_size, $bg_repeat, $bg_position, $section_overlay, $fc_class ) {

	$section_bg_image 	= wp_get_attachment_image_src( $section_bg_image, 'full' );

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
    $swiper_wrapper_class = array('swiper-wrapper') ;

    $top_img_class = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $top_icon_class[] = $animation_classes;
            $top_img_class[] = $animation_classes;
            $swiper_wrapper_class[] = $animation_classes;
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

    $swiper_wrapper_classes = implode(  ' ', $swiper_wrapper_class );
    $swiper_wrapper_attr = 'class="' .esc_attr($swiper_wrapper_classes). '"';

	// Css Classes
    $sec_classes = array(
            'customer-review'
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
    $categories = explode(',', $category);
    $tags 		= explode(',', $tag);
    $pakghor_client_rating = '';

?>
	<!-- Testimonial section-->
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
                        <?php endif;

                        if( $category_options ) :
                            $testimonial_post = new WP_Query( array(
                                'post_type'             => 'pakghor_testimonial',
                                'posts_per_page'        => $item_count,
                                'ignore_sticky_post'    => true,
                                'post_status'           => 'publish',
                                'order'                 => $order,
                                'orderby'               => $orderby,
                                'offset'                => $offset,
                                'tax_query' => array(
                                        array (
                                            'taxonomy' => 'testimonial_category',
                                            'field' => 'term_id',
                                            'terms' => $category_options ,
                                        )
                                    ),
                                ) 
                            );  
						elseif(!empty($postid)):
		                $testimonial_post = new WP_Query( array(
		                    'post_type'             => 'pakghor_testimonial',
		                    'post__in'              => $postids,
		                    'posts_per_page'        => $item_count,
		                    'ignore_sticky_post'    => true,
		                    'post_status'           => 'publish',
		                    'order'                 => $order,
		                    'orderby'               => $orderby,
		                    'offset'                => $offset                       
		                ) );           
		            	elseif(!empty($tag)):
		                $testimonial_post = new WP_Query( array(
		                    'post_type'				=> 'pakghor_testimonial',
		                    'posts_per_page'		=> $item_count,
		                    'ignore_sticky_post'	=> true,
		                    'post_status'           => 'publish',
		                    'order'                 => $order,
		                    'orderby'               => $orderby,
		                    'offset'                => $offset,
		                    'tax_query' => array(
		                        array (
		                            'taxonomy' => 'testimonial_tag',
		                            'field' => 'slug',
		                            'terms' => $tags,
		                        )
		                    ),
		                ) );  
						elseif( !empty($category) ) :
						$testimonial_post = new WP_Query( array(
							'post_type'			=> 'pakghor_testimonial',
							'post_status'		=> 'publish',
							'posts_per_page'	=> $item_count,
							'order'            	=> $order,
		                    'orderby'         	=> $orderby,
		                    'offset'            => $offset,
		                    'ignore_sticky_post'   => true,
		                    'tax_query'			=> array(
		                    		array(
		                    			'taxonomy' 	=> 'testimonial_category',
			                            'field' 	=> 'slug',
			                            'terms' 	=> $categories,
		                    		),

		                    	),
							) 
						);
						else:
						$testimonial_post = new WP_Query( array(
							'post_type'			=> 'pakghor_testimonial',
							'post_status'		=> 'publish',
							'posts_per_page'	=> $item_count,
							'order'            	=> $order,
		                    'orderby'         	=> $orderby,
		                    'offset'            => $offset,
		                    'ignore_sticky_post'   =>  true
		                    )
		                );
						endif;
						if( $testimonial_post -> have_posts() ) : ?>
						<div class="swiper-container">
					       <div <?php echo wp_kses_post( $swiper_wrapper_attr); ?>> 
								<?php while ( $testimonial_post -> have_posts() ) : $testimonial_post -> the_post();

									if( function_exists('cs_get_option') ){
									$_pakghor_testimonial_page_options	= get_post_meta( get_the_ID(), '_pakghor_testimonial_page_options', true );
									$pakghor_client_rating 			= isset( $_pakghor_testimonial_page_options['pakghor_client_rating']) ? $_pakghor_testimonial_page_options['pakghor_client_rating'] : '';
									}
								?>
					            <div class="swiper-slide">
					            	<?php if( has_post_thumbnail() ) : ?>
					            	<div class="customer-img">
					            		<?php the_post_thumbnail(); ?>
					            	</div><!-- customer-img -->
					            	<?php endif; ?>
					            	<div class="customer-review-details">
							             <?php if(!empty($testimonial_excerpt_word)): ?>
							        	<p><?php echo wp_trim_words(get_the_content(), $testimonial_excerpt_word,''); ?></p>
							             <?php endif; ?>
					            		<h2><?php the_title(); ?></h2>
					            		<?php if(!empty($pakghor_client_rating)): ?>
					            		<div class="rating-star">
					            			<?php pakghor_review($pakghor_client_rating); ?>
					            		</div><!-- rating star -->
					            		<?php endif; ?>
					            	</div><!-- customer-review-details -->
					            </div><!-- swiper-slide -->
								<?php endwhile; wp_reset_postdata(); ?>
					        </div>
					        <!-- Add Pagination -->
					        <div class="swiper-pagination"></div>
						</div>
					<?php endif; ?>
				</div>
			</div> <!-- container -->
		</div>
	</section><!-- Testimonial section end -->

<?php }