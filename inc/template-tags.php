<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pakghor
 */

if ( ! function_exists( 'pakghor_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function pakghor_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'pakghor' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<li class="post-date"><i class="fa fa-calendar"></i>' . $posted_on . '</li>'; // WPCS: XSS OK.
					
	}
endif;

if ( ! function_exists( 'pakghor_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function pakghor_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'pakghor' ),
			'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
		);

		echo '<li class="post-author"><i class="fa fa-user"></i>Posted by: ' . $byline . '</li>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'pakghor_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function pakghor_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'pakghor' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<li class="post-tag"><i class="fa fa-folder-open"></i>' . esc_html__( '%1$s', 'pakghor' ) . '</li>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;


if (!function_exists('pakghor_entry_single_footer')) {
	
	function pakghor_entry_single_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */

			$tags_list = '<li>'.get_the_tag_list( ' ', esc_html__( ', ', 'pakghor' ) ).'</li>';

			if ($tags_list) {
				printf( '<ul><li class="tag-title">' . esc_html__( 'Tags : %1$s', 'pakghor' ) . '</li></ul>', $tags_list); // WPCS: XSS OK.
			}

		}
	}

}

if ( ! function_exists( 'pakghor_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function pakghor_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :
			?>
			<?php the_post_thumbnail('pakghor-blog-770-370'); ?>
		<?php else : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			the_post_thumbnail( 'pakghor-blog-770-370', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>
		<?php endif; // End is_singular().
	}
endif;

/**
* Pakghor Post edit link
*/
if ( ! function_exists('pakghor_edit_post_link')) {
	function pakghor_edit_post_link(){
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'pakghor' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}

// Pakghor author social ===============================
if(!function_exists('pakghor_author_social')):
	/**
	 * Author Social Options
	 */	
	function pakghor_author_social(){
			$social_links = array();
			if(get_the_author_meta( 'facebook' )){
				$social_links['facebook'] = get_the_author_meta( 'facebook' );
			} 
			if(get_the_author_meta( 'twitter' )){
				$social_links['twitter'] = get_the_author_meta( 'twitter' );
			} 
			if(get_the_author_meta( 'linkedin' )){
				$social_links['linkedin'] = get_the_author_meta( 'linkedin' );
			} 
			if(get_the_author_meta( 'pinterest' )){
				$social_links['pinterest'] = get_the_author_meta( 'pinterest' );
			} 
			if(get_the_author_meta( 'google-plus' )){
				$social_links['google-plus'] = get_the_author_meta( 'google-plus' );
			}
			if(is_array($social_links)){
				$count  = count($social_links);
			}
			if($count>=1){
				?>
			<div class="social-profiles">
				<ul>
				<?php
				foreach ($social_links as $key => $value) {
					$value = strip_tags($value);
					//Facebook
					if (preg_match('/facebook/',$value)) {
					  ?><li><a href="<?php echo esc_url($value); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php
					}
					if((!preg_match('/facebook.com/',$value)&& $key=='facebook')){$url= 'http://facebook.com/'.trim($value); ?>
						<li><a href="<?php echo esc_attr($url); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<?php
					}
					//Twitter
					if (preg_match('/twitter/',$value)) {
					  ?><li><a href="<?php echo esc_url($value); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php
					}
					if((!preg_match('/twitter.com/',$value)&& $key=='twitter')){$url= 'http://twitter.com/'.trim($value); ?>
						<li><a href="<?php echo esc_attr($url); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<?php
					}
					//Linkedin
					if (preg_match('/linkedin.com/',$value)) {
					  ?><li><a href="<?php echo esc_url($value); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><?php
					}
					if((!preg_match('/linkedin.com/',$value)&& $key=='linkedin')){$url= 'http://linkedin.com/in/'.trim($value); ?>
						<li><a href="<?php echo esc_attr($url); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					<?php
					}
					//Pinterest
					if (preg_match('/pinterest.com/',$value)) {
					  ?><li><a href="<?php echo esc_url($value); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li><?php
					}
					if((!preg_match('/pinterest.com/',$value)&& $key=='pinterest')){$url= 'http://pinterest.com/'.trim($value); ?>
						<li><a href="<?php echo esc_attr($url); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
					<?php
					}
					//Google Plus
					if (preg_match('/plus.google.com/',$value)) {
					  ?><li><a href="<?php echo esc_url($value); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li><?php
					}
					if((!preg_match('/plus.google.com/',$value)&& $key=='google-plus')){$url= 'https://plus.google.com/'.trim($value); ?>
						<li><a href="<?php echo esc_attr($url); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					<?php
					}
				} ?>
			</ul>
		</div><?php				
			}
	}
endif;

// VC Custom Row Setting
if( function_exists( 'vc_map' ) ) :
	vc_add_param("vc_section", array(
		"type" => "dropdown",
		"group" => "Design Options",
		"class" => "",
		"heading" => "Background Attachment",
		"param_name" => "bg_attachment",
		"value" => array(
			esc_html__("Theme Default", "pakghor") => "",
			esc_html__("Scroll", "pakghor") => "scroll",
			esc_html__("Fixed", "pakghor") => "fixed",
			esc_html__("Local", "pakghor") => "local",
			esc_html__("Initial", "pakghor") => "initial",
			esc_html__("Inherit", "pakghor") => "inherit"	
		)
	));
	vc_add_param("vc_section", array(
		"type" => "dropdown",
		"group" => "Design Options",
		"class" => "",
		"heading" => "Background Position",
		"param_name" => "bg_position",
		"value" => array(
			esc_html__("Theme Default", "pakghor") => "",
			esc_html__("left top", "pakghor") => "left top",
			esc_html__("left center", "pakghor") => "left center",
			esc_html__("left bottom", "pakghor") => "left bottom",
			esc_html__("right top", "pakghor") => "right top",
			esc_html__("right center", "pakghor") => "right center",	
			esc_html__("right bottom", "pakghor") => "right bottom",	
			esc_html__("center top", "pakghor") => "center top",	
			esc_html__("center center", "pakghor") => "center center",	
			esc_html__("center bottom", "pakghor") => "center bottom",	
			esc_html__("custom", "pakghor") => "custom"	
		)
	));

	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"group" => "Design Options",
		"class" => "",
		"heading" => "Background Attachment",
		"param_name" => "bg_attachment",
		"value" => array(
			esc_html__("Theme Default", "pakghor") => "",
			esc_html__("Scroll", "pakghor") => "scroll",
			esc_html__("Fixed", "pakghor") => "fixed",
			esc_html__("Local", "pakghor") => "local",
			esc_html__("Initial", "pakghor") => "initial",
			esc_html__("Inherit", "pakghor") => "inherit"	
		)
	));
	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"group" => "Design Options",
		"class" => "",
		"heading" => "Background Position",
		"param_name" => "bg_position",
		"value" => array(
			esc_html__("Theme Default", "pakghor") => "",
			esc_html__("left top", "pakghor") => "left top",
			esc_html__("left center", "pakghor") => "left center",
			esc_html__("left bottom", "pakghor") => "left bottom",
			esc_html__("right top", "pakghor") => "right top",
			esc_html__("right center", "pakghor") => "right center",	
			esc_html__("right bottom", "pakghor") => "right bottom",	
			esc_html__("center top", "pakghor") => "center top",	
			esc_html__("center center", "pakghor") => "center center",	
			esc_html__("center bottom", "pakghor") => "center bottom",	
			esc_html__("custom", "pakghor") => "custom"	
		)
	));
endif;