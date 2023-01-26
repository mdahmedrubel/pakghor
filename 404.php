<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package pakghor
 */

get_header();

	$pakghor_404_image	= $pakghor_404_title = $pakghor_404_content = $pakghor_404_bg_left = $pakghor_404_bg_right = $error_bgl_repeat = $error_bgl_size = $error_bgl_position = $error_bgr_repeat = $error_bgr_size = $error_bgr_position = '';
	if( function_exists('cs_get_option') ){
		$pakghor_404_image 	= cs_get_option('pakghor_404_image');
		$pakghor_404_image_src = wp_get_attachment_image_src($pakghor_404_image, 'full');
		$pakghor_404_image_alt = get_post_meta($pakghor_404_image, '_wp_attachment_image_alt', true );
		$pakghor_404_bg_left 	= cs_get_option('pakghor_404_bg_left');
		$pakghor_404_bg_left 	= wp_get_attachment_image_src($pakghor_404_bg_left, 'full');
		$pakghor_404_bg_right 	= cs_get_option('pakghor_404_bg_right');
		$pakghor_404_bg_right 	= wp_get_attachment_image_src($pakghor_404_bg_right, 'full');
		$pakghor_404_title 	= cs_get_option('pakghor_404_title');
		$pakghor_404_content 	= cs_get_option('pakghor_404_content');
		$error_bgl_repeat 		= cs_get_option('error_bgl_repeat');
		$error_bgl_size 		= cs_get_option('error_bgl_size');
		$error_bgl_position 	= cs_get_option('error_bgl_position');
		$error_bgr_repeat 		= cs_get_option('error_bgr_repeat');
		$error_bgr_size 		= cs_get_option('error_bgr_size');
		$error_bgr_position = cs_get_option('error_bgr_position');
	}
	// css classes
	$css_classes = array('error');
	$sec_class 	 = implode(' ', $css_classes);
	$section_attr = array();
	$section_attr[]= 'class="'. esc_attr($sec_class) .'"';
	if( !empty($pakghor_404_bg_right) || !empty($pakghor_404_bg_left) ){
    	$section_attr[] = 'style="background: url( ' .esc_url( $pakghor_404_bg_left['0'] ). ' ), url('.esc_url($pakghor_404_bg_right['0'] ).');
        background-repeat: '. esc_attr($error_bgl_repeat) .''.','.esc_attr($error_bgr_repeat).'; 
        background-size: '. esc_attr($error_bgl_size, $error_bgr_size) .''.','.esc_attr($error_bgr_size).'; 
        background-position: '. esc_attr($error_bgl_position) .''.','.esc_attr($error_bgr_position).'"';
    }
?>
	<!-- error section -->
	<section <?php echo implode(' ', $section_attr); ?>>
		<?php if( !empty($pakghor_404_image_src) ) : ?>
		<div class="error-top">
			<img src="<?php echo esc_url($pakghor_404_image_src['0']); ?>" alt="<?php echo esc_attr($pakghor_404_image_alt); ?>">
		</div>
		<?php else: ?>
		<div class="error-top">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/error-img.jpg" alt="<?php echo esc_attr__('error-img','pakghor'); ?>">
		</div>
		<?php endif; ?>
		<?php if(!empty($pakghor_404_title)): ?>
			<h3><?php echo esc_html($pakghor_404_title); ?></h3>
		<?php else: ?>
		<h3><?php esc_html_e('This Page Is Not Be Found!','pakghor'); ?></h3>
		<?php endif; ?>
		<?php if(!empty($pakghor_404_content)): ?>
			<p><?php echo wp_kses_post($pakghor_404_content); ?></p>
		<?php else: ?>
		<p><?php esc_html_e('You might ensure the URL is spelled correctly, or if you followed a link here please let us know. Please try one of the links below in order to reach your desired destination.','pakghor') ?></p>
		<?php endif; ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-default"><?php echo esc_html__('Go back to Home', 'pakghor') ?></a>
	</section><!-- error section end -->
<?php get_footer();