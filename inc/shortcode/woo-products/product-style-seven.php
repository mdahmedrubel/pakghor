<?php
/**
 * Pakghor Food Products Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */
if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_product_seven extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'         			=> '',
			'subtitle'					=> '',
			'item_count' 				=> 8,
            'single_page_link'          => '',
            'show_rating'               => '',
            'pakghor_woo_excerpt_limit'    => 8,
            'is_product_menu'           => '',
            'category_options'          => '',
            'category'                  => '',
            'tag'                       => '',
            'postid'                    => '',
            'offset'                    => 0,   
			'order' 					=> '',
            'orderby'                   => '',
            'v_view_button_text'        => '',   
            'v_view_button_url'         => '',
			'section_bg'		        => '',
			'bg_size'                   => 'cover',
            'bg_repeat'                 => 'no-repeat',
            'bg_position'               => 'center',
            'section_overlay'           => '',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();
			pakghor_product_seven( $section_top_icon, $section_top_image, $section_top_image_width,  $title, $subtitle, $item_count, $single_page_link, $show_rating, $pakghor_woo_excerpt_limit, $is_product_menu, $category_options, $category, $tag, $postid, $offset, $order, $orderby, $v_view_button_text, $v_view_button_url, $section_bg, $bg_size, $bg_repeat, $bg_position, $section_overlay, $fc_class );
		return ob_get_clean();
	}
}

// Taxonomy query for this post type
if( ! function_exists('pakghor_product_seven_taxonomy') ) {
    function pakghor_product_seven_taxonomy() {
        $categories = get_terms(
                array(
                    'taxonmy'       =>'product_cat', 
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
if( ! function_exists('pakghor_product_seven_category') ) {
    function pakghor_product_seven_category($taxonomy){
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
$terms = pakghor_product_seven_category('product_cat');
$data = array(
    esc_html__('All Categories', 'pakghor') => 'p-all-cats'
    );
if($terms){
    foreach($terms as $term){
    $data[$term['name']] = $term['term_id'];
    }
}
vc_map( array(
	"name"			=> esc_html__( "Pakghor Product Style Seven", "pakghor" ),
	"base"			=> "pakghor_product_seven",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "WooCommerce", "pakghor" ),
	"params"		=> array(
        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Product Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Food Product Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Product Section Title", "pakghor" ),
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
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Product Count", "pakghor" ),
            "param_name"	=> "item_count",
            "admin_label"   => true,
            "description"   => esc_html__( 'How many Products want to display? Default is 8', 'pakghor' ),
            "group"			=> esc_html__( "General", "pakghor" ),
            "std"           => 8,
        ),
        array(
            "type"        => "checkbox",
            "heading"     => esc_html__( "Single Product Page Link?", "pakghor" ),
            "param_name"  => "single_page_link",
            "description" => esc_html__( "If you want to show details of the products in single page, please check the box.", "pakghor" ),
            "group"       => esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"        => "checkbox",
            "heading"     => esc_html__( "Show Product Rating?", "pakghor" ),
            "param_name"  => "show_rating",
            "description" => esc_html__( "If you want to show rating of the products, please check the box.", "pakghor" ),
            "group"       => esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__( "Product Short Description word limit", "pakghor" ),
            "param_name"    => "pakghor_woo_excerpt_limit",
            "admin_label"   => true,
            "description"   => esc_html__( 'The word lenth of short description of the product, Default is 8', 'pakghor' ),
            "group"         => esc_html__( "General", "pakghor" ),
            "std"           => 8,
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Select Product Category", "pakghor" ),
            "param_name"    => "category_options",
            "admin_label"   => true,
            "value"         => $data, // From Post type query
            "group"         => esc_html__( "Post Query", "pakghor" )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Filter by category slug:", "pakghor"),
            "param_name"    => "category",
            "description"   => esc_html__("To filter by category, enter category slugs here separated by comma (ex: cat1,cat2,cat3). Leave the field empty if you want to display the recent events", 'pakghor' ),
            'group'         => esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Filter by tag slug:", "pakghor"),
            "param_name"    => "tag",
            "description"   => esc_html__("To filter by tag, enter tag slugs here separated by comma (ex: tag1,tag2,tag3). Leave the field empty if you want to display the recent post", "pakghor"),
            'group'         => esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Filter by post id:", "pakghor"),
            "param_name"    => "postid",
            "description"   => esc_html__("To filter by specific post id, enter post ids here separated by comma (ex: 1,15,101). Leave the field empty if you want to display the recent post", "pakghor"),
            'group'         => esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"          => "dropdown",
            "group"         => esc_html__("General", "pakghor" ),
            "heading"       => esc_html__( "Product Menu Option", "pakghor" ),
            "param_name"    => "is_product_menu",                
            "value"     => array(
                esc_html__( "Menu Enable","pakghor")        => "",
                esc_html__( "Menu Disable", "pakghor" )     => "product-menu-hide",
            ),
        ),
        array(
            "type"      =>  "dropdown",
            "heading"   =>  esc_html__("Order", "pakghor" ),
            "param_name"=>  "order",
            "admin_label"=> true,
            "value"     => array(
                esc_html__( "Select Products Order", "pakghor" )   => "",
                esc_html__( "DESC","pakghor")    => "DESC",
                esc_html__( "ASC", "pakghor" )   => "ASC",
              ),
            "std"  => "DESC",
            "group"     =>  esc_html__("Post Query", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Products Order By", "pakghor" ),
            "group"         => esc_html__("Post Query", "pakghor"),
            "param_name"    => "orderby",
            "admin_label"   => true,
            "value"         => array(
                esc_html__( "Select Products order by","pakghor" ) => "",
                esc_html__( "Date", "pakghor" )      => "date",
                esc_html__( "Name", "pakghor" )      => "name",
                esc_html__( "Modified", "pakghor" )  => "modified",
                esc_html__( "Author", "pakghor" )    => "author",
                esc_html__( "Random", "pakghor" )    => "random",
                esc_html__( "Comment Count", "pakghor" )    => "comment_count",
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
            "type"          => "textfield",
            "heading"       => esc_html__( "View More Button Text", "pakghor" ),
            "param_name"    => "v_view_button_text",
            "description"   => esc_html__( "If you don't want to show Button leave blank", "pakghor" ),
            "group"         => esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__( "View More Button Url", "pakghor" ),
            "param_name"    => "v_view_button_url",
            "group"         => esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "If you don't want to show Button leave blank", "pakghor" ),
        ),
        array(
            "type"          => "attach_image",
            "heading"       => esc_html__( "Section Background Image", "pakghor" ),
            "param_name"    => "section_bg",
            "group"         => esc_html__( "General", "pakghor" ),
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
            "type"          => "colorpicker",
            "heading"       => esc_html__( "Section Background Overlay", "pakghor" ),
            "param_name"    => "section_overlay",
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

function pakghor_product_seven( $section_top_icon, $section_top_image, $section_top_image_width,  $title, $subtitle, $item_count, $single_page_link, $show_rating, $pakghor_woo_excerpt_limit, $is_product_menu, $category_options, $category, $tag, $postid, $offset, $order, $orderby, $v_view_button_text, $v_view_button_url, $section_bg, $bg_size, $bg_repeat, $bg_position, $section_overlay, $fc_class ) {
	$section_bg 	= wp_get_attachment_image_src( $section_bg, 'full' );
    wp_enqueue_script('pakghor-isotope-pkgd-js');
    wp_enqueue_script('pakghor-plugins-js');

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
    $wrapper_class = array('food-menu-item-wrapper') ;

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


    //Section Class
    $sec_classes = array('food-menu-2');
    if( !empty($fc_class) ) {
        $sec_classes[] = $fc_class;
    }
    $sec_class = implode(' ', $sec_classes);
    $section_attr = array();
    $section_attr[] = 'class="'. esc_attr($sec_class) .'"';
    if( !empty( $section_bg ) ){
        $section_attr[] ='style="background: url( ' .esc_url( $section_bg['0'] ). ' );
        background-repeat: '. esc_attr($bg_repeat) .'; 
        background-size: '. esc_attr($bg_size) .'; 
        background-position: '. esc_attr($bg_position) .'"';
    }
    // Overlay Class
    $overlay_classess = array('section-overlay','section-padding');
    $overlay_class = implode( ' ', $overlay_classess );
    $overlay_attr = array();
    $overlay_attr[] = 'class="'.esc_attr($overlay_class).'"';
    if( !empty($section_overlay) ){
        $overlay_attr[] = 'style="background-color:'. esc_attr( $section_overlay ) .'"';
    }
    $categories = explode(',', $category);
    $tags       = explode(',', $tag);
    $postids    = explode(',', $postid);
?>

	<!-- Food Products section-->
	<section <?php echo implode(' ', $section_attr); ?>>
        <div <?php echo implode(' ', $overlay_attr); ?>>
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
                <?php if ( class_exists('WooCommerce') ) :
                        if($is_product_menu =='') : ?>
                        <?php  
                            $product_cats   = get_terms( 'product_cat', array(
                                'hide_empty'    => true,
                            ) );
                        if( $product_cats ) :
                        ?>
                        <div id="filters" class="button-group">
    						<button  class="button button is-checked" data-filter="*"><?php echo esc_html__( 'Show all', 'pakghor' ) ?></button>
    						<?php foreach ( $product_cats as $product_cat ) : ?>
    						<button class="button" data-filter=".<?php echo esc_attr( $product_cat->slug ); ?>"><?php echo esc_html( $product_cat ->name ); ?></button>
    						<?php endforeach; ?>
    					</div><!--button group-->
                        <?php endif; ?>
                        <?php endif; ?>
    					<div class="grid">
    				<?php
                        if( $category_options ) :
                            $fproduct_style_seven_query = new WP_Query( array(
                                'post_type'             => 'product',
                                'posts_per_page'        => $item_count,
                                'ignore_sticky_post'    => true,
                                'post_status'           => 'publish',
                                'order'                 => $order,
                                'orderby'               => $orderby,
                                'offset'                => $offset,
                                'tax_query' => array(
                                        array (
                                            'taxonomy' => 'product_cat',
                                            'field' => 'term_id',
                                            'terms' => $category_options ,
                                        )
                                    ),
                                ) 
                            );  

                        elseif(!empty($postid)):
                            $fproduct_style_seven_query = new WP_Query( array(
                                'post_type'             => 'product',
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
                            $fproduct_style_seven_query = new WP_Query( array(
                                'post_type'             => 'product',
                                'posts_per_page'        => $item_count,
                                'ignore_sticky_post'    => true,
                                'post_status'           => 'publish',
                                'order'                 => $order,
                                'orderby'               => $orderby,
                                'offset'                => $offset,
                                'tax_query' => array(
                                        array (
                                            'taxonomy' => 'product_tag',
                                            'field' => 'slug',
                                            'terms' => $tags,
                                        )
                                    ),
                                ) 
                            );  
                        elseif( !empty($category) ) :
                            $fproduct_style_seven_query = new WP_Query( array(
                                'post_type'         => 'product',
                                'post_status'       => 'publish',
                                'posts_per_page'    => $item_count,
                                'order'             => $order,
                                'orderby'           => $orderby,
                                'offset'            => $offset,
                                'ignore_sticky_post'   => true,
                                'tax_query'         => array(
                                        array(
                                            'taxonomy'  => 'product_cat',
                                            'field'     => 'slug',
                                            'terms'     => $categories,
                                        ),

                                    ),
                                ) 
                            );
                        else:
                            $fproduct_style_seven_query = new WP_Query( array(
                                'post_type'         => 'product',
                                'post_status'       => 'publish',
                                'posts_per_page'    => $item_count,
                                'order'             => $order,
                                'orderby'           => $orderby,
                                'offset'            => $offset,
                                'ignore_sticky_post'   =>  true
                                )
                            );
                        endif;

                        if ( $fproduct_style_seven_query->have_posts() ) :
                            /* Start the Loop */
                            while ( $fproduct_style_seven_query->have_posts() ) : $fproduct_style_seven_query->the_post(); ?>
                            <div class="element-item col-md-4 col-sm-6 <?php pakghor_get_terms_link('product_cat'); ?>">
                                <div class="food-item">
                                    <?php if(has_post_thumbnail()): ?>
                                    <div class="food-item-img">
                                        <?php if( $single_page_link == true ) : ?>
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail() ?></a>
                                        <?php else: ?>
                                        <?php the_post_thumbnail() ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="food-item-details">
                                        <div class="dotted-title">
                                            <div class="dotted-name">
                                               <?php if( $single_page_link == true ) : ?>
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                <?php else:
                                                        the_title(); 
                                                    endif;
                                                ?>
                                            </div>
                                            <div class="dotted-dot"></div>
                                            <div class="dotted-price">
                                                <span><?php  global $product; ?>
                                                    <?php  $price = $product->get_price_html(); echo wp_kses_post( $price ); ?></span>
                                            </div>
                                        </div><!-- dotted title -->
                                        <p><?php echo wp_trim_words( get_the_content(), $pakghor_woo_excerpt_limit, '' ); ?></p>
                                        <?php 
                                            global $product;
                                            $woo_rating = $product->get_average_rating();
                                        if( $woo_rating > 0 && $show_rating == true ) :
                                         ?>
                                        <div class="rating-star"><?php pakghor_review($woo_rating); ?>
                                        </div>
                                        <?php endif; ?>
                                    </div><!-- food item details -->
                                </div>
                            </div> <!-- element-item -->
                        <?php endwhile; wp_reset_postdata();
                        else :
                            get_template_part( 'template-parts/content', 'none' );
                        endif; ?> 
                <?php endif; ?>
                        </div>
    				</div><!-- food-menu-item-wrapper -->
                    <?php if(!empty($v_view_button_text)) : ?>
                    <div class="food-menu-btn">
                        <a href="<?php echo esc_url($v_view_button_url) ?>" class="button"><?php echo esc_html($v_view_button_text); ?></a>
                    </div>
                    <?php endif; ?>
    			</div>
    		</div> <!-- container -->
        </div>
	</section><!-- Food Gallery section end -->

<?php }