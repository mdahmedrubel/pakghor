<?php
/**
 * Pakghor Food Package Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */
if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_food_pricing extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'						=> '',
			'subtitle'					=> '',
			'item_count'         		=> 3,
			'category'					=> '',
            'category_options'          => '',
			'tag'						=> '',
			'postid'					=> '',
			'offset'					=> 0,
			'order'						=> '',
			'orderby'					=> '',
			'section_bg_image_left'		=> '',
			'lbg_size'                  => 'auto',
            'lbg_position'              => '-28% 0',
            'section_bg_image_right'    => '',
            'rbg_size'                  => '17%',
            'rbg_position'              => 'top right',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();
		pakghor_food_pricing( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $item_count, $category_options,$category, $tag, $postid, $offset, $order, $orderby, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class );

		return ob_get_clean();
	}
}

// Taxonomy query for this post type
if( ! function_exists('pakghor_food_package_taxonomy') ) {
    function pakghor_food_package_taxonomy() {
        $categories = get_terms(
                array(
                    'taxonmy'       =>'pricing_category', 
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
if( ! function_exists('pakghor_food_package_category') ) {
    function pakghor_food_package_category($taxonomy){
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
$terms = pakghor_food_package_category('pricing_category');
$data = array(
    esc_html__('All Categories', 'pakghor') => 'p-all-cats'
    );
if($terms){
    foreach($terms as $term){
    $data[$term['name']] = $term['term_id'];
    }
}

vc_map( array(
	"name"			=> esc_html__( "Pakghor Pricing Table", "pakghor" ),
	"base"			=> "pakghor_food_pricing",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(
        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Package Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Package Section Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Package Section Title", "pakghor" ),
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
            "heading"		=> esc_html__( "Pricing Table Count", "pakghor" ),
            "param_name"	=> "item_count",
            "group"			=> esc_html__( "General", "pakghor" ),
            "std"			=> 3,
            "description"   => esc_html__( "How many Packages want to display? Default is 3", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Select Pricing Category", "pakghor" ),
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
            "type"      =>  "dropdown",
            "heading"   =>  esc_html__("Order", "pakghor" ),
            "param_name"=>  "order",
            "admin_label"=> true,
            "value"     => array(
                esc_html__( "Select Package Order", "pakghor" )   => "",
                esc_html__( "DESC","pakghor")    => "DESC",
                esc_html__( "ASC", "pakghor" )   => "ASC",
              ),
            "std"  => "DESC",
            "group"     =>  esc_html__("Post Query", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Package Order By", "pakghor" ),
            "group"         => esc_html__( "Post Query", "pakghor" ),
            "param_name"    => "orderby",
            "admin_label"   => true,
            "value"         => array(
                esc_html__( "Select Package order by","pakghor" ) => "",
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
            "std"           => "-28% 0",
            "description"   => esc_html__("Give your Left Background Image Position, Default is: -28% 0", 'pakghor' ),
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
            "std"           => '17%',
            "description"   => esc_html__("Give your Right Background Image Size, Default is: 17%", 'pakghor' ),
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

function pakghor_food_pricing( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $item_count, $category_options, $category, $tag, $postid, $offset, $order, $orderby, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class ) {
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
    $wrapper_class = array('row') ;

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

    // Section class
    $sec_classes = array(
            'pricing',
            'section-padding'
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
    $tags 		= explode(',', $tag);
    $postids 	= explode(',', $postid);

?>
	<!-- pricing section -->
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
                <div <?php echo wp_kses_post($wrapper_attr); ?>>
				<?php 
					$_pakghor_pricing_options = $pakghor_pricing_currency	= $pakghor_package_price = $pakghor_package_image = $pakghor_package_pricing_items = $pakghor_package_book_btn = $pakghor_package_book_url = '';
                if( $category_options ) :
                    $pricing_table = new WP_Query( array(
                            'post_type'             => 'pakghor_pricing',
                            'posts_per_page'        => $item_count,
                            'ignore_sticky_post'    => true,
                            'post_status'           => 'publish',
                            'order'                 => $order,
                            'orderby'               => $orderby,
                            'offset'                => $offset,
                            'tax_query' => array(
                                    array (
                                        'taxonomy' => 'pricing_category',
                                        'field' => 'term_id',
                                        'terms' => $category_options ,
                                    )
                                ),
                            ) 
                        ); 
				elseif(!empty($postid)):
	                $pricing_table  = new WP_Query( array(
	                    'post_type'             => 'pakghor_pricing',
	                    'post__in'              => $postids,
	                    'posts_per_page'        => $item_count,
	                    'ignore_sticky_post'    => true,
	                    'post_status'           => 'publish',
	                    'order'                 => $order,
	                    'orderby'               => $orderby,
	                    'offset'                => $offset                       
	                ) );           
            	elseif(!empty($tag)):
	                $pricing_table  = new WP_Query( array(
	                    'post_type'				=> 'pakghor_pricing',
	                    'posts_per_page'		=> $item_count,
	                    'ignore_sticky_post'	=> true,
	                    'post_status'           => 'publish',
	                    'order'                 => $order,
	                    'orderby'               => $orderby,
	                    'offset'                => $offset,
	                    'tax_query' => array(
	                        array (
	                            'taxonomy' => 'pricing_tag',
	                            'field' => 'slug',
	                            'terms' => $tags,
	                        )
	                    ),
	                ) );  
				elseif( !empty($category) ) :
					$pricing_table  = new WP_Query( array(
						'post_type'			=> 'pakghor_pricing',
						'post_status'		=> 'publish',
						'posts_per_page'	=> $item_count,
						'order'            	=> $order,
	                    'orderby'         	=> $orderby,
	                    'offset'            => $offset,
	                    'ignore_sticky_post'   => true,
	                    'tax_query'			=> array(
	                    		array(
	                    			'taxonomy' 	=> 'pricing_category',
		                            'field' 	=> 'slug',
		                            'terms' 	=> $categories,
	                    		),

	                    	),
						) 
					);
				else:
					$pricing_table  = new WP_Query( array(
						'post_type'			=> 'pakghor_pricing',
						'post_status'		=> 'publish',
						'posts_per_page'	=> $item_count,
						'order'            	=> $order,
	                    'orderby'         	=> $orderby,
	                    'offset'            => $offset,
	                    'ignore_sticky_post'   =>  true
	                    )
	                );
				endif;
				if( $pricing_table -> have_posts() )  : 
						while ( $pricing_table -> have_posts() ) : $pricing_table -> the_post();

							if ( function_exists('cs_get_option') ):
								$_pakghor_pricing_options = get_post_meta( get_the_ID(), '_pakghor_pricing_options', true );
								$pakghor_pricing_currency   = isset( $_pakghor_pricing_options['pakghor_pricing_currency'] ) ? $_pakghor_pricing_options['pakghor_pricing_currency'] : '';
								$pakghor_package_price   = isset( $_pakghor_pricing_options['pakghor_package_price'] ) ? $_pakghor_pricing_options['pakghor_package_price'] : '';
								$pakghor_package_image   = isset( $_pakghor_pricing_options['pakghor_package_image'] ) ? $_pakghor_pricing_options['pakghor_package_image'] : '';
								$pakghor_package_image_src 	= wp_get_attachment_image_src( $pakghor_package_image, 'full' );
								$pakghor_package_pricing_items = isset( $_pakghor_pricing_options['pakghor_package_pricing_items'] ) ? $_pakghor_pricing_options['pakghor_package_pricing_items'] : '';
								$pakghor_package_book_btn 		= isset( $_pakghor_pricing_options['pakghor_package_book_btn'] ) ? $_pakghor_pricing_options['pakghor_package_book_btn'] : '';
								$pakghor_package_book_url 		= isset( $_pakghor_pricing_options['pakghor_package_book_url'] ) ? $_pakghor_pricing_options['pakghor_package_book_url'] : '';
							endif;
				?>
            
				<div class="col-md-4 col-sm-6">
					<div class="pricing-table">
						<div class="pricing-head">
							<h2><?php the_title(); ?></h2>
							<?php  if( !empty( $pakghor_package_price ) ) : ?>
							<span><?php echo esc_html( $pakghor_pricing_currency ) ?><?php echo esc_html( $pakghor_package_price ); ?></span>
							<?php endif; ?>
						</div>
						<?php if( has_post_thumbnail() ) : ?>
						<div class="pricing-img">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>
						<?php if($pakghor_package_pricing_items): ?>
						<ul>
							<?php foreach ( $pakghor_package_pricing_items as $pakghor_package_pricing_item ) : ?>
							<li><?php echo esc_html( $pakghor_package_pricing_item['pakghor_package_pricing_items_name'] ); ?></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
						<?php if( !empty( $pakghor_package_book_btn ) || !empty( $pakghor_package_book_url ) ) : ?>
						<a href="<?php echo esc_url( $pakghor_package_book_url ); ?>" class="button"><?php echo esc_html( $pakghor_package_book_btn ); ?></a>
						<?php endif; ?>
					</div><!-- pricing-table -->
				</div>
        
				<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
                </div>
			</div>
		</div> <!-- container -->
	</section><!-- pricing section end-->
<?php }