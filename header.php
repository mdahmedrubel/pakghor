<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pakghor
 */
?>
<?php
$pakghor_page_header_switcher = $pakghor_breadcrumbs = $pakghor_page_title = true;
$pakghor_header_style = 1;
$pakghor_loading_animation = $pakghor_page_header_image_switcher = $pakghor_page_header_image = $pakghor_page_header_bg = $page_header_bg_repeat = $page_header_bg_size = $page_header_bg_postion = $_pakghor_page_options = '';
	if ( function_exists( 'cs_get_option' ) ) :
		if( is_page() ) :
			$_pakghor_page_options = get_post_meta( get_the_ID(), '_pakghor_custom_page_options', true );
		endif;
		$pakghor_header_style = isset($_pakghor_page_options['pakghor_header_style']) ? $_pakghor_page_options['pakghor_header_style'] : cs_get_option('pakghor_header_style');
		$pakghor_breadcrumbs = isset($_pakghor_page_options['pakghor_breadcrumbs']) ? $_pakghor_page_options['pakghor_breadcrumbs'] : cs_get_option('pakghor_breadcrumbs');
		$pakghor_page_title = isset($_pakghor_page_options['pakghor_page_title']) ? $_pakghor_page_options['pakghor_page_title'] : cs_get_option('pakghor_page_title');
		$pakghor_page_header_switcher	= cs_get_option('pakghor_page_header_switcher');
		$pakghor_loading_animation		= cs_get_option('pakghor_loading_animation');
		$pakghor_page_header_bg			= cs_get_option('pakghor_page_header_background_color');
		$pakghor_page_header_image_switcher = cs_get_option('pakghor_page_header_image_switcher');
		$pakghor_page_header_image		= cs_get_option('pakghor_page_header_image');
		$page_header_bg_repeat 			= cs_get_option('page_header_bg_repeat');
		$page_header_bg_size 			= cs_get_option('page_header_bg_size');
		$page_header_bg_postion 		= cs_get_option('page_header_bg_postion');
	endif;
 // Overlay Class
    $overlay_classess 	= array('banner-overlay');
    $overlay_class 		= implode( ' ', $overlay_classess );
    $overlay_attr = array();
    $overlay_attr[] = 'class="'.esc_attr($overlay_class).'"';
    if( !empty($pakghor_page_header_bg) ){
    	$overlay_attr[] = 'style="background-color:'. esc_attr( $pakghor_page_header_bg ) .'"';
    }
    $css_classes = array('banner');
    // banner padding top
    if( $pakghor_header_style == '2' ){
        $css_classes[] = 'padding-top-banner';
    }
    $css_class = implode(' ', $css_classes);
    $banner_attr = array();
    $banner_attr[] = 'class="'. esc_attr( $css_class) .'"';
    if( !empty($pakghor_page_header_image) ){
    	$pakghor_page_header_image = wp_get_attachment_image_src($pakghor_page_header_image, 'full');
		$banner_attr[] =  'style="background: url( ' .esc_url( $pakghor_page_header_image['0'] ). ' );
        background-repeat: '. esc_attr($page_header_bg_repeat) .'; 
        background-size: '. esc_attr($page_header_bg_size ) .'; 
        background-position: '. esc_attr($page_header_bg_postion) .'"';
    }
?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="<?php bloginfo('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	 <?php if( $pakghor_loading_animation == 1 ) : ?>
		<div id="preloder">
			<div id="preloder-center">
				<div id="preloder-center-absolute">
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
				</div>
			</div>
		</div><!-- Preloder -->
	<?php endif; ?>
	<div class="mobile-menu-area">
		<div class="close-btn">
			<span></span>
			<span></span>
		</div>
      	<div class="mobile-menu">
      	<?php
			if( has_nav_menu('pakghor-mobile-menu') ){
				wp_nav_menu( array(
					'theme_location'	=> 'pakghor-mobile-menu',
					'menu_class'		=> 'mobile-submenu',
					'container'			=> ' ',
				) );
			}else{
				wp_nav_menu( array(
					'theme_location'	=> 'menu-home',
					'menu_class'		=> 'nav navbar-nav',
					'container'			=> ' ',
					'walker'			=> new Pakghor_nav_walker(),
				) );
			}
		?>
       </div>
	</div>
	<!-- Header -->
	<?php
		if( $pakghor_header_style  == '2' ){
			get_template_part('template-parts/headers/header', 'two');
		}elseif ( $pakghor_header_style  == '3') {
			get_template_part('template-parts/headers/header', 'three');
		}elseif ( $pakghor_header_style  == '4') {
			get_template_part('template-parts/headers/header', 'four'); // No header
		}else{
			get_template_part('template-parts/headers/header', 'one');
		}
	?>
<?php
	if ( ! is_front_page() && ! is_404() && $pakghor_page_header_switcher == true && ($pakghor_breadcrumbs == true || $pakghor_page_title == true) ) : ?>
	<section <?php echo implode( ' ', $banner_attr); ?>>
		<div <?php echo implode( ' ', $overlay_attr); ?>></div>
		<?php if( $pakghor_breadcrumbs == true || $pakghor_page_title == true ) : ?>
		<div class="banner-text">
			<?php if( ! is_single() ) : ?>
			<h2>
				<?php
					if( is_archive() ) {
                        the_archive_title();
                    } elseif ( is_home() ) {
                            wp_title('');
                    } elseif( is_page() ) {
                        the_title();
                    } elseif( is_search() ) {
                        printf( esc_html__( 'Search Results for: %s', 'pakghor' ), '<span>' . get_search_query() . '</span>' );
                    } else {
                        the_title();
                    }
                ?>
			 </h2>
			<?php endif; 
			if( $pakghor_page_header_switcher == true && $pakghor_breadcrumbs == true ) : 
				pakghor_breadcrumbs();
			endif; ?>
		</div>
		<?php endif; ?>
	</section><!--/Banner Section end/-->
	<?php endif;