<?php
/**
 * Pakghor Latest Post from Blog Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */
if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_latest_blog extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'         			=> '',
			'subtitle'					=> '',
			'item_count'				=> 3,
			'excerpt_word'				=> 15,
			'order'						=> '',
            'orderby'                   => '',
			'category_options'		    => '',
			'category'					=> '',
			'tag'						=> '',
			'postid'					=> '',
			'offset'					=> 0,	
			'section_bg_image_left'		=> '',
			'lbg_size'                  => '34%',
            'lbg_position'              => '-10% 100%',
            'section_bg_image_right'    => '',
            'rbg_size'                  => '34%',
            'rbg_position'              => '100% 0%',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();
			pakghor_latest_blog( $section_top_icon, $section_top_image, $section_top_image_width,  $title, $subtitle, $item_count, $excerpt_word, $order, $orderby, $category_options, $category, $tag, $postid, $offset, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class );
		return ob_get_clean();
	}
}

// Taxonomy query for this post type
if( ! function_exists('pakghor_post_taxonomy') ) {
    function pakghor_post_taxonomy() {
        $categories = get_terms(
                array(
                    'taxonmy'       =>'category', 
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

if( ! function_exists('pakghor_post_category') ) {
    function pakghor_post_category($taxonomy){
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
$terms = pakghor_post_category('category');
$data = array(
    esc_html__('All Categories', 'pakghor') => 'p-all-cats'
    );
if($terms){
    foreach($terms as $term){
    $data[$term['name']] = $term['term_id'];
    }
}


vc_map( array(
	"name"			=> esc_html__( "Pakghor Latest Post", "pakghor" ),
	"base"			=> "pakghor_latest_blog",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(
        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Latest Post Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Latest Post Section Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Latest Post Section Title", "pakghor" ),
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
            "heading"		=> esc_html__( "Latest Post Count", "pakghor" ),
            "param_name"	=> "item_count",
            "admin_label"	=> true,
            "std"			=> 3,
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "How many Posts want to display? Default is 4", "pakghor" ),
        ),
        array(
            "type"			=> "textfield",
            "heading"		=> esc_html__( "Post Excerpt Word Limit", "pakghor" ),
            "param_name"	=> "excerpt_word",
            "admin_label"	=> true,
            "std"			=> 15,
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "The limit of post Excerpt word limit, Default is 15", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Select Post Category", "pakghor" ),
            "param_name"    => "category_options",
            "admin_label"   => true,
            "value"         => $data, // From Post type query
            "group"         => esc_html__( "Post Query", "pakghor" )
        ),
        array(
            "type" => "textfield",
            "heading"       => esc_html__("Filter by Category slug:", "pakghor"),
            "param_name"    => "category",
            "description"   => esc_html__("To filter by Category, enter category slugs here separated by comma (ex: cat1,cat2,cat3). Leave the field empty if you want to display the recent events", 'pakghor' ),
            'group'			=> esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type" 			=> "textfield",
            "heading"       => esc_html__("Filter by Tags slug:", "pakghor"),
            "param_name"    => "tag",
            "description"   => esc_html__("To filter by Tags, enter Tag slugs here separated by comma (ex: tag1,tag2,tag3). Leave the field empty if you want to display the recent events", 'pakghor' ),
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
            "heading"   	=>  esc_html__("Order", "pakghor" ),
            "param_name"	=>  "order",
            "admin_label"	=> true,
            "value"     	=> array(
                esc_html__( "Select Latest Post Order", "pakghor" )   => "",
                esc_html__( "DESC","pakghor")    => "DESC",
                esc_html__( "ASC", "pakghor" )   => "ASC",
              ),
            "std"  			=> "DESC",
            "group"     	=>  esc_html__("Post Query", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Latest Post Order By", "pakghor" ),
            "group"         => esc_html__( "Post Query", "pakghor" ),
            "param_name"    => "orderby",
            "admin_label"   => true,
            "value"         => array(
                esc_html__( "Select Latest Post Order by","pakghor" ) => "",
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
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Section Background Image Left", "pakghor" ),
            "param_name"	=> "section_bg_image_left",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
             "type"          => "textfield",
            "heading"       => esc_html__("Left Background Size", "pakghor"),
            "param_name"    => "lbg_size",
            "description"   => esc_html__("Give your Left Background Image Size, Default is: 34%", 'pakghor' ),
            'std'           => '34%',
            'group'         => esc_html__( 'General', 'pakghor' )
        ),
        array(
             "type"          => "textfield",
            "heading"       => esc_html__("Left Background Position", "pakghor"),
            "param_name"    => "lbg_position",
            "std"           => "-10% 100%",
            "description"   => esc_html__("Give your Left Background Image Position, Default is: -10% 100%", 'pakghor' ),
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
            "std"           => '34%',
            "description"   => esc_html__("Give your Right Background Image Size, Default is: 34%", 'pakghor' ),
            "group"         => esc_html__( 'General', 'pakghor' )
        ),
        array(
             "type"          => "textfield",
            "heading"       => esc_html__("Right Background Position", "pakghor"),
            "param_name"    => "rbg_position",
            "description"   => esc_html__("Give your Right Background Image Position, Default is: 100% 0%", 'pakghor' ),
            "std"       => '100% 0%',
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

function pakghor_latest_blog( $section_top_icon, $section_top_image, $section_top_image_width,  $title, $subtitle, $item_count, $excerpt_word, $order, $orderby, $category_options, $category, $tag, $postid, $offset, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class ) { 

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


	// Css Classes
  	$sec_classes = array(
            'latest-blog',
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
                    <?php endif;

                    if($category_options):
                        $latest_post = new WP_Query( array(
                            'post_type'         => 'post',
                            'post_status'       => 'publish',
                            'posts_per_page'    => $item_count,
                            'order'             => $order,
                            'orderby'           => $orderby,
                            'offset'            => $offset,
                            'ignore_sticky_post'   => true,
                            'tax_query'         => array(
                                    array(
                                        'taxonomy'  => 'category',
                                        'field'     => 'term_id',
                                        'terms'     => $category_options,
                                    ),

                                ),
                            ) 
                        );
					elseif(!empty($postid)):
		                $latest_post = new WP_Query( array(
		                    'post_type'             => 'post',
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
		                $latest_post = new WP_Query( array(
		                    'post_type'				=> 'post',
		                    'posts_per_page'		=> $item_count,
		                    'ignore_sticky_post'	=> true,
		                    'post_status'           => 'publish',
		                    'order'                 => $order,
		                    'orderby'               => $orderby,
		                    'offset'                => $offset,
		                    'tax_query' => array(
			                        array (
			                            'taxonomy' => 'post_tag',
			                            'field' => 'slug',
			                            'terms' => $tags,
			                        )
		                    	),
		                	) 
	            		);  
					elseif( !empty($category) ) :
						$latest_post = new WP_Query( array(
							'post_type'			=> 'post',
							'post_status'		=> 'publish',
							'posts_per_page'	=> $item_count,
							'order'            	=> $order,
		                    'orderby'         	=> $orderby,
		                    'offset'            => $offset,
		                    'ignore_sticky_post'   => true,
		                    'tax_query'			=> array(
		                    		array(
		                    			'taxonomy' 	=> 'category',
			                            'field' 	=> 'slug',
			                            'terms' 	=> $categories,
		                    		),

		                    	),
							) 
						);
					else:
						$latest_post = new WP_Query( array(
							'post_type'			=> 'post',
							'post_status'		=> 'publish',
							'posts_per_page'	=> $item_count,
							'order'            	=> $order,
		                    'orderby'         	=> $orderby,
		                    'offset'            => $offset,
		                    'ignore_sticky_post'   =>  true
		                    )
		                );
					endif;
			?>
				<div class="post-item-wrapper">
                    <div <?php echo wp_kses_post($wrapper_attr); ?>>
					<?php if( $latest_post->have_posts() ) : 
						while ( $latest_post->have_posts() ) : $latest_post->the_post(); 
					?>
					<div class="col-md-4 col-sm-6">
						<div class="post-item">
							<div class="post-thumb">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('populer-post-home-369-299') ?></a>
							</div>
							<div class="post-content">
								<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="meta-post">
									<ul>
										<?php pakghor_posted_on(); 
                                        if (! post_password_required() && ( comments_open() || get_comments_number() ) ) {
                                            echo '<li class="post-comments"><i class="fa fa-commenting-o"></i>';
                                            comments_popup_link(
                                                sprintf(
                                                    wp_kses(
                                                        /* translators: %s: post title */
                                                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'pakghor' ),
                                                        array(
                                                            'span' => array(
                                                                'class' => array(),
                                                            ),
                                                        )
                                                    ),
                                                    get_the_title()
                                                )
                                            );
                                            echo '</li>';
                                        }
                                    ?>
									</ul>
								</div><!-- meta post -->
						        <div class="excerpt">
						        	<?php if(!empty($excerpt_word)): ?>
						        		<?php echo wp_trim_words(get_the_content(), $excerpt_word,''); ?>
						        	<?php endif; ?>
						        </div>
								<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html__( 'Read More', 'pakghor' ) ?></a>
							</div><!-- post content -->
						</div><!-- post item -->
					</div>
					<?php endwhile; wp_reset_postdata(); ?>
					<?php endif; ?>
                    </div>
				</div><!-- post item wrapper -->
			</div>
		</div> <!-- container -->
	</section><!-- service section end -->
<!-- end achievement-section -->
<?php }