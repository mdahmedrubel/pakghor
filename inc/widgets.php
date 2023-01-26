<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
	if( !function_exists('pakghor_sidebar_init') )
	{
		function pakghor_sidebar_init() {
			register_sidebar( array(
				'name'          => esc_html__( 'Blog Sidebar', 'pakghor' ),
				'id'            => 'sidebar-blog',
				'description'   => esc_html__( 'Add widgets here.', 'pakghor' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
				)
			);
			register_sidebar( array(
				'name'			=> esc_html__( 'Footer Top Widget', 'pakghor' ),
				'id'            => 'sidebar-footer',
				'description'   => esc_html__( 'Add widgets here for footer top section', 'pakghor' ),
				'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6 %2$s"><div class="footer-widget">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h2 class="footer-widget-title">',
				'after_title'   => '</h2>',
				)
			);
			register_sidebar( array(
				'name'			=> esc_html__( 'WooCommerce Sidebar', 'pakghor' ),
				'id'            => 'woo-sidebar',
				'description'   => esc_html__( 'Add widgets here for Shop Single page', 'pakghor' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
				)
			);

		}add_action( 'widgets_init', 'pakghor_sidebar_init' );
	}