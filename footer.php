<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pakghor
 */

?>
<?php
	$pakghor_footer_top_switcher = $pakghor_copyright_switcher = $pakghor_copyright_section_text = $pakghor_footer_top_background_image = $pakghor_footer_top_background_color = $pakghor_bottom_background_color = $_pakghor_page_options = '';
	$footer_top_bg_repeat 	= 'no-repeat';
	$footer_top_bg_size 	= 'cover';
	$footer_top_bg_postion 	= 'center';
	if( function_exists( 'cs_get_option' ) ) {
		if( is_page() ) :
			$_pakghor_page_options = get_post_meta( get_the_ID(), '_pakghor_custom_page_options', true );
		endif;
		$pakghor_footer_top_switcher = isset( $_pakghor_page_options['pakghor_footer_top_switcher'] ) ? $_pakghor_page_options['pakghor_footer_top_switcher'] : cs_get_option('pakghor_footer_top_switcher');
		$pakghor_copyright_switcher = isset( $_pakghor_page_options['pakghor_copyright_switcher'] ) ? $_pakghor_page_options['pakghor_copyright_switcher'] : cs_get_option('pakghor_copyright_switcher');
		$pakghor_copyright_section_text		= cs_get_option('pakghor_copyright_section_text');
		$bg_image	= cs_get_option('pakghor_footer_top_background_image');
		$bg_color	= cs_get_option('pakghor_footer_top_background_color');
		$pakghor_bottom_bg		= cs_get_option('pakghor_bottom_background_color');
		$footer_top_bg_repeat 	= cs_get_option('footer_top_bg_repeat');
		$footer_top_bg_size 	= cs_get_option('footer_top_bg_size');
		$footer_top_bg_postion 	= cs_get_option('footer_top_bg_postion');
	}
	$fotop_classes = array('footer-top');
    $sec_class = implode(' ', $fotop_classes);
    $footer_attr = array();
    $footer_attr[] = 'class="'. esc_attr($sec_class) .'"';
    if( !empty($bg_image) ){
    	$bg_image = wp_get_attachment_image_src($bg_image, 'full');
		$footer_attr[] =  'style="background: url( ' .esc_url( $bg_image[0] ). ' );
        background-repeat: '. esc_attr($footer_top_bg_repeat) .'; 
        background-size: '. esc_attr($footer_top_bg_size) .'; 
        background-position: '. esc_attr($footer_top_bg_postion) .'"';
    }
 	// Overlay Class
    $overlay_classess = array('section-overlay');
    $overlay_class = implode( ' ', $overlay_classess );
    $overlay_attr = array();
    $overlay_attr[] = 'class="'.esc_attr($overlay_class).'"';
    if( !empty($bg_color) ){
    	$overlay_attr[] = 'style="background-color:'. esc_attr( $bg_color) .'"';
    }
    //footer bottom bgc
    $fobottom_classes = array('footer-bottom');
    $bottom_class = implode(' ', $fobottom_classes);
    $footer_attr_bottom = array();
    $footer_attr_bottom[] = 'class="'. esc_attr($bottom_class) .'"';
    if( !empty($pakghor_bottom_bg) ){
		$footer_attr_bottom[] = 'style="background-color:'. esc_attr($pakghor_bottom_bg) .'"';
    }
 ?>
	<!-- Footer -->
	<footer>
	<?php if(is_active_sidebar('sidebar-footer') && $pakghor_footer_top_switcher == true ) : ?>
		<div <?php echo implode(' ', $footer_attr); ?>>
			<div <?php echo implode(' ', $overlay_attr); ?>>
				<div class="container">
					<div class="row">
						<div class="footer-widget-wrapper">
							<?php dynamic_sidebar('sidebar-footer'); ?>
						</div><!-- footer-widget-wrapper -->
					</div>
				</div><!-- container -->
			</div><!-- section-overlay -->
		</div><!-- footer-top -->
	<?php endif; ?>
		<!--Scroll top-->
		<div class="scroll-top">
			<i class="fa fa-angle-up"></i>
		</div>
	<?php if ($pakghor_copyright_switcher == 1 && !empty($pakghor_copyright_section_text) ): ?>
		<div <?php echo implode(' ', $footer_attr_bottom); ?>>
			<p><?php echo wp_kses_post($pakghor_copyright_section_text); ?></p>
		</div><!-- footer-bottom -->
	<?php elseif( ! function_exists( 'cs_get_option' ) ): 
		$pc_url = '#';
	?>
		<div class="footer-bottom">
			<p>&copy; <span><?php esc_html_e('Pakghor','pakghor') ?></span> <?php esc_html_e('Pakghor 2021 © Best for Restaurant WordPress Theme.','pakghor'); ?> <a href="<?php echo esc_url_raw($pc_url); ?>"><?php esc_html_e('','pakghor'); ?></a></p>
		</div><!-- footer-bottom -->
	<?php endif; ?>
	</footer><!-- Footer End-->
	<?php wp_footer(); ?>
</body>
</html>