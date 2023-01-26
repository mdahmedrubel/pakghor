<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title'      => 'Theme Options',
  'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'theme-options',
  'ajax_save'       => true,
  'show_reset_all'  => false,
  'framework_title' => 'Pakghor Options Panel <small>by CodexCoder</small>',
);
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();
/**
 * General Settings
 */
$options[]      = array(
    'name'      => 'pakghor_general_settings',
    'title'     => esc_html__( 'General Settings', 'pakghor' ),
    'icon'      => 'fa fa-cog',
    'fields'    => array(

        /* Animation Switcher */
        array(
            'id'            => 'pakghor_loading_animation',
            'type'          => 'switcher',
            'title'         => esc_html__( 'Preloader', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to Show loading animation when Visiting the site, please switch on.', 'pakghor' ),
            'default'       => true,
        ),
        array(
            'id'            => 'pakghor_section_animation',
            'type'          => 'switcher',
            'title'         => esc_html__( 'Section Animation', 'pakghor' ),
            'label'         =>  esc_html__( 'If you want to Show Section animation of the site, please switch on.', 'pakghor' ),
            'default'       => true,
        ),
        /* Theme Logo */
        array(
            'id'            => 'pakghor_theme_logo',
            'type'          => 'image',
            'title'         => esc_html__( 'Theme Logo', 'pakghor' ),
            'add_title'     => esc_html__( 'Add Logo', 'pakghor' ),
            'desc'          => esc_html__( 'Upload logo','pakghor' ),
        ),
        array(
            'id'            => 'pakghor_theme_logo_width',
            'type'          => 'text',
            'title'         => esc_html__( 'Theme Logo Width', 'pakghor' ),
            'desc'          => esc_html__( 'Logo Width in Pixel. like: 200px','pakghor' ),
        ),
        array(
            'id'            => 'pakghor_theme_logo_height',
            'type'          => 'text',
            'title'         => esc_html__( 'Theme Logo Height', 'pakghor' ),
            'desc'          => esc_html__( 'Logo Height in Pixel. like: 200px','pakghor' ),
        ),
        array(
            'id'            => 'pakghor_theme_logo_dark',
            'type'          => 'image',
            'title'         => esc_html__( 'Theme Dark Logo', 'pakghor' ),
            'add_title'     => esc_html__( 'Add Logo', 'pakghor' ),
            'desc'          => esc_html__( 'This logo for Header Style Two, Sticky header, and Mobile header.','pakghor' ),
        ),
        array(
            'id'            => 'pakghor_logo_dark_width',
            'type'          => 'text',
            'title'         => esc_html__( 'Theme Dark Logo Width', 'pakghor' ),
            'desc'          => esc_html__( 'Logo Width in Pixel. like: 200px','pakghor' ),
        ),
        array(
            'id'            => 'pakghor_logo_dark_height',
            'type'          => 'text',
            'title'         => esc_html__( 'Theme Dark Logo Height', 'pakghor' ),
            'desc'          => esc_html__( 'Logo Height in Pixel. like: 200px','pakghor' ),
        ),
        /* Page Header */
         array(
            'type'      =>  'subheading',
            'content'   =>  esc_html__('Page Title and Breadcrumbs Switcher', 'pakghor'),
        ),
        array(
            'id'            => 'pakghor_page_header_switcher',
            'type'          => 'switcher',
            'title'         => esc_html__( 'Page Title and Breadcrumbs Switcher', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to Show Page Title and  Breadcrumbs, please switch on.', 'pakghor' ),
            'default'       => true,
        ),
        array(
            'id'            => 'pakghor_page_title',
            'type'          => 'switcher',
            'default'       => true,
            'title'         => esc_html__( 'Page Title', 'pakghor' ),
            'label'          => esc_html__( 'If you want to Show Page Title please switch on.', 'pakghor' ),
            'dependency'    =>  array( 'pakghor_page_header_switcher', '==', 'true' ),
        ),
        array(
            'id'            => 'pakghor_breadcrumbs',
            'type'          => 'switcher',
            'default'       => true,
            'title'         => esc_html__( 'Show Breadcrumbs', 'pakghor' ),
            'label'          => esc_html__( 'If you want to Show Breadcrumbs please switch on.', 'pakghor' ),
            'dependency'    =>  array( 'pakghor_page_header_switcher', '==', 'true' ),
        ),
        array(
            'id'            => 'pakghor_page_header_image_switcher',
            'type'          => 'switcher',
            'default'       => true,
            'title'         => esc_html__( 'Show Page Title Background Image', 'pakghor' ),
            'label'          => esc_html__( 'If you want to Show Page Header Background Image please switch on.', 'pakghor' ),
            'dependency'    =>  array( 'pakghor_page_header_switcher', '==', 'true' ),
        ),
        array(
            'id'            =>  'pakghor_page_header_image',
            'type'          =>  'image',
            'title'         =>  esc_html__( 'Page Title Background Image', 'pakghor' ),
            'dependency'    =>  array( 'pakghor_page_header_switcher|pakghor_page_header_image_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'       => 'page_header_bg_repeat',
            'type'     => 'select',
            'desc' => esc_html__('Default is no-repeat.','pakghor'),
            'title'    => esc_html__('Select Background Repeat','pakghor'),
            'options'  => array(
                'no-repeat' => esc_html__('No-repeat','pakghor'),
                'repeat'    => esc_html__('Repeat','pakghor'),
                'repeat-x'  => esc_html__('Repeat-x','pakghor'),
                'repeat-y'  => esc_html__('Repeat-y','pakghor'),
            ),
            'default'       => 'no-repeat',
            'dependency'    =>  array( 'pakghor_page_header_switcher|pakghor_page_header_image_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'       => 'page_header_bg_size',
            'type'     => 'select',
            'desc'     => esc_html__('Default is cover','pakghor'),
            'title'    => esc_html__('Select Background Size','pakghor'),
            'options'  => array(
                'cover'     => esc_html__('Cover','pakghor'),
                'auto'      => esc_html__('Auto','pakghor'),
                'contain'   => esc_html__('Contain','pakghor'),
          ),
          'default'         => 'cover',
            'dependency'    =>  array( 'pakghor_page_header_switcher|pakghor_page_header_image_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'       => 'page_header_bg_postion',
            'type'     => 'select',
            'options'  => array(
                'left'      => esc_html__('left','pakghor'),
                'right'     => esc_html__('right','pakghor'),
                'top'       => esc_html__('top','pakghor'),
                'bottom'    => esc_html__('bottom','pakghor'),
            ),
            'title'         => esc_html__('Background Position', 'pakghor'),
            'default'       => 'right',
            'desc'   => esc_html__('Give Background Image Position, Default is right', 'pakghor' ),
            'dependency'    =>  array( 'pakghor_page_header_switcher|pakghor_page_header_image_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'            =>  'pakghor_page_header_background_color',
            'type'          =>  'color_picker',
            'title'         =>  esc_html__( 'Page Title Background Color', 'pakghor' ),
            'dependency'    =>  array( 'pakghor_page_header_switcher', '==', 'true' ),
            'default'       => 'rgba(0,0,0,0.7)',
        ),

    ),
);


// ----------------------------------------
// pakghor Header Section -
// ----------------------------------------
$options[]      = array(
    'name'      =>  'pakghor_header_section',
    'title'     =>  esc_html__('Header Settings', 'pakghor'),
    'icon'      =>  'fa fa-bookmark',
    'fields'    =>  array(

        /* Header Style */
        array(
            'type'      =>  'subheading',
            'content'   =>  esc_html__('Header Style', 'pakghor'),
        ),
        array(
            'id'            =>  'pakghor_header_style',
            'type'          =>  'radio',
            'title'         =>  esc_html__( 'Header Style', 'pakghor' ),
            'class'         =>  'horizontal',
            'desc'          =>  esc_html__('Select header Style','pakghor'),
            'options'       =>  array(
                '1'         =>  esc_html__( 'Header Style One', 'pakghor' ),
                '2'         =>  esc_html__( 'Header Style Two', 'pakghor' ),
                '3'         =>  esc_html__( 'Header Style Three', 'pakghor' ),
            ),
            'default'       =>  '1',
        ),

        // Header Top Section
        array(
            'type'      =>  'subheading',
            'content'   =>  esc_html__('Header Top Section', 'pakghor'),
        ),
        array(
            'id'            =>  'pakghor_header_top_bar_switcher',
            'type'          =>  'switcher',
            'title'         =>  esc_html__( 'Header Top Bar Switcher', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to show Header Top bar Please switch on.', 'pakghor' ),
            'default'       =>  true,
        ),
        array(
            'id'            =>  'pakghor_header_top_bar_info',
            'type'          =>  'switcher',
            'title'         =>  esc_html__( 'Header Top Bar Info', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to show Header top info Please switch on.', 'pakghor' ),
            'default'       =>  true,
            'dependency'    => array( 'pakghor_header_top_bar_switcher', '==', 'true' ),
        ),
        array(
            'id'      =>  'pakghor_header_loaction_title',
            'type'    =>  'text',
            'title'   =>  esc_html__( 'Address Title', 'pakghor' ),
            'desc'    =>  esc_html__( 'This title only for [Header style Three]. And Icon will show for Header One, Header Two instead', 'pakghor' ),
            'dependency'        =>  array( 'pakghor_header_top_bar_info|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'        =>  'pakghor_header_loaction',
            'type'      =>  'textarea',
            'title'     =>  esc_html__( 'Address', 'pakghor' ),
            'dependency'        =>  array( 'pakghor_header_top_bar_info|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'      =>  'pakghor_header_phone_title',
            'type'    =>  'text',
            'title'   =>  esc_html__( 'Phone Title', 'pakghor' ),
            'desc'    =>  esc_html__( 'This title only for [Header style Three]. And Icon will show for Header One, Header Two instead', 'pakghor' ),
            'dependency'        =>  array( 'pakghor_header_top_bar_info|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'        =>  'pakghor_header_phone',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Phone', 'pakghor' ),
            'dependency'        =>  array( 'pakghor_header_top_bar_info|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'      =>  'pakghor_header_working_title',
            'type'    =>  'text',
            'title'   =>  esc_html__( 'Business Days Title', 'pakghor' ),
            'desc'    =>  esc_html__( 'This title only for [Header style Three]. And Icon will show for Header One, Header Two instead', 'pakghor' ),
           'dependency'        =>  array( 'pakghor_header_top_bar_info|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'        =>  'pakghor_working_days',
            'type'      =>  'text',
            'title'     =>  esc_html__( 'Business Days', 'pakghor' ),
           'dependency'        =>  array( 'pakghor_header_top_bar_info|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        // Header top Slogan
        array(
            'id'        => 'header_top_slogan',
            'type'      => 'text',
            'title'     => esc_html__( 'Header top Slogan', 'pakghor' ),
            'desc'      => esc_html__( 'Give a short Slogan / Welcome title for your business. N.B: Only for [Header style three]', 'pakghor' ),
            'dependency'        =>  array( 'pakghor_header_top_bar_info|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        // Social Icon
        array(
            'id'            =>  'pakghor_social_switcher',
            'type'          =>  'switcher',
            'title'         =>  esc_html__( 'Header Top Social Icon', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to show Social Media Icon & Links on Header. Like- Facebook, Twitter, Linkedin etc.', 'pakghor' ),
            'default'       =>  true,
            'dependency'    =>  array( 'pakghor_header_top_bar_switcher', '==', 'true' ),
        ),
        array(
            'id'                => 'pakghor_header_social',
            'type'              => 'group',
            'title'             => esc_html__( 'Add Social Link', 'pakghor' ),
            'desc'              => esc_html__( 'Add Social Media Icon & Links on Header. Like- Facebook, Twitter, Linkedin etc.','pakghor' ),
            'button_title'      => esc_html__( 'Add New', 'pakghor' ),
            'add_title'         => esc_html__( 'Add Social', 'pakghor' ),
            'accordion_title'   => esc_html__( 'Add New Social', 'pakghor' ),
            'fields'            => array(
                array(
                    'id'        => 'pakghor_social_icon',
                    'type'      => 'icon',
                    'title'     => esc_html__( 'Add Social Icon', 'pakghor' ),
                    'desc'      => esc_html__( 'Select Social Media Icon','pakghor' ),
                ),
                array(
                    'id'        => 'pakghor_social_link',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Social Links', 'pakghor' ),
                    'desc'      => esc_html__('Give your Social Media Link here','pakghor'),
                ),
            ),
            'dependency' =>  array('pakghor_social_switcher|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        // HEADER BOOK NOW BUTTOM
        array(
            'id'            =>  'pakghor_menu_book_btn_option',
            'type'          =>  'switcher',
            'title'         =>  esc_html__( 'Book Table Now Button', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to show Book Table Button option please switch on', 'pakghor' ),
            'default'       =>  true,
            'dependency'    =>  array('pakghor_header_top_bar_switcher', '==', 'true' ),
        ),
        array(
            'id'        =>  'pakghor_menu_book_btn_text',
            'type'      =>  'text',
            'desc'      =>  esc_html__('Give your Button label', 'pakghor'),
            'title'     =>  esc_html__( 'Book Tabel Button Text', 'pakghor' ),
            'dependency' =>  array('pakghor_menu_book_btn_option|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'        =>  'pakghor_menu_book_btn_url',
            'type'      =>  'text',
            'desc'      =>  esc_html__('Give your Book Button Link', 'pakghor'),
            'title'     =>  esc_html__( 'Book Tabel Button URL', 'pakghor' ),
            'dependency' =>  array('pakghor_menu_book_btn_option|pakghor_header_top_bar_switcher', '==|==', 'true|true' ),
        ),
        array(
            'id'        => 'pakghor_header_top_bgc',
            'type'      => 'color_picker',
            'title'     => esc_html__('Header top Section Background color', 'pakghor'),
            'default'   => '#000000',
            'dependency' =>  array('pakghor_header_top_bar_switcher', '==', 'true' ),
        ),
        // Header Bottom Section
        array(
            'type'      =>  'subheading',
            'content'   =>  esc_html__('Header Bottom Section', 'pakghor'),
        ),
        array(
            'id'            =>  'pakghor_add_to_cart',
            'type'          =>  'switcher',
            'title'         =>  esc_html__( 'Add To Cart', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to show add to cart please switch on. It is only for WooCommerce and [Header style one, Header style two]', 'pakghor' ),
            'default'       =>  true,
        ),
        array(
            'id'            =>  'pakghor_search_switcher',
            'type'          =>  'switcher',
            'title'         =>  esc_html__( 'Search Option', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to show search form on header please switch on.', 'pakghor' ),
            'default'       =>  true,
        ),
        array(
            'id'        => 'pakghor_header_bottom_bgc',
            'type'      => 'color_picker',
            'title'     => esc_html__('Header Bottom Section Background color', 'pakghor'),
            'default'   => '#ffffff',
        ),

    ),
);


$options[]      = array(
    'name'      => 'pakghor_sticky_menu',
    'title'     => esc_html__('Menu Settings', 'pakghor'),
    'icon'      => 'fa fa-bars',
    'fields'    => array(
        // Body      
        array(
            'type'    => 'subheading',
            'content'   => esc_html__(' Sticky Menu Option', 'pakghor'),
        ),
        array(
            'id'    => 'sticky_menu_switcher',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Menu Switcher','pakghor'),
            'label'  => esc_html__('If you want to show Sticky Menu, Please switch on.','pakghor'),

        ),
    ),  

);

// ----------------------------------------
// pakghor Typography Settings          -
// ----------------------------------------

$options[]      = array(
    'name'      => 'pakghor_typography',
    'title'     => esc_html__('Typography', 'pakghor'),
    'icon'      => 'fa fa-font',
    'fields'    => array(
        // Body      
        array(
            'type'    => 'subheading',
            'content'   => esc_html__('Body', 'pakghor'),
        ),
        array(
            'id'        => 'pakghor_body_font_family',
            'type'      => 'typography',
            'title'     => esc_html__('Body font family:', 'pakghor'),
            'default'   => array(
                'family'  => 'Poppins',
                'font'    => 'google', // this is helper for output ( google, websafe, custom )                
            ),
            'variant'   => false,
        ),
        array(
            'id'      => 'pakghor_body_font_size',
            'type'    => 'number',
            'title'   => esc_html__('Body font size:', 'pakghor'),
            'default'   => 14,
            'after'   => ' <i class="cs-text-muted">(px)</i>',                
        ),
        array(
            'id'      => 'pakghor_primary_color',
            'type'    => 'color_picker',
            'title'   => esc_html__('Primary Color:', 'pakghor'),
			'default' => '#ffcf0f',
        ),
        // Section Title
        array(
            'type'      => 'subheading',
            'content'   => esc_html__('Section Title', 'pakghor'),
        ),
        array(
            'id'        => 'pakghor_section_title_font_family',
            'type'      => 'typography',
            'title'     => esc_html__('Section Title font family:', 'pakghor'),
            'default'   => array(
                'family'  => 'Great Vibes',
                'font'    => 'google', // this is helper for output ( google, websafe, custom )
            ),
            'variant'   => false,
        ),
        array(
            'id'             => 'pakghor_section_title_font_weight',
            'type'           => 'select',
            'title'          =>  esc_html__('Section Title Font weight:', 'pakghor'),
            'options'     => array(
                '500'  =>  esc_html__('500', 'pakghor'),
                '100'  =>  esc_html__('100', 'pakghor'),                
                '300'  =>  esc_html__('300', 'pakghor'),                              
                '400'  =>  esc_html__('400', 'pakghor'),                
                '600'  =>  esc_html__('600', 'pakghor'),
                '700'  =>  esc_html__('700', 'pakghor'),                
                '800'  =>  esc_html__('800', 'pakghor'),                
                '900'  =>  esc_html__('900', 'pakghor'),                
            ),
        ),
        array(
            'id'      => 'pakghor_section_title_font_size',
            'type'    => 'number',
            'title'   => esc_html__('Section Title Font size:', 'pakghor'),
            'default'   => 60,
            'after'   => ' <i class="cs-text-muted">(px)</i>',                
        ),
        array(
            'id'       => 'pakghor_section_title_font_color',
            'type'      =>  'color_picker',
            'title'     =>  esc_html__('Section Title Font color:', 'pakghor'),
            'default'   => '#ffcf0f',
        ),
        array(
            'id'          => 'pakghor_section_title_font_style',
            'type'        => 'select',
            'title'       => esc_html__('Section Title font-style:', 'pakghor'),
            'options'     => array(
                'normal'  => esc_html__('Normal', 'pakghor'),
                'italic'  => esc_html__('Italic', 'pakghor'),
                'oblique' => esc_html__('Oblique', 'pakghor'),                               
            ),
        ),
        array(
            'id'             => 'pakghor_section_title_transform',
            'type'           => 'select',
            'title'          => esc_html__('Section Title text-transform:', 'pakghor'),
            'options'     => array(
                'uppercase'  => esc_html__('Uppercase', 'pakghor'),
                'none'       => esc_html__('None', 'pakghor'),
                'capitalize' => esc_html__('Capitalize', 'pakghor'),                
                'lowercase'  => esc_html__('Lowercase', 'pakghor'),
            ),
            'default'  => 'capitalize',
        ),
        // Title
        array(
            'type'      => 'subheading',
            'content'   => esc_html__('Title', 'pakghor'),
        ),
        array(
            'id'        => 'pakghor_title_font_family',
            'type'      => 'typography',
            'title'     => esc_html__('Title font family:', 'pakghor'),
            'default'   => array(
                'family'  => 'Poppins',
                'font'    => 'google', // this is helper for output ( google, websafe, custom )
            ),
            'variant'   => false,
        ),
        // Menu
        array(
            'type'    => 'subheading',
            'content'   => esc_html__('Menu', 'pakghor'),
        ),
        array(
            'id'        => 'pakghor_menu_font_family',
            'type'      => 'typography',
            'title'     => esc_html__('Menu font family:', 'pakghor'),
            'default'   => array(
                'family'  => 'Poppins',
                'font'    => 'google', // this is helper for output ( google, websafe, custom )
            ),
            'variant'   => false,
        ),
         array(
            'id'             => 'pakghor_menu_font_transform',
            'type'           => 'select',
            'title'          => esc_html__('Menu text-transform:', 'pakghor'),
            'options'     => array(
                'uppercase'  => esc_html__('Uppercase', 'pakghor'),
                'none'       => esc_html__('None', 'pakghor'),
                'capitalize' => esc_html__('Capitalize', 'pakghor'),                
                'lowercase'  => esc_html__('Lowercase', 'pakghor'),
            ),
            'default'  => 'capitalize',
        ),
    ),        
);


/**
 * Custom Post Settings
 */
$options[]      = array(
    'name'      => 'be_custom_post_settings',
    'title'     => esc_html__( 'Custom Post Settings', 'pakghor' ),
    'icon'      => 'fa fa-paste',
    'fields'    => array(
        array(
            'type'      => 'subheading',
            'content'   => esc_html__( 'Custom Post Type Settings', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_event_post_name',
            'type'      => 'text',
            'title'     => esc_html__( 'Event post type rewrite name', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own name to appear as part of event name. By default "Event" is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_event_post_slug',
            'type'      => 'text',
            'title'     => esc_html__( 'Event post type rewrite slug', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own slug to appear as part of event URL. By default /event/ is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_team_post_name',
            'type'      => 'text',
            'title'     => esc_html__( 'Team post type rewrite name', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own name to appear as part of Team name. By default "Team" is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_team_post_slug',
            'type'      => 'text',
            'title'     => esc_html__( 'Teams post type rewrite slug', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own slug to appear as part of team URL. By default /team/ is used.', 'pakghor' )
        ),  
        array(
            'id'        => 'pakghor_services_post_name',
            'type'      => 'text',
            'title'     => esc_html__( 'Services post type rewrite name', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own name to appear as part of services name. By default "Services" is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_services_post_slug',
            'type'      => 'text',
            'title'     => esc_html__( 'Services post type rewrite slug', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own slug to appear as part of services URL. By default /services/ is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_gallery_post_name',
            'type'      => 'text',
            'title'     => esc_html__( 'Gallery post type rewrite name', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own name to appear as part of Gallery name. By default "Gallery" is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_gallery_post_slug',
            'type'      => 'text',
            'title'     => esc_html__( 'Gallery post type rewrite slug', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own slug to appear as part of Gallery URL. By default /Gallery/ is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_testimonial_post_name',
            'type'      => 'text',
            'title'     => esc_html__( 'Testimonial post type rewrite name', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own name to appear as part of Testimonial name. By default "Testimonial" is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_testimonial_post_slug',
            'type'      => 'text',
            'title'     => esc_html__( 'Testimonial post type rewrite slug', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own slug to appear as part of Testimonial URL. By default /testimonial/ is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_pricing_tabel_post_name',
            'type'      => 'text',
            'title'     => esc_html__( 'Pricing Tabel post type rewrite name', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own name to appear as part of pricing_tabel name. By default "pricing_tabel" is used.', 'pakghor' )
        ),
        array(
            'id'        => 'pakghor_pricing_tabel_post_slug',
            'type'      => 'text',
            'title'     => esc_html__( 'Pricing Tabel post type rewrite slug', 'pakghor' ),
            'desc'      => esc_html__( 'Here you can define your own slug to appear as part of pricing_tabel URL. By default /pricing/ is used.', 'pakghor' )
        ),      
    )
);


// ----------------------------------------
// Event Post
// ----------------------------------------

$options[]      = array(
    'name'      =>  'pakghor_event_option',
    'title'     =>  esc_html__('Event Settings', 'pakghor'),
    'icon'      =>  'fa fa-calendar',
    'fields'    =>  array(

         array(
            'type'      => 'subheading',
            'content'   => esc_html__('Event Template Settings','pakghor'),
        ),
        array(
            'id'        =>  'event_per_page',
            'type'      =>  'number',
            'title'     =>  esc_html__('Events Per Page on Event Template','pakghor'),
            'default'   => 5
        ),
        array(
            'id'        =>  'event_excerpt',
            'type'      =>  'number',
            'title'     =>  esc_html__('Event content exceprt word limit.','pakghor'),
            'default'   => 25,
        ),
    ),
);


// ----------------------------------------
// Woocommerce
// ----------------------------------------

$options[]      = array(
    'name'      =>  'pakghor_woocommerce',
    'title'     =>  esc_html__('WooCommerce Settings', 'pakghor'),
    'icon'      =>  'fa fa-shopping-cart',
    'fields'    =>  array(
		array(
            'type'      => 'subheading',
            'content'   => esc_html__('WooCommerce Shop Page','pakghor'),
        ),
        array(
            'id'        =>  'pakghor_woocommerce_short_desc_excerpt_lenth',
            'type'      =>  'number',
            'title'     =>  esc_html__('Excerpt Characters on Shop Page','pakghor'),
            'desc'      =>  esc_html__('The Excerpt lenth of short desc on only shop page','pakghor'),
            'default'   => 50
        ),
        array(
            'id'        =>  'pakghor_woo_product_per_page',
            'type'      =>  'number',
            'title'     =>  esc_html__('Number of Products on Shop Page','pakghor'),
            'desc'      =>  esc_html__('How manay Products Do you want to show on shop page, unlimited value is [-1]','pakghor'),
            'default'   => -1
        ),
        array(
            'id'        =>  'pakghor_woo_shop_menu',
            'type'      =>  'switcher',
            'title'     =>  esc_html__( 'Category Menu Enable or Disable on Shop Page', 'pakghor' ),
            'label'      =>  esc_html__( 'If you want to hide Hide Categoy menu on Shop Page, please switch OFF.', 'pakghor' ),
            'default'   => true,
        ),
        array(
            'type'      => 'subheading',
            'content'   => esc_html__('WooCommerce Shop Single','pakghor'),
        ),
        array(
            'id'            =>  'pakghor_related_product_switcher',
            'type'          =>  'switcher',
            'title'         =>  esc_html__( 'Show/Hide Realted Product', 'pakghor' ),
            'label'          =>  esc_html__( 'If you want to show Realted Product on Show signle page please switch on.', 'pakghor' ),
        ),
        array(
            'id'        =>  'pakghor_woo_related_item_count',
            'type'      =>  'number',
            'title'     =>  esc_html__('Related Product Count','pakghor'),
            'desc'      =>  esc_html__('How Manay Related Product Do you want show on Shop single page, default is 4.','pakghor'),
            'default'   => 4,
            'dependency'    =>  array('pakghor_related_product_switcher', '==', 'true'),
        ),
        array(
            'id'            =>  'pakghor_related_product_icon',
            'type'          =>  'icon',
            'title'         =>  esc_html__( 'Related Product Section Icon', 'pakghor' ),
            'dependency'    =>  array('pakghor_related_product_switcher', '==', 'true'),
        ),
        array(
            'id'            =>  'pakghor_related_product_title',
            'type'          =>  'text',
            'title'         =>  esc_html__( 'Related Product Section Title', 'pakghor' ),
            'dependency'    =>  array('pakghor_related_product_switcher', '==', 'true'),
        ),
        array(
            'id'            =>  'pakghor_related_product_sub_title',
            'type'          =>  'textarea',
            'title'         =>  esc_html__( 'Related Product Section Sub Title', 'pakghor' ),
            'dependency'    =>  array('pakghor_related_product_switcher', '==', 'true'),
        ),
    ),
);



// ----------------------------------------
// Google Map -
// ----------------------------------------

$options[]      = array(
    'name'      =>  'pakghor_google_map',
    'title'     =>  esc_html__('Google Map Settings', 'pakghor'),
    'icon'      =>  'fa fa-map-marker',
    'fields'    =>  array(

        array(
            'type'      =>  'subheading',
            'content'   =>  esc_html__('Location Map Section', 'pakghor')
        ),

        array(
            'id'        =>  'pakghor_google_api',
            'type'      =>  'text',
            'title'     =>  esc_html__('Enter Google Map API Key','pakghor'),
            'desc'      =>  esc_html__('Create your google map api from https://developers.google.com/maps/documentation/javascript/tutorial','pakghor'),
            'sanitize'  =>  false,
        ),
    ),
);


/**
 * Footer Settings
 */

$options[]      = array(
    'name'      => 'al_footer_settings',
    'title'     => esc_html__( 'Footer Settings', 'pakghor' ),
    'icon'      => 'fa fa-bookmark',
    'fields'    => array(

        // Footer Top Section
        array(
            'type'      => 'subheading',
            'content'   => esc_html__( 'Footer Top Widget Section', 'pakghor' )
        ),

        array(
            'id'        =>  'pakghor_footer_top_switcher',
            'type'      =>  'switcher',
            'title'     =>  esc_html__( 'Footer Top Widget', 'pakghor' ),
            'label'      =>  esc_html__( 'If you want to hide footer top Widget section please switch OFF', 'pakghor' ),
            'default'   => true,
        ),
        array(
            'id'      => 'pakghor_footer_top_background_image',
            'type'    => 'image',
            'title'   => esc_html__('Footer top Section Background Image:', 'pakghor'),
            'dependency'    =>  array('pakghor_footer_top_switcher', '==', 'true'),
        ),
        array(
            'id'       => 'footer_top_bg_repeat',
            'type'     => 'select',
            'desc' => esc_html__('Default is no-repeat.','pakghor'),
            'title'    => esc_html__('Select Background Repeat','pakghor'),
            'options'  => array(
                'no-repeat' => esc_html__('No-repeat','pakghor'),
                'repeat'    => esc_html__('Repeat','pakghor'),
                'repeat-x'  => esc_html__('Repeat-x','pakghor'),
                'repeat-y'  => esc_html__('Repeat-y','pakghor'),
          ),
          'default'  => 'no-repeat',
          'dependency'    =>  array('pakghor_footer_top_switcher', '==', 'true'),
        ),
        array(
            'id'       => 'footer_top_bg_size',
            'type'     => 'select',
            'desc' => esc_html__('Default is cover.','pakghor'),
            'title'    => esc_html__('Select Background Size','pakghor'),
            'options'  => array(
                'cover'     => esc_html__('Cover','pakghor'),
                'auto'      => esc_html__('Auto','pakghor'),
                'contain'   => esc_html__('Contain','pakghor'),
          ),
          'default'  => 'cover',
          'dependency'    =>  array('pakghor_footer_top_switcher', '==', 'true'),
        ),
        array(
            'id'            => 'footer_top_bg_postion',
            'type'          => 'text',
            'title'         => esc_html__('Background Position', 'pakghor'),
            'default'       => 'center',
            'desc'   => esc_html__('Give Background Image Position, Default is center', 'pakghor' ),
            'dependency'    =>  array('pakghor_footer_top_switcher', '==', 'true'),
        ),
        array(
            'id'      => 'pakghor_footer_top_background_color',
            'type'    => 'color_picker',
            'title'   => esc_html__('Footer top Section Background Color:', 'pakghor'),
            'default'   => 'rgba(0,0,0,.9)',
            'dependency'    =>  array('pakghor_footer_top_switcher', '==', 'true'),
            'desc'          => esc_html__('You can use as Background overlay.','pakghor'),
        ), 
        // Footer Bottom Copyright Section
        array(
            'type'      =>  'subheading',
            'content'   =>  esc_html__( 'Footer Bottom Section', 'pakghor' ),
        ),
        array(
            'id'        => 'pakghor_copyright_switcher',
            'type'      => 'switcher',
            'title'     => esc_html__( 'Copyright Text Option', 'pakghor' ),
            'label'      => esc_html__( 'If you want to Show Copyright Text Option please switch on', 'pakghor' ),
            'default'   =>  true,
        ),
        array(
            'id'            => 'pakghor_copyright_section_text',
            'type'          => 'textarea',
            'desc'          => esc_html__( 'Write your copyright text for footer. It also supports HTML tag.', 'pakghor' ),
            'title'         => esc_html__( 'Copyright Text', 'pakghor' ),
            'dependency'    =>  array('pakghor_copyright_switcher', '==', 'true'),
            'sanitize'      => true,
        ),
        array(
            'id'            => 'pakghor_bottom_background_color',
            'type'          => 'color_picker',
            'title'         => esc_html__('Footer Copyright Section Background Color:', 'pakghor'),
            'dependency'    =>  array('pakghor_copyright_switcher', '==', 'true'),
        ),
    ),
);


/**
 * 404 Error Page Settings
 */
$options[]      = array(
    'name'      => 'pakghor_404_error_settings',
    'title'     => esc_html__( '404 Error Page Settings', 'pakghor' ),
    'icon'      => 'fa fa-warning',
    'fields'    => array(

        array(
            'id'            =>  'pakghor_404_image',
            'type'          =>  'image',
            'title'         =>  esc_html__( '404 Page Template Image', 'pakghor' ),
        ),
        array(
            'id'            =>  'pakghor_404_title',
            'type'          =>  'text',
            'title'         =>  esc_html__( '404 Page Title', 'pakghor' ),
            'default'       => esc_html__('This Page Is Not Be Found', 'pakghor'),
        ),
        array(
            'id'            =>  'pakghor_404_content',
            'type'          =>  'textarea',
            'title'         =>  esc_html__( '404 Page Content', 'pakghor' ),
        ),
        array(
            'id'            =>  'pakghor_404_bg_left',
            'type'          =>  'image',
            'title'         =>  esc_html__( 'Background Image Left', 'pakghor' ),
        ),
        array(
            'id'       => 'error_bgl_repeat',
            'type'     => 'select',
            'desc'     => esc_html__('Default is no-repeat.','pakghor'),
            'title'    => esc_html__('Select Left Background Repeat','pakghor'),
            'options'  => array(
                'no-repeat' => esc_html__('No-repeat','pakghor'),
                'repeat'    => esc_html__('Repeat','pakghor'),
                'repeat-x'  => esc_html__('Repeat-x','pakghor'),
                'repeat-y'  => esc_html__('Repeat-y','pakghor'),
            ),
          'default'  => 'no-repeat',
        ),
        array(
            'id'       => 'error_bgl_size',
            'type'     => 'text',
            'desc'     => esc_html__('Default is: 30%','pakghor'),
            'title'    => esc_html__('Background Left Size','pakghor'),
            'default'  => '30%',
        ),
        array(
            'id'            => 'error_bgl_position',
            'type'          => 'text',
            'title'         => esc_html__('Background Left Position', 'pakghor'),
            'default'       => 'top left',
            'desc' => esc_html__('Default is: top left.','pakghor'),
        ),
        array(
            'id'            =>  'pakghor_404_bg_right',
            'type'          =>  'image',
            'title'         =>  esc_html__( 'Background Image Right', 'pakghor' ),
        ),
        array(
            'id'       => 'error_bgr_repeat',
            'type'     => 'select',
            'desc'     => esc_html__('Default is no-repeat.','pakghor'),
            'title'    => esc_html__('Select Background Repeat','pakghor'),
            'options'  => array(
                'no-repeat' => esc_html__('No-repeat','pakghor'),
                'repeat'    => esc_html__('Repeat','pakghor'),
                'repeat-x'  => esc_html__('Repeat-x','pakghor'),
                'repeat-y'  => esc_html__('Repeat-y','pakghor'),
          ),
          'default'  => 'no-repeat',
        ),
        array(
            'id'       => 'error_bgr_size',
            'type'     => 'text',
            'desc'     => esc_html__('Default is: 30%','pakghor'),
            'title'    => esc_html__('Background Size','pakghor'),
            'default'  => '30%'
        ),
        array(
            'id'        => 'error_bgr_position',
            'type'      => 'text',
            'title'     => esc_html__('Background Position', 'pakghor'),
            'default'   => 'top right',
            'desc'      => esc_html__('Default is: top right','pakghor'),
        ),
    ),
);

/**
 * Backup Options
 */
$options[]  = array(
    'name'     => 'pakghor_backup_section',
    'title'    => esc_html__( 'Backup', 'pakghor' ),
    'icon'     => 'fa fa-shield',
    'fields'   => array(
        array(
            'type'    => 'notice',
            'class'   => 'warning',
            'content' => esc_html__( 'You can save your current options. Download a Backup and Import.', 'pakghor'),
        ),
        array(
            'type'    => 'backup',
        ),
    )
);

CSFramework::instance( $settings, $options );