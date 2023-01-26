<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ==============================================================================================

$options = array();

// -----------------------------------------
// Page Options -
// -----------------------------------------
$options[]  = array(
	'id'        =>  '_pakghor_custom_page_options',
	'title'     =>  esc_html__('Pakghor Page Options', 'pakghor'),
	'post_type' =>  'page',
	'context'   =>  'normal',
	'priority'  =>  'default',
	'sections'  =>  array(
	    // begin: a section
	    array(
	      	'name'      =>  'page_header',
	      	'fields'    =>  array(

                /*** Custom Page Settings*/
                array(
                    'type'      =>  'subheading',
                    'content'   =>  esc_html__('Custom Page Settings', 'pakghor'),
                ),
                array(
                    'id'            => 'pakghor_theme_logo',
                    'type'          => 'image',
                    'title'         => esc_html__( 'Theme Logo', 'pakghor' ),
                    'add_title'     => esc_html__( 'Add Logo', 'pakghor' ),
                    'desc'          => esc_html__( 'Upload logo','pakghor' ),
                ),
                array(
                    'id'            => 'pakghor_theme_logo_dark',
                    'type'          => 'image',
                    'title'         => esc_html__( 'Theme Dark Logo', 'pakghor' ),
                    'add_title'     => esc_html__( 'Add Logo', 'pakghor' ),
                    'desc'          => esc_html__( 'This logo for Header Style Two, Sticky header, and Mobile header.','pakghor' ),
                ),
                // Custom Header Settings/
                array(
                    'type'      =>  'subheading',
                    'content'   =>  esc_html__('Custom Header Settings', 'pakghor'),
                ),
                array(
                    'id'            => 'pakghor_header_style',
                    'type'          => 'radio',
                    'title'         => esc_html__( 'Select Header Style', 'pakghor' ),
                    'class'         => 'horizontal',
                    'options'       => array(
                        '1'         => esc_html__( 'Header Style One', 'pakghor' ),
                        '2'         => esc_html__( 'Header Style Two', 'pakghor' ),
                        '3'         => esc_html__( 'Header Style Three', 'pakghor' ),
                        '4'         => esc_html__( 'No Header', 'pakghor' ),
                    ),
                    'default'       => cs_get_option( 'pakghor_header_style' ),
                ),
                array(
                    'id'            => 'pakghor_header_top_bar_switcher',
                    'type'          => 'switcher',
                    'title'         => esc_html__( 'Header Top Bar', 'pakghor' ),
                    'label'         => esc_html__( 'If you want to hide Header Top bar Please switch off.', 'pakghor' ),
                    'default'       =>  cs_get_option( 'pakghor_header_top_bar_switcher' ),
                ),
                array(
                    'id'            =>  'pakghor_search_switcher',
                    'type'          =>  'switcher',
                    'title'         =>  esc_html__( 'Search Form', 'pakghor' ),
                    'label'         =>  esc_html__( 'If you want to hide search form please switch off.', 'pakghor' ),
                    'default'       =>  cs_get_option('pakghor_search_switcher'),
                ),
                // Custom Page Title Settings
                array(
                    'type'      =>  'subheading',
                    'content'   =>  esc_html__('Page title & Breadcrumbs Settings', 'pakghor'),
                ),
                array(
                    'id'            => 'pakghor_breadcrumbs',
                    'type'          => 'switcher',
                    'title'         => esc_html__( 'Breadcrumbs', 'pakghor' ),
                    'label'         => esc_html__( 'If you want to Hide Breadcrumbs please switch off.', 'pakghor' ),
                    'default'       => cs_get_option( 'pakghor_breadcrumbs' ),
                ),
                array(
                    'id'        => 'pakghor_page_title',
                    'type'      => 'switcher',
                    'title'     => esc_html__( 'Page Title', 'pakghor' ),
                    'label'     => esc_html__( 'If you want to Hide Page Title please switch off.', 'pakghor' ),
                    'default'   => cs_get_option( 'pakghor_page_title' ),
                ),
                // Footer switcher
                array(
                    'type'      =>  'subheading',
                    'content'   =>  esc_html__('Footer Settings', 'pakghor'),
                ),
                array(
                    'id'        =>  'pakghor_footer_top_switcher',
                    'type'      =>  'switcher',
                    'title'     =>  esc_html__( 'Footer Top Widget', 'pakghor' ),
                    'label'      =>  esc_html__( 'If you want to hide footer top Widget section please switch off.', 'pakghor' ),
                    'default'   => cs_get_option('pakghor_footer_top_switcher'),
                ),
                 array(
                    'id'        => 'pakghor_copyright_switcher',
                    'type'      => 'switcher',
                    'title'     => esc_html__( 'Footer Bottom Copyright', 'pakghor' ),
                    'label'     => esc_html__( 'If you want to hide footer bottom section please switch off.', 'pakghor' ),
                    'default'   => cs_get_option( 'pakghor_copyright_switcher' ),
                ),
            ), // Fields ended
		),

    ),

);
/*******************************************************************/
// Pakghor Team  post type MetaBox
/*******************************************************************/

$options[]    = array(
    'id'        => '_pakghor_testimonial_page_options',
    'title'     => esc_html__('Clinet Rating Option','pakghor'),
    'post_type' => 'pakghor_testimonial',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(
        array(
            'name'  => 'designation',
            'title' => esc_html__('Clinet Rating','pakghor'),
            'icon'  => 'fa fa-cog',
            'fields' => array(
                    array(
                        'id'       => 'pakghor_client_rating',
                        'type'     => 'text',
                        'title'    => esc_html__('Testimonial Clinet Rating', 'pakghor' ),
                        'desc'     => esc_html__('Rate me between 1-5','pakghor'),
                        'default'  => 5
                    ),
                ),
            ), 
        ),
);


/*******************************************************************/
// Pakghor Team  post type MetaBox
/*******************************************************************/

$options[]    = array(
    'id'        => '_pakghor_team_page_options',
    'title'     => esc_html__('Designation','pakghor'),
    'post_type' => 'pakghor_team',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

    // begin: a section
        array(
            'name'  => 'designation',
            'title' => esc_html__('Designation','pakghor'),
            'icon'  => 'fa fa-cog',

            // begin: fields
            'fields' => array(

                // begin: a field
                array(
                    'id'        => 'pakghor_team_designation',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Designation of the Member', 'pakghor' ),
                    'desc'      => esc_html__('Give Member Designation here','pakghor'),
                ),
                // Begin : a filed 
                array(
                    'id'                => 'pakghor_team_social',
                    'type'              => 'group',
                    'title'             => esc_html__( 'Add Social Link', 'pakghor' ),
                    'desc'              => esc_html__( 'Add Social Media Icon & Links for Team. Like- Facebook, Twitter, Linkedin etc.','pakghor' ),
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
                ),
                array(
                    'id'                => 'pakghor_team_info',
                    'type'              => 'group',
                    'title'             => esc_html__( 'Add Team Info', 'pakghor' ),
                    'desc'              => esc_html__( 'Add Member Address, Phone, email etc.','pakghor' ),
                    'button_title'      => esc_html__( 'Add New', 'pakghor' ),
                    'add_title'         => esc_html__( 'Add Info', 'pakghor' ),
                    'accordion_title'   => esc_html__( 'Add New Info', 'pakghor' ),
                    'fields'            => array(
                        array(
                            'id'        => 'pakghor_team_info_icon',
                            'type'      => 'icon',
                            'title'     => esc_html__( 'Add Info Icon', 'pakghor' ),
                            'desc'      => esc_html__( 'Select Team Info Icon','pakghor' ),
                        ),
                        array(
                            'id'        => 'pakghor_team_info_details',
                            'type'      => 'text',
                            'title'     => esc_html__( 'Info Details', 'pakghor' ),
                            'desc'      => esc_html__('Give team Aditional Information, like- Address, Email, Phone etc.','pakghor'),
                        ),
                    ),
                ),

            ), // end: fields

        ), // end: a section

    ),
);




/*******************************************************************/
// Pakghor Feature  post type MetaBox
/*******************************************************************/

$options[]    = array(
    'id'        => '_pakghor_feature_page_options',
    'title'     => esc_html__('Feature Icon','pakghor'),
    'post_type' => 'feature',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

    // begin: a section
        array(
            'name'  => 'designation',
            'title' => esc_html__('Feature Icon','pakghor'),
            'icon'  => 'fa fa-cog',

            // begin: fields
            'fields' => array(
                // begin: a field
                array(
                    'id'        =>  'pakghor_feature_icon',
                    'type'      =>  'icon',
                    'title'     =>  esc_html__( 'Select the Feature Icon', 'pakghor' ),
                    'desc'      => esc_html__('This icon is instead of Featured Image','pakghor'),
                ),
            ), // end: fields

        ), // end: a section

    ),
);



/*******************************************************************/
// Pakghor Services  post type MetaBox
/*******************************************************************/

$options[]    = array(
    'id'        => '_pakghor_services_page_options',
    'title'     => esc_html__('Service Icon','pakghor'),
    'post_type' => 'pakghor_services',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

    // begin: a section
        array(
            'name'  => 'designation',
            'title' => esc_html__('Service Icon','pakghor'),
            'icon'  => 'fa fa-cog',

            // begin: fields
            'fields' => array(

                // begin: a field
                array(
                    'id'        => 'pakghor_services_icon',
                    'type'      => 'icon',
                    'title'     => esc_html__( 'Select the Service Icon', 'pakghor' ),
                    'desc'      => esc_html__('Use Service Icon','pakghor'),
                ),
                array(
                    'id'        => 'pakghor_services_image',
                    'type'      => 'image',
                    'title'     => esc_html__( 'Upload Service Image', 'pakghor' ),
                    'desc'      => esc_html__('This image is used instead of Icon. For the Service Single page Upload Feature Image from the right section.','pakghor'),
                ),

            ), // end: fields

        ), // end: a section

    ),
);


/*******************************************************************/
// Pakghor Event  post type MetaBox
/*******************************************************************/

$options[]    = array(
    'id'        => '_pakghor_event_page_options',
    'title'     => esc_html__('Event Options','pakghor'),
    'post_type' => 'pakghor_event',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

    // begin: a section
        array(
            'name'  => 'event-details',
            'title' => esc_html__('Event Details','pakghor'),
            'icon'  => 'fa fa-cog',

            // begin: fields
            'fields' => array(

                // begin: a field
                array(
                    'id'        =>  'pakghor_event_time',
                    'type'      =>  'text',
                    'title'     =>  esc_html__( 'Event Time', 'pakghor' ),
                    'desc'      =>  esc_html__('Give here your Event time', 'pakghor'),
                ),
                array(
                    'id'        =>  'pakghor_event_location',
                    'type'      =>  'textarea',
                    'title'     =>  esc_html__( 'Event Location', 'pakghor' ),
                    'desc'      =>  esc_html__('Your Event Location Address', 'pakghor'),
                ),
                array(
                    'id'        =>  'pakghor_event_speaker_title',
                    'type'      =>  'text',
                    'title'     =>  esc_html__( 'Event Speaker Title', 'pakghor' ),
                    'desc'      =>  esc_html__(' Speaker title', 'pakghor'),
                ),
                array(
                    'id'        =>  'pakghor_event_speaker_name',
                    'type'      =>  'text',
                    'title'     =>  esc_html__( 'Event Speaker name', 'pakghor' ),
                    'desc'      =>  esc_html__(' Speaker Name', 'pakghor'),
                ),
                array(
                    'id'        =>  'pakghor_event_speaker_image',
                    'type'      =>  'image',
                    'title'     =>  esc_html__( 'Event Speaker Image', 'pakghor' ),
                    'desc'      =>  esc_html__( 'Upload Speaker Image', 'pakghor'),
                ),
                array(
                    'id'        => 'pakghor_event_rating',
                    'type'      => 'text',
                    'title'     => esc_html__('Event Rating', 'pakghor' ),
                    'desc'      => esc_html__('Rate between 1-5','pakghor'),
                    'default'   => 5
                ),

            ), // end: fields

        ), // end: a section

    ),
);



/*******************************************************************/
// Pakghor Pricing  Post type MetaBox
/*******************************************************************/

$options[]    = array(
    'id'        => '_pakghor_pricing_options',
    'title'     => esc_html__('Pricing Tabel Options','pakghor'),
    'post_type' => 'pakghor_pricing',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

    // begin: a section
        array(
            'name'  => 'pricing-details',
            'title' => esc_html__('Pricing Tabel Info','pakghor'),
            'icon'  => 'fa fa-cog',

            // begin: fields
            'fields' => array(

                // begin: a field
                array(
                    'id'        =>  'pakghor_pricing_currency',
                    'type'      =>  'text',
                    'title'     =>  esc_html__( 'Pricing Currency', 'pakghor' ),
                    'desc'      =>  esc_html__('Give your Currency. Like : $', 'pakghor'),
                ),
                array(
                    'id'        =>  'pakghor_package_price',
                    'type'      =>  'text',
                    'title'     =>  esc_html__( 'Package Price', 'pakghor' ),
                ),
                array(
                    'id'                => 'pakghor_package_pricing_items',
                    'type'              => 'group',
                    'title'             => esc_html__( 'Add Pricing Item', 'pakghor' ),
                    'desc'              => esc_html__( 'Add Pricinf Items Name.','pakghor' ),
                    'button_title'      => esc_html__( 'Add New Item', 'pakghor' ),
                    'add_title'         => esc_html__( 'Add Item', 'pakghor' ),
                    'accordion_title'   => esc_html__( 'Add New Item', 'pakghor' ),
                    'fields'            => array(
                        array(
                            'id'        => 'pakghor_package_pricing_items_name',
                            'type'      => 'text',
                            'title'     => esc_html__( 'Add Package Item Name', 'pakghor' ),
                        ),
                    ),
                ),
                array(
                    'id'        =>  'pakghor_package_book_btn',
                    'type'      =>  'text',
                    'title'     =>  esc_html__( 'Book Button Text', 'pakghor' ),
                ),
                array(
                    'id'        =>  'pakghor_package_book_url',
                    'type'      =>  'text',
                    'title'     =>  esc_html__( 'Book Button Url', 'pakghor' ),
                ),

            ), // end: fields

        ), // end: a section

    ),
);

CSFramework_Metabox::instance( $options );