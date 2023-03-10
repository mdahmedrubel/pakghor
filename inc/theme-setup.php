<?php 

if ( ! function_exists( 'pakghor_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pakghor_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pakghor, use a find and replace
		 * to change 'pakghor' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pakghor', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_image_size('pakghor-blog-770-370', 770, 370, true );
		add_image_size('populer-post-home-369-299', 369, 299, true );
		add_image_size('pakghor-gallery-thumb-369-299', 369, 299, true );
		add_image_size('pakghor-product-slider-370-370', 370, 370, true );
		add_image_size('pakghor-product-thumb-370-270', 370, 270, true );
		add_image_size('pakghor-event-thumb-300-350', 300, 350, true );
		add_image_size('pakghor-product-thumb-100-100', 100, 100, true);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'widgets' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-home' => esc_html__( 'Main Menu', 'pakghor' ),
			'pakghor-mobile-menu' => esc_html__( 'Mobile Menu', 'pakghor' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pakghor_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'pakghor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pakghor_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pakghor_content_width', 640 );
}
add_action( 'after_setup_theme', 'pakghor_content_width', 0 );

/**
 * Registers an editor stylesheet for the Pakghor.
 */
function pakghor_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'pakghor_theme_add_editor_styles' );

//WooCommerce Thumbnail Support
function pakghor_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action( 'after_setup_theme', 'pakghor_add_woocommerce_support' );




