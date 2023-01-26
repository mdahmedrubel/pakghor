<?php
/**
 * Pakghor Team  Shortcode
 *
 * @link https://codex.wordpress.org/Shortcode_API
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */
if( function_exists( 'vc_map' ) ) :
class WPBakeryShortcode_pakghor_team extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'section_top_icon'			=> '',
			'section_top_image'			=> '',
            'section_top_image_width'   => '', 
			'title'         			=> '',
			'subtitle'					=> '',
			'item_count'				=> 4,
			'order'						=> '',
			'orderby'					=> '',
            'category_options'          => '',
			'category'					=> '',
			'tag'						=> '',
			'postid'					=> '',
			'offset'					=> 0,		
			'team_style'				=> '',
			'section_bg_image_left'		=> '',
			'lbg_size'                  => 'auto',
            'lbg_position'              => 'bottom left',
            'section_bg_image_right'    => '',
            'rbg_size'                  => 'auto',
            'rbg_position'              => 'top right',
			'fc_class'					=> '',
		), $atts ) );
		ob_start();

			pakghor_team( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $item_count, $order, $orderby, $category_options, $category, $tag, $postid, $offset, $team_style, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class );
		return ob_get_clean();
	}
}

// Taxonomy query for this post type
if( ! function_exists('pakghor_team_taxonomy') ) {
    function pakghor_team_taxonomy() {
        $categories = get_terms(
                array(
                    'taxonmy'       =>'team_category', 
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
if( ! function_exists('pakghor_team_category') ) {
    function pakghor_team_category($taxonomy){
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
$terms = pakghor_team_category('team_category');
$data = array(
    esc_html__('All Categories', 'pakghor') => 'p-all-cats'
    );
if($terms){
    foreach($terms as $term){
    $data[$term['name']] = $term['term_id'];
    }
}
vc_map( array(
	"name"			=> esc_html__( "Pakghor Team Member", "pakghor" ),
	"base"			=> "pakghor_team",
	"class"			=> "",
    "icon"          => "fa fa-cutlery",
	"category"		=> esc_html__( "Pakghor", "pakghor" ),
	"params"		=> array(

		array(
	    	"type"        	=> "dropdown",
	    	"heading"     	=> esc_html__( "Select Team Style", "pakghor" ),
	    	"param_name"  	=> "team_style",
	    	"admin_label" 	=> true,
	    	"value"       	=> array(
	        	esc_html__("Team Style One", "pakghor")  	=> "one",
	        	esc_html__("Team Style Two", "pakghor")  	=> "two",
	        ),
	      	"std"         	=> "one", // Your default value
	      	"description" 	=> esc_html__("Team Member Style", "pakghor" ),
            "group"			=> esc_html__( "General", "pakghor" ),
	    ),
        array(
            "type"			=> "iconpicker",
            "heading"		=> esc_html__( "Team Member Section Top Icon", "pakghor" ),
            "param_name"	=> "section_top_icon",
            "group"			=> esc_html__( "General", "pakghor" ),
        ),
        array(
            "type"			=> "attach_image",
            "heading"		=> esc_html__( "Team Member Section Top Image", "pakghor" ),
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
            "heading"		=> esc_html__( "Team Section Title", "pakghor" ),
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
            "heading"		=> esc_html__( "Member Count", "pakghor" ),
            "param_name"	=> "item_count",
            "std"			=> 4,
            "group"			=> esc_html__( "General", "pakghor" ),
            "description"   => esc_html__( "How many members want to display? Default is 4", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Select Team Category", "pakghor" ),
            "param_name"    => "category_options",
            "admin_label"   => true,
            "value"         => $data, // From Post type query
            "group"         => esc_html__( "Post Query", "pakghor" )
        ),
       	array(
            "type"          => "textfield",
            "heading"       => esc_html__("Filter by post id:", "pakghor"),
            "param_name"    => "postid",
            "description"   => esc_html__("To filter by specific post id, enter post ids here separated by comma (ex: 1,15,101). Leave the field empty if you want to display the recent post", "pakghor"),
            'group'         => esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Filter by tag slug:", "pakghor"),
            "param_name"    => "tag",
            "description"   => esc_html__("To filter by tag, enter tag slugs here separated by comma (ex: tag1,tag2,tag3). Leave the field empty if you want to display the recent post", "pakghor"),
            'group'			=> esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type" 			=> "textfield",
            "heading"       => esc_html__("Filter by category slug:", "pakghor"),
            "param_name"    => "category",
            "description"   => esc_html__("To filter by category, enter category slugs here separated by comma (ex: cat1,cat2,cat3). Leave the field empty if you want to display the recent events", 'pakghor' ),
            'group'			=> esc_html__( 'Post Query', 'pakghor' )
        ),
        array(
            "type"      	=> "dropdown",
            "heading"   	=> esc_html__("Post Query", "pakghor" ),
            "param_name"	=> "order",
            "admin_label"	=> true,
            "value"     	=> array(
                esc_html__( "Select Team Order", "pakghor" )   => "",
                esc_html__( "DESC","pakghor")    				=> "DESC",
                esc_html__( "ASC", "pakghor")   				=> "ASC",
              ),
            "std"  			=> "DESC",
            "group"     	=> esc_html__("Post Query", "pakghor" ),
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__( "Team Order By", "pakghor" ),
            "group"         => esc_html__( "Post Query", "pakghor" ),
            "param_name"    => "orderby",
            "admin_label"   => true,
            "value"         => array(
                esc_html__( "Select Team Order by","pakghor" ) => "",
                esc_html__( "Date", "pakghor" )      			=> "date",
                esc_html__( "Name", "pakghor" )      			=> "name",
                esc_html__( "Modified", "pakghor" )  			=> "modified",
                esc_html__( "Author", "pakghor" )    			=> "author",
                esc_html__( "Random", "pakghor" )    			=> "random",
                esc_html__( "Comment Count", "pakghor" )   	=> "comment_count",
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
            "type"          => "attach_image",
            "heading"       => esc_html__( "Section Background Image Left", "pakghor" ),
            "param_name"    => "section_bg_image_left",
            "group"         => esc_html__( "General", "pakghor" ),
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
            "std"           => "bottom left",
            "description"   => esc_html__("Give your Left Background Image Position, Default is: bottom left", 'pakghor' ),
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

function pakghor_team( $section_top_icon, $section_top_image,  $section_top_image_width, $title, $subtitle, $item_count, $order, $orderby,$category_options, $category, $tag, $postid, $offset, $team_style, $section_bg_image_left, $lbg_size, $lbg_position, $section_bg_image_right, $rbg_size,  $rbg_position, $fc_class ) {
	$section_bg_image_left 	= wp_get_attachment_image_src( $section_bg_image_left, 'full' );
	$section_bg_image_right = wp_get_attachment_image_src( $section_bg_image_right, 'full' );
	$_pakghor_team_page_options = $pakghor_team_designation = $pakghor_team_social = '';

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
    $team_wrapper_class = array('row') ;

    $top_img_class = array();
    $animation_attr = array();
    if( function_exists( 'cs_get_option' ) ) {
        $pakghor_section_animation = cs_get_option( 'pakghor_section_animation' );
        if( $pakghor_section_animation == true ){
            $animation_attr[] = 'class="'. esc_attr( $animation_classes ) .'"';
            $top_icon_class[] = $animation_classes;
            $top_img_class[] = $animation_classes;
            $team_wrapper_class[] = $animation_classes;
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

    $team_wrapper_classes = implode(  ' ', $team_wrapper_class);
    $team_wrapper_attr = 'class="' .esc_attr($team_wrapper_classes). '"';


	// Css Classes
    $sec_classes = array(
            'cook-team',
            'section-padding'
        );
    if( !empty($fc_class) ) {
        $sec_classes[] = $fc_class;
    }
    if( $team_style == 'two'){
		$sec_classes[] = 'style-2';
	}
    $sec_class = implode(' ', $sec_classes);
    $section_attr = array();
    $section_attr[] = 'class="'. esc_attr($sec_class) .'"';
    if( !empty($section_bg_image_left) || !empty($section_bg_image_right) ){
        $section_attr[] ='style="background: url( ' .esc_url( $section_bg_image_left['0'] ). ' ) no-repeat, url('.esc_url($section_bg_image_right['0']).') no-repeat;  
        background-size: '.esc_attr($lbg_size).', '.esc_attr($rbg_size).'; 
        background-position: '.esc_attr($lbg_position).','.esc_attr($rbg_position).' "';
    }
    // team style
    if( $team_style == 'two'){
        $team_style_css = 'col-md-4';
    }else{
        $team_style_css = 'col-md-3';
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
                <?php endif; ?>
			<?php 
                if( $category_options ) :
                    $team_post= new WP_Query( array(
                            'post_type'             => 'pakghor_team',
                            'posts_per_page'        => $item_count,
                            'ignore_sticky_post'    => true,
                            'post_status'           => 'publish',
                            'order'                 => $order,
                            'orderby'               => $orderby,
                            'offset'                => $offset,
                            'tax_query' => array(
                                    array (
                                        'taxonomy' => 'team_category',
                                        'field' => 'term_id',
                                        'terms' => $category_options ,
                                    )
                                ),
                            ) 
                        );  
				elseif(!empty($postid)):
                $team_post = new WP_Query( array(
                    'post_type'             => 'pakghor_team',
                    'post__in'              => $postids,
                    'posts_per_page'        => $item_count,
                    'ignore_sticky_post'    => true,
                    'post_status'           => 'publish',
                    'order'                 => $order,
                    'orderby'               => $orderby,
                    'offset'                => $offset                       
                ) );           
            	elseif(!empty($tag)):
                $team_post = new WP_Query( array(
                    'post_type'				=> 'pakghor_team',
                    'posts_per_page'		=> $item_count,
                    'ignore_sticky_post'	=> true,
                    'post_status'           => 'publish',
                    'order'                 => $order,
                    'orderby'               => $orderby,
                    'offset'                => $offset,
                    'tax_query' => array(
                        array (
                            'taxonomy' => 'team_tag',
                            'field' => 'slug',
                            'terms' => $tags,
                        )
                    ),
                ) );  
				elseif( !empty($category) ) :
				$team_post = new WP_Query( array(
					'post_type'			=> 'pakghor_team',
					'post_status'		=> 'publish',
					'posts_per_page'	=> $item_count,
					'order'            	=> $order,
                    'orderby'         	=> $orderby,
                    'offset'            => $offset,
                    'ignore_sticky_post'   => true,
                    'tax_query'			=> array(
                    		array(
                    			'taxonomy' 	=> 'team_category',
	                            'field' 	=> 'slug',
	                            'terms' 	=> $categories,
                    		),

                    	),
					) 
				);
				else:
				$team_post = new WP_Query( array(
					'post_type'			=> 'pakghor_team',
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
				<div <?php echo wp_kses_post($team_wrapper_attr); ?>>
				<?php
					if( $team_post->have_posts() ) : 
					
						while ( $team_post->have_posts() ) : $team_post->the_post();

							if( function_exists('cs_get_option') ){
							$_pakghor_team_page_options = get_post_meta( get_the_ID(), '_pakghor_team_page_options', true );
							$pakghor_team_designation   = isset( $_pakghor_team_page_options['pakghor_team_designation'] ) ? $_pakghor_team_page_options['pakghor_team_designation'] : '';
							$pakghor_team_social   	 = isset( $_pakghor_team_page_options['pakghor_team_designation'] ) ? $_pakghor_team_page_options['pakghor_team_social'] : '';
							}
				?>
					<div class="<?php echo esc_attr($team_style_css); ?> col-sm-4">
						<div class="cook-team-member">
							<?php if( has_post_thumbnail() ) : ?>
							<div class="cooker-img">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a> 
							</div>
							<?php endif; ?>
							<div class="cooker-details">
								<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
								<?php if( !empty($pakghor_team_designation) ) : ?>
                                    <span><?php echo esc_html($pakghor_team_designation); ?></span>
                                <?php endif; ?>
							</div>
							<?php if( $pakghor_team_social ): ?>
							<div class="social-profiles">
								<ul>
									<?php foreach ($pakghor_team_social as $pakghor_team_social_single ) : ?>
									<li><a href="<?php echo esc_url($pakghor_team_social_single['pakghor_social_link']) ?>"><i class="<?php echo esc_attr($pakghor_team_social_single['pakghor_social_icon'] ); ?>"></i></a></li>
									<?php endforeach; ?>
								</ul>
							</div><!-- social icon -->
							<?php endif; ?>
						</div><!-- cook team member -->
					</div>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php endif; ?>
				</div><!-- cook team wrapper -->
			</div>
		</div> <!-- container -->
	</section><!-- service section end -->
<!-- end achievement-section -->

<?php }