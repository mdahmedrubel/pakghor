<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package pakghor
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function pakghor_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

    // Sticky Menu switcher from theme option
    if ( function_exists( 'cs_get_option' ) ) {
        $sticky_menu_switcher = cs_get_option( 'sticky_menu_switcher' );

        if ( $sticky_menu_switcher == 1 ) {
            $classes[] = 'pakghor-sticky-menu';

        }
    }
	return $classes;
}
add_filter( 'body_class', 'pakghor_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pakghor_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'pakghor_pingback_header' );

// WP User Role for Single Post
function get_user_role($id) {
    $user = new WP_User($id);
    return array_shift($user->roles);
}

// pakghor adminpanel social links options============================
/* ===========================================
Author Admin Social
========================================= */
add_action( 'show_user_profile', 'pakghor_adminpanel_social' );
add_action( 'edit_user_profile', 'pakghor_adminpanel_social' );

function pakghor_adminpanel_social( $user ) { ?>
    <h3><?php echo esc_html__("User Social links", "pakghor"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="facebook"><?php esc_html_e("Facebook","pakghor"); ?></label></th>
        <td>
            <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Iner your facebook profile id","pakghor"); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="twitter"><?php esc_html_e("Twitter","pakghor"); ?></label></th>
        <td>
            <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Please enter your twitter user id",'pakghor'); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="linkedin"><?php esc_html_e("Linkedin","pakghor"); ?></label></th>
        <td>
            <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Please enter your linkedin id",'pakghor'); ?></span>
        </td>
    </tr>
    <th><label for="pinterest"><?php esc_html_e("Pinterest","pakghor"); ?></label></th>
        <td>
            <input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Please enter your pinterest id",'pakghor'); ?></span>
        </td>
    </tr>
    <th><label for="google-plus"><?php esc_html_e("google-plus","pakghor"); ?></label></th>
        <td>
            <input type="text" name="google-plus" id="google-plus" value="<?php echo esc_attr( get_the_author_meta( 'google-plus', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Please enter your google-plus id",'pakghor'); ?></span>
        </td>
    </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'pakghor_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'pakghor_save_extra_user_profile_fields' );
function pakghor_save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
    update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
    update_user_meta( $user_id, 'google-plus', $_POST['google-plus'] );
}
// Remove WordPress Default Excerpt style
function new_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');







/*Import Demo content data*/
if ( ! function_exists( 'pakghor_import_files' ) ) :
function pakghor_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'Pakghor Demo', 'pakghor' ),
            'import_file_url'              => 'http://codexcoder.com/demo/pakghor/demos-content.xml',
            'import_widget_file_url'       => 'http://codexcoder.com/demo/pakghor/demos-widgets.wie',
            'import_customizer_file_url'   => 'http://codexcoder.com/demo/pakghor/demos-customizer.dat',
            'import_preview_image_url'     => 'http://codexcoder.com/demo/pakghor/screenshot.png',
            'preview_url'                  => 'https://demos.codexcoder.com/pakghor',
            'import_notice'                => esc_html__( 'After you import the demo data, just set widgets from Appearance > Widgets home page & blog page will 
            automatically set. If you want to use different home page you can do that from Settings > Reading. Also import pakghor-themeoption.
            json through theme options > theme options backup importer thats all.', 'pakghor' ),
        ),
        array(
            'import_file_name'             => esc_html__( 'Revolution Sliders', 'pakghor' ),
            'import_preview_image_url'   => 'http://codexcoder.com/demo/pakghor/screenshot.png',
            'preview_url'                => 'https://demos.codexcoder.com/pakghor',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'pakghor_import_files' );
endif;


function ocdi_plugin_intro_text( $default_text ) {
	$default_text .= '<div class="ocdi__intro-text" style="width:400px"><p>Please click on the <strong>Import Demo Data</strong> button and wait
	for importing demo data. It may take a few minutes.</p>
</div>';
	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'ocdi_plugin_intro_text' );




// Assign Menu after import
if ( ! function_exists( 'pakghor_after_import' ) ) :
function pakghor_after_import( $selected_import ) {
 
    if ( 'Pakghor Demo' === $selected_import['import_file_name'] ) :
        //Set Menu
        $primary     = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $one_page    = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
        set_theme_mod( 'nav_menu_locations' , array( 
                'menu-home' => $primary->term_id, 
                'pakghor-mobile-menu' => $one_page->term_id 
            ) 
        );

       //Set Front page and blog page according title
       $home_page = get_page_by_title( 'Homepage One');
       $blog_page  = get_page_by_title( 'Blog' );
       
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_page->ID );
        update_option( 'page_for_posts', $blog_page->ID );
        
        
    //import codestar framework demo data
    $file = get_template_directory().'/demo/pakghor-themeoptions.txt';
     if ( function_exists( 'cs_get_option' ) && file_exists( $file ) ):
        $data = file_get_contents( $file );
        $decoded_data = cs_decode_string ( $data );
        update_option( '_cs_options', $decoded_data );
    endif; 
        
        
    endif; 
    
    
    //slider revolution upload therough one click demo import
    if ( 'Revolution Sliders' === $selected_import['import_file_name'] ) :
        if ( class_exists( 'RevSlider' ) ):
            $slider_array = array(
                'http://codexcoder.com/demo/pakghor/slider/food-carousel53.zip',
                'http://codexcoder.com/demo/pakghor/slider/le-chef-food51.zip',
                'http://codexcoder.com/demo/pakghor/slider/le-chef-footer55.zip',
                'http://codexcoder.com/demo/pakghor/slider/le-chef-la-carte53.zip',
                'http://codexcoder.com/demo/pakghor/slider/le-chef-philosophy49.zip',
                'http://codexcoder.com/demo/pakghor/slider/levano-restaurant-bar.zip',
                'http://codexcoder.com/demo/pakghor/slider/notgeneric1.zip',
            );
            
            $slider = new RevSlider();                        

            foreach($slider_array as $filepath):
                $tmp = download_url($filepath);
                $slider->importSliderFromPost(true,true,$tmp);  
            endforeach;       
        endif;
    endif;
    
}
add_action( 'pt-ocdi/after_import', 'pakghor_after_import' );
endif;





