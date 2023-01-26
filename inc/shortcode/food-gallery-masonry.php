<?php
/**
 * Pakghor Food Gallery Masonry Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */
if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_food_gallery_masonry extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'         			=> '',
			'subtitle'					=> '',
			'item_count' 				=> 6,
            'is_gallery_menu'           => '',
            'category_options'          => '',
            'category'                  => '',
            'tag'                       => '',
            'postid'                    => '',
            'offset'                    => 0,
			'order' 					=> '',
            'orderby'                   => '',
			'view_button_text' 			=> '',
			'view_button_url' 			=> '',
			'section_bg_image_left'		=> '',
			'lbg_size'                  => '25%',
            'lbg_position'              => 'top left',
            'section_bg_image_right'    => '',
            'rbg_size'                  => '45%',
            'rbg_position'              => 'top right',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();
			pakghor_food_gallery_masonry( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $item_count, $is_gallery_menu, $category_options, $category, $tag, $postid, $offset, $order, $orderby, $view_button_text, $view_button_url, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class );
		return ob_get_clean();
	}
}


// Taxonomy query for this post type
if( ! function_exists('pakghor_gallery_mason_taxonomy') ) {
    function pakghor_gallery_mason_taxonomy() {
        $categories = get_terms(
                array(
                    'taxonmy'       =>'gallery-category', 
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
if( ! function_exists('pakghor_gallery_mason_category') ) {
    function pakghor_gallery_mason_category($taxonomy){
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
$terms = pakghor_gallery_mason_category('gallery-category');
$data = array(
    esc_html__('All Categories', 'pakghor') => 'p-all-cats'
    );
if($terms){
    foreach($terms as $term){
    $data[$term['name']] = $term['term_id'];
    }
}

vc_map( array(
	"name"			=> esc_html__( "Pakghor Gallery Masonry", "pakghor" ),
	"base"			=> "pakghor_food_gallery_masonry",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(
        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Food Gallery Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Food Gallery Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Food Gallery Section Title", "pakghor" ),
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
            "type"          => "textfield",
            "heading"       => esc_html__( "Gallery Item Count", "pakghor" ),
            "param_name"    => "item_count",
            "admin_label"   => true,
            "description"   => esc_html__( 'How many posts want to display? Default is 6', 'pakghor' ),
            "group"         => esc_html__( "General", "pakghor" ),
            "std"           => 6,
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Select Gallery Category", "pakghor" ),
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
            "heading"       => esc_html__( "Gallery Menu Option", "pakghor" ),
            "param_name"    => "is_gallery_menu",                
            "value"     => array(
                esc_html__( "Menu Enable","pakghor")        => "",
                esc_html__( "Menu Disable", "pakghor" )     => "gallery-menu-hide",
            ),
        ),
        array(
            "type"      =>  "dropdown",
            "heading"   =>  esc_html__("Order", "pakghor" ),
            "param_name"=>  "order",
            "admin_label"=> true,
            "value"     => array(
                esc_html__( "Select Gallery Order", "pakghor" )   => "",
                esc_html__( "DESC","pakghor")    => "DESC",
                esc_html__( "ASC", "pakghor" )   => "ASC",
              ),
            "std"  => "DESC",
            "group"     =>  esc_html__("Post Query", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Gallery Order By", "pakghor" ),
            "group"         => esc_html__( "Post Query", "pakghor"),
            "param_name"    => "orderby",
            "admin_label"   => true,
            "value"         => array(
                esc_html__( "Select Gallery order by","pakghor" ) => "",
                esc_html__( "Date", "pakghor" )      => "date",
                esc_html__( "Name", "pakghor" )      => "name",
                esc_html__( "Modified", "pakghor" )  => "modified",
                esc_html__( "Author", "pakghor" )    => "author",
                esc_html__( "Random", "pakghor" )    => "rand",
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
            "type"			=> "textfield",
            "heading"		=> esc_html__( "View More Button Text", "pakghor" ),
            "param_name"	=> "view_button_text",
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "If you don't want to show Button leave balnk.", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "View More Button Url", "pakghor" ),
            "param_name"	=> "view_button_url",
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "If you don't want to show Button leave balnk.", "pakghor" ),
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
            "description"   => esc_html__("Give your Left Background Image Size, Default is: 25%", 'pakghor' ),
            'std'           => '25%',
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
            "std"           => '45%',
            "description"   => esc_html__("Give your Right Background Image Size, Default is: 45%", 'pakghor' ),
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
			"group"			=> esc_html__( "Custom Style", "pakghor" ),
		)
	)

) );
endif;

function pakghor_food_gallery_masonry( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $item_count, $is_gallery_menu, $category_options, $category, $tag, $postid, $offset, $order, $orderby, $view_button_text, $view_button_url, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class ) {
    
    wp_enqueue_style('pakghor-lightbox');
    wp_enqueue_script('pakghor-lightbox-js');
    wp_enqueue_script('pakghor-isotope-pkgd-js');
    wp_enqueue_script('pakghor-plugins-js');


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
    $product_wrapper_class = array( 'row' );
    $top_img_class = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $top_icon_class[] = $animation_classes;
            $top_img_class[] = $animation_classes;
            $product_wrapper_class[] = $animation_classes;
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
    $product_wrapper_classes = implode(  ' ', $product_wrapper_class);
    $product_wrapper_attr = 'class="' .esc_attr($product_wrapper_classes). '"';


    // Css Classes
    $sec_classes = array(
        'food-gallery',
        'section-padding',
        'style-2'
    );
    if( !empty($fc_class) ) {
        $sec_classes[] = $fc_class;
    }
    $sec_class = implode(' ', $sec_classes);
    $section_attr = array();
    $section_attr[] = 'class="'. esc_attr($sec_class) .'"';
    if( !empty($section_bg_image_left) || !empty($section_bg_image_right) ){
        $section_attr[] ='style="background: url( ' .esc_url( $section_bg_image_left['0'] ). ' ) no-repeat, url('.esc_url($section_bg_image_right['0']).') no-repeat;
        background-size: '.esc_attr($lbg_size).', '.esc_attr($rbg_size).'; 
        background-position: '.esc_attr($lbg_position).','.esc_attr($rbg_position).' "';
    }
    $categories = explode(',', $category);
    $tags       = explode(',', $tag);
    $postids    = explode(',', $postid);

?>
	<!-- Food Gallery section-->
	<section <?php echo implode(' ', $section_attr) ?>>
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
                    <div <?php echo wp_kses_post($product_wrapper_attr) ?>>
                    <?php if( $is_gallery_menu == '' ): ?>
                    <?php  
                        $gallery_cats   = get_terms( 'gallery-category', array(
                            'hide_empty'    => true,
                        ) );
                    if( $gallery_cats ) :
                    ?>
					<div id="filters3" class="button-group3">
						<button class="button is-checked" data-filter="*"><?php echo esc_html__( 'show all', 'pakghor' ) ?></button>
						<?php 
							foreach ( $gallery_cats as $gallery_cat ) :
						 ?>
						<button class="button" data-filter=".<?php echo esc_attr( $gallery_cat->slug ); ?>"><?php echo esc_html( $gallery_cat->name ); ?></button>
						<?php endforeach; ?>
					</div><!--button group-->
                    <?php endif; ?>
                    <?php endif;  ?>
					<div class="grid3">
						<div class="grid-sizer"></div>
				<?php
                    if( $category_options ) :
                        $food_galleries = new WP_Query( array(
                                'post_type'             => 'pakghor_gallery',
                                'posts_per_page'        => $item_count,
                                'ignore_sticky_post'    => true,
                                'post_status'           => 'publish',
                                'order'                 => $order,
                                'orderby'               => $orderby,
                                'offset'                => $offset,
                                'tax_query' => array(
                                        array (
                                            'taxonomy' => 'gallery-category',
                                            'field' => 'term_id',
                                            'terms' => $category_options ,
                                        )
                                    ),
                                ) 
                            );  
                    elseif(!empty($postid)):
                        $food_galleries = new WP_Query( array(
                            'post_type'             => 'pakghor_gallery',
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
                        $food_galleries = new WP_Query( array(
                            'post_type'             => 'pakghor_gallery',
                            'posts_per_page'        => $item_count,
                            'ignore_sticky_post'    => true,
                            'post_status'           => 'publish',
                            'order'                 => $order,
                            'orderby'               => $orderby,
                            'offset'                => $offset,
                            'tax_query' => array(
                                    array (
                                        'taxonomy' => 'gallery-tag',
                                        'field' => 'slug',
                                        'terms' => $tags,
                                    )
                                ),
                            ) 
                        );  
                    elseif( !empty($category) ) :
                        $food_galleries = new WP_Query( array(
                            'post_type'         => 'pakghor_gallery',
                            'post_status'       => 'publish',
                            'posts_per_page'    => $item_count,
                            'order'             => $order,
                            'orderby'           => $orderby,
                            'offset'            => $offset,
                            'ignore_sticky_post'   => true,
                            'tax_query'         => array(
                                    array(
                                        'taxonomy'  => 'gallery-category',
                                        'field'     => 'slug',
                                        'terms'     => $categories,
                                    ),

                                ),
                            ) 
                        );
                    else:
                        $food_galleries = new WP_Query( array(
                            'post_type'         => 'pakghor_gallery',
                            'post_status'       => 'publish',
                            'posts_per_page'    => $item_count,
                            'order'             => $order,
                            'orderby'           => $orderby,
                            'offset'            => $offset,
                            'ignore_sticky_post'   =>  true
                            )
                        );
                    endif;
                    if ( $food_galleries->have_posts() ) :
                        /* Start the Loop */
                        while ( $food_galleries->have_posts() ) : $food_galleries->the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */

                            get_template_part( 'template-parts/content-gallery', 'masonry' );
                        endwhile; wp_reset_postdata();
                    else :
                        get_template_part( 'template-parts/content', 'none' );
                    endif; 
                ?>
					</div><!-- grid2 -->
                </div>
				<!-- food-menu-item-wrapper -->
				<?php if( !empty( $view_button_text ) || !empty( $view_button_url ) ) : ?>
				<div class="food-gallery-btn">
					<a href="<?php  echo esc_url( $view_button_url ); ?>" class="button"><?php echo esc_html( $view_button_text ) ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div> <!-- container -->
	</section><!-- Food Gallery section end -->
<?php }